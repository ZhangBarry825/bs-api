<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\admin\controller;


use app\admin\model\CommissionModel;
use app\admin\model\MembershipModel;
use app\admin\model\OrderModel;
use app\admin\model\OrderValidate;
use app\admin\model\OrderGoodsModel;
use app\admin\model\RegulationModel;
use think\Db;

class Order extends Base
{
    protected $Order;
    protected $OrderValidate;
    protected $OrderGoods;
    protected $Commission;
    protected $Membership;
    protected $Regulation;


    public function __construct()
    {
        parent::__construct();
        $this->Order = new OrderModel();
        $this->OrderGoods = new OrderGoodsModel();
        $this->Commission = new CommissionModel();
        $this->OrderValidate = new OrderValidate();
        $this->Membership = new MembershipModel();
        $this->Regulation = new RegulationModel();
    }

    public function index()
    {
        return 'admin/Order/index';
    }

    public function create()
    {
//        $rec = $_POST;
        if (isset($_POST['shopper'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->OrderValidate->check($rec, '', 'create');
        if ($res) {
            $rec['create_time'] = time();
            $rec['order_id'] = substr(time(), -5) . mt_rand(10000, 99999);
            $levelOne['create_time'] = $rec['create_time'];
            $levelOne['order_id'] = $rec['order_id'];
            $levelOne['shopper'] = $rec['shopper'];
            $levelOne['shopper_id'] = $rec['shopper_id'];
            $levelOne['nickname'] = $rec['nickname'];
            $levelOne['membership_id'] = $rec['membership_id'];
            $levelOne['status'] = $rec['status'];
            $levelOne['price'] = $rec['price'];
            $levelOne['name'] = $rec['name'];
            if (isset($rec['pay_time'])) {
                $levelOne['pay_time'] = $rec['pay_time'];
            }
            $levelOne['contacts'] = $rec['contacts'];
            $levelOne['phone'] = $rec['phone'];
            $levelOne['address'] = $rec['address'];
            $levelOne['express_company'] = $rec['express_company'];
            $levelOne['express_code'] = $rec['express_code'];
            $levelOne['express_cost'] = $rec['express_cost'];
            $levelOne['remark'] = $rec['remark'];
            $result = $this->Order->isUpdate(false)->insert($levelOne);
            if ($result) {
//                foreach ($rec['specification'] as $key => $value) {
//                    $value['goods_id'] = $rec['goods_id'];
//                    $result2 = $this->Specification->insert($value);
//                }
                return $this->SuccessReturn('success', $rec);
            } else {
                return $this->ErrorReturn($this->Order->getError());
            }
        } else {
            return $this->ErrorReturn($this->OrderValidate->getError());
        }
    }

    public function update()
    {
//        $rec = $_POST;
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->OrderValidate->check($rec, '', 'update');
        if ($res) {
            $levelOne['id'] = $rec['id'];
            $levelOne['status'] = $rec['status'];
            $levelOne['express_company'] = $rec['express_company'];
            $levelOne['express_code'] = $rec['express_code'];
            if ($rec['status'] == 1) {
                $levelOne['pay_time'] = time();
            }
            if ($rec['status'] == 4) {
                $levelOne['apply_refund_time'] = time();
            }
            if ($rec['status'] == 5) {
                $levelOne['refund_address'] = $rec['refund_address'];
                $levelOne['refund_contacts'] = $rec['refund_contacts'];
                $levelOne['refund_phone'] = $rec['refund_phone'];
            }
            if ($rec['status'] == 7) {
                $levelOne['refund_time'] = time();
                $order = $this->Order->where('id', '=', $rec['id'])->find();
                $res1 = $this->Membership->where('membership_id', '=', $order['membership_id'])->setInc('balance', $order['price']);
            }
            $result = $this->Order->update($levelOne);
            if ($result) {
                if ($rec['status'] == 3 && isset($rec['querenshouhuo'])) {
                    $item=$this->Order->where('id','=',$rec['id'])->find();
                    $regulation=$this->Regulation->limit(1)->find();
                    $level_three_id=$item['shopper_id'];
                    $level_one='';
                    $level_two='';
                    $commission_account=0;
                    $data2=[];
                    $data2['create_time']=time();
                    $data2['order_id']=$item['order_id'];
                    $data2['customer_id']=$item['membership_id'];
                    $data2['customer_nickname']=$item['nickname'];
                    $data2['order_id']=$item['order_id'];
                    $level_three=$this->Membership->where('membership_id','=',$level_three_id)->find();
                    $data2['level_three']=$level_three['nickname'];
                    $data2['level_three_id']=$level_three['membership_id'];
                    $data2['level_three_commission']=$item['price']*$regulation['level_three']*1.00/100;
                    $this->Membership->where('membership_id','=',$level_three['membership_id'])->setInc('commission',$data2['level_three_commission']);
                    if($level_three['referrer_id']!=0){
                        $level_two=$this->Membership->where('membership_id','=',$level_three['referrer_id'])->find();
                        $data2['level_two']=$level_two['nickname'];
                        $data2['level_two_id']=$level_two['membership_id'];
                        $data2['level_two_commission']=$item['price']*$regulation['level_two']*1.00/100;
                        $this->Membership->where('membership_id','=',$level_two['membership_id'])->setInc('commission',$data2['level_two_commission']);

                        if($level_two['referrer_id']!=0){
                            $level_one=$this->Membership->where('membership_id','=',$level_two['referrer_id'])->find();
                            $data2['level_one']=$level_one['nickname'];
                            $data2['level_one_id']=$level_one['membership_id'];
                            $data2['level_one_commission']=$item['price']*$regulation['level_one']*1.00/100;
                            $commission_account=$item['price']*($regulation['level_one']+$regulation['level_two']+$regulation['level_three'])*1.00/100;
                            $this->Membership->where('membership_id','=',$level_one['membership_id'])->setInc('commission',$data2['level_one_commission']);
                        }else{
                            $commission_account=$item['price']*($regulation['level_two']+$regulation['level_three'])*1.00/100;
                        }
                    }else{
                        $commission_account=$item['price']*$regulation['level_three']*1.00/100;
                    }
                    $data2['commission_account']=$commission_account;
                    $result2=$this->Commission->isUpdate(false)->insert($data2);
                }
                return $this->SuccessReturn();
            } else {
                return $this->ErrorReturn($this->Order->getError());
            }
        } else {
            return $this->ErrorReturn($this->OrderValidate->getError());
        }
    }

    public function delete()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->OrderValidate->check($rec, '', 'delete');

        if ($res) {
            $result = false;
            for ($i = 0; $i < count($rec['id']); $i++) {
                $result2 = $this->Order->where('id', '=', $rec['id'][$i])->find();
                $result3 = $this->OrderGoods->where('order_id', '=', $result2['order_id'])->delete();
                $result = $this->Order->where('id', '=', $rec['id'][$i])->delete();
            }

            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->ErrorReturn();
            }
        } else {
            return $this->ErrorReturn($this->OrderValidate->getError());
        }
    }

    public function lists()
    {
        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->OrderValidate->check($rec, '', 'lists');
        if ($res) {

            $result = Db::table('order')->where('status', '<=', '3')->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();
            $count = count(Db::table('order')->where('status', '<=', '3')->select());
            if ($result) {
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);
            } else {
                return $this->SuccessReturn('success', (object)[
                    'count' => 0,
                    'rows' => []
                ]);
            }

        } else {
            return $this->ErrorReturn($this->OrderValidate->getError());
        }
    }

