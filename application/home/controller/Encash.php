<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 2019/3/27
 * Time: 9:33
 */

namespace app\home\controller;


use app\home\model\EncashModel;
use app\home\model\EncashValidate;
use app\home\model\MembershipModel;
use think\Db;

class Encash extends Base
{

    protected $Encash;
    protected $Membership;
    protected $EncashValidate;

    public function __construct()
    {
        $this->needUser = true;
        parent::__construct();
        $this->Encash = new EncashModel();
        $this->Membership = new MembershipModel();
        $this->EncashValidate = new EncashValidate();
    }

    public function newEncash()
    {
        if (isset($_POST['nickname'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->EncashValidate->check($rec, '', 'newEncash');

        if ($res) {
            $result0=$this->Encash->where('membership_id','=',$rec['membership_id'])
                ->where('status','=',0)->count();
            if($result0>0){
                return $this->ErrorReturn('申请失败！您有提现申请暂未处理');
            }
            $rec['create_time'] = time();
            $rec['encash_id'] = substr(time(), -4) . mt_rand(10000, 99999);
            $rec['encash_type'] = 1;
            $rec['status'] = 0;
            $result = $this->Encash->isUpdate(false)->save($rec);
            if ($result) {
                return $this->SuccessReturn('success', $rec);
            } else {
                return $this->ErrorReturn($this->Encash->getError());
            }


        } else {
            return $this->ErrorReturn($this->EncashValidate->getError());
        }

    }

    public function allEncashs()
    {

        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }

        $res = $this->EncashValidate->check($rec, '', 'allEncash');
        if ($res) {
            $result = Db::table('encash')->page($rec['page_num'], $rec['page_size'])->select();
            if ($result) {
                $count = count(Db::table('encash')->select());
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);
            } else {
                $data['count'] = 0;
                $data['rows'] = [];
                return $this->SuccessReturn('success', $data);
            }
        } else {
            return $this->ErrorReturn($this->EncashValidate->getError());
        }

    }

    public function deleteEncash()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->EncashValidate->check($rec, '', 'deleteEncash');

        if ($res) {
            $result = false;
            for ($i = 0; $i < count($rec['id']); $i++) {
                $result = $this->Encash->where('id', '=', $rec['id'][$i])->delete();
            }

            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->ErrorReturn();
            }
        } else {
            return $this->ErrorReturn($this->EncashValidate->getError());
        }


    }

    public function getEncash()
    {
        if (isset($_POST['membership_id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->EncashValidate->check($rec, '', 'getEncash');

        if ($res) {
            $result = $this->Encash->where('membership_id', '=', $rec['membership_id'])->select();
            $result1 = $this->Encash->where('membership_id', '=', $rec['membership_id'])
                ->where('status','=',1)->select();
            if($result){
                $sum=$this->Encash->where('membership_id', '=', $rec['membership_id'])
                    ->where('status','=',1)->sum('account');
                $data['success_account']=$sum;
                $data['success_rows']=$result1;
                $data['rows']=$result;
                return $this->SuccessReturn('success',$data);
            }else{
                return $this->SuccessReturn('success',[
                    'success_account'=>'',
                    'success_rows'=>[],
                    'rows'=>[],
                ]);
            }
        } else {
            return $this->ErrorReturn($this->EncashValidate->getError());
        }

    }

    public function updateEncash()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->EncashValidate->check($rec, '', 'updateEncash');

        if ($res) {
            $rec['pay_time'] = time();
            $result1 = '';
            if ($rec['status'] == 1) {
                $result2=$this->Membership->where('membership_id', '=', $rec['membership_id'])->find();
                if($result2['commission']>$rec['account']){
                    $result1 = $this->Membership->where('membership_id', '=', $rec['membership_id'])->setInc('balance', $rec['account']);
                    $result1 = $this->Membership->where('membership_id', '=', $rec['membership_id'])->setDec('commission', $rec['account']);
                }
            }
            if ($result1 || $rec['status'] != 1) {
                $result = $this->Encash->update($rec);
                if ($result) {
                    return $this->SuccessReturn('success');
                } else {
                    return $this->ErrorReturn($this->Encash->getError());
                }
            } else {
                return $this->ErrorReturn('操作失败！');
            }

        } else {
            return $this->ErrorReturn($this->EncashValidate->getError());
        }

    }


}