    public function refundLists()
    {
        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->OrderValidate->check($rec, '', 'lists');
        if ($res) {

            $result = Db::table('order')->where('status', '>', '3')->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();
            $count = count(Db::table('order')->where('status', '>', '3')->select());
            if ($result) {
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);
            } else {
                return $this->SuccessReturn('success', (object)[
                    'count' => 0,
                    'rows' => []
                ]);
            }

        } else {
            return $this->ErrorReturn($this->OrderValidate->getError());
        }
    }

    public function search()
    {
        if (isset($_POST['key'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->OrderValidate->check($rec, '', 'search');
        if ($res) {
            $count = count(Db::table('goods')->where('title', 'like', '%' . $rec['key'] . '%')->where('type', '=', $rec['type'])->order('create_time desc')->field('content', true)->select());
            $result = Db::table('goods')->where('title', 'like', '%' . $rec['key'] . '%')->where('type', '=', $rec['type'])->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();
            $ret['count'] = $count;
            $ret['rows'] = $result;

            return $this->SuccessReturn('success', $ret);
        } else {
            return $this->ErrorReturn($this->OrderValidate->getError());
        }

    }

    public function detail()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->OrderValidate->check($rec, '', 'detail');

        if ($res) {
            $result = Db::table('order')->where('id', '=', $rec['id'])->find();
            $result2 = Db::table('order_goods')->where('order_id', '=', $result['order_id'])->select();
            $result['goods'] = $result2;
            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->ErrorReturn('获取失败');
            }
        } else {
            return $this->ErrorReturn($this->OrderValidate->getError());
        }
    }

}