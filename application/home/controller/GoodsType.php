<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\home\controller;


use app\home\model\GoodsTypeModel;
use app\home\model\GoodsTypeValidate;
use think\Db;
use think\Request;

class GoodsType extends Base
{
    protected $GoodsType;
    protected $GoodsTypeValidate;


    public function __construct()
    {
        parent::__construct();
        $this->GoodsType = new GoodsTypeModel();
        $this->GoodsTypeValidate = new GoodsTypeValidate();
    }

    public function index()
    {
        return 'home/GoodsType/index';
    }

    public function create()
    {
//        $rec = $_POST;
        if (isset($_POST['name'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->GoodsTypeValidate->check($rec, '', 'create');
        if ($res) {
            $rec['create_time'] = time();
            $rec['type_id'] = substr(time(), -5) . mt_rand(1000, 9999);
            $rec['level'] = 1;
            $rec['avatar'] = '';
            $rec['belong_id'] = '';
            $levelOne['level'] = $rec['level'];
            $levelOne['name'] = $rec['name'];
            $levelOne['create_time'] = $rec['create_time'];
            $levelOne['type_id'] = $rec['type_id'];
            $levelOne['avatar'] = $rec['avatar'];
            $levelOne['belong_id'] = $rec['belong_id'];
            $result = $this->GoodsType->isUpdate(false)->save($levelOne);
            if ($result) {
                foreach ($rec['children'] as $key => $value) {
                    $value['belong_id'] = $levelOne['type_id'];
                    $value['level'] = 2;
                    $value['create_time'] = time();
                    $value['type_id'] = substr(time(), -5) . mt_rand(1000, 9999);
                    $result2 = $this->GoodsType->insert($value);
                }
                return $this->SuccessReturn('success', $rec['children']);
            } else {
                return $this->ErrorReturn($this->GoodsType->getError());
            }
        } else {
            return $this->ErrorReturn($this->GoodsTypeValidate->getError());
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
        $res = $this->GoodsTypeValidate->check($rec, '', 'update');
        if ($res) {

            $levelOne['level'] = $rec['level'];
            $levelOne['name'] = $rec['name'];
            $levelOne['create_time'] = $rec['create_time'];
            $levelOne['type_id'] = $rec['type_id'];
            $levelOne['avatar'] = $rec['avatar'];
            $levelOne['belong_id'] = $rec['belong_id'];
            $levelOne['id'] = $rec['id'];
            $result = $this->GoodsType->update($levelOne);
            if ($result) {
                foreach ($rec['children'] as $key => $value) {
                    $result2 = $this->GoodsType->update($value);
                }
                return $this->SuccessReturn();
            } else {
                return $this->ErrorReturn($this->GoodsType->getError());
            }
        } else {
            return $this->ErrorReturn($this->GoodsTypeValidate->getError());
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
        $res = $this->GoodsTypeValidate->check($rec, '', 'delete');

        if ($res) {
            $result = false;
            for ($i = 0; $i < count($rec['id']); $i++) {
                $result2 = $this->GoodsType->where('id', '=', $rec['id'][$i])->find();
                $result3 = $this->GoodsType->where('belong_id', '=', $result2['type_id'])->delete();
                $result = $this->GoodsType->where('id', '=', $rec['id'][$i])->delete();
            }

            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->ErrorReturn();
            }
        } else {
            return $this->ErrorReturn($this->GoodsTypeValidate->getError());
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
        $res = $this->GoodsTypeValidate->check($rec, '', 'lists');
        if ($res) {
            if (isset($rec['level'])) {
                $result = Db::table('goods_type')->where('level', '=', $rec['level'])->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->select();
                foreach ($result as $key => $value) {
                    $result2 = Db::table('goods_type')->where('belong_id', '=', $value['type_id'])->select();
                    $childrenNum = count($result2);
                    $result[$key]['childrenNum'] = $childrenNum;
                    $result[$key]['children'] = $result2;
                }
                $count = count(Db::table('goods_type')->where('level', '=', $rec['level'])->select());
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);

            } else {
                $result = Db::table('goods_type')->where('level','=','2')->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->select();
                $count = count($result);
                if ($result) {
                    $data['count'] = $count;
                    $data['rows'] = $result;
                    return $this->SuccessReturn('success', $data);
                } else {
                    return $this->SuccessReturn('success', (object)[
                        'count'=>0,
                        'rows'=>[]
                    ]);
                }
            }
        } else {
            return $this->ErrorReturn($this->GoodsTypeValidate->getError());
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
        $res = $this->GoodsTypeValidate->check($rec, '', 'search');
        if ($res) {
            $count = count(Db::table('goods_type')->where('title', 'like', '%' . $rec['key'] . '%')->where('type', '=', $rec['type'])->order('create_time desc')->field('content', true)->select());
            $result = Db::table('goods_type')->where('title', 'like', '%' . $rec['key'] . '%')->where('type', '=', $rec['type'])->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();
            $ret['count'] = $count;
            $ret['rows'] = $result;

            return $this->SuccessReturn('success', $ret);
        } else {
            return $this->ErrorReturn($this->GoodsTypeValidate->getError());
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
        $res = $this->GoodsTypeValidate->check($rec, '', 'detail');

        if ($res) {
            $result = Db::table('goods_type')->where('id', '=', $rec['id'])->find();
            $result2 = Db::table('goods_type')->where('belong_id', '=', $result['type_id'])->select();
            $result['children'] = $result2;
            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->ErrorReturn('获取失败');
            }
        } else {
            return $this->ErrorReturn($this->GoodsTypeValidate->getError());
        }
    }

    public function allList()
    {
        $result['pictures']['count'] = count(Db::table('goods_type')->where('type', '=', '轮播图')->select());
        $result['listOne']['count'] = count(Db::table('goods_type')->where('type', '=', '赴加生子福利')->select());
        $result['listTwo']['count'] = count(Db::table('goods_type')->where('type', '=', '成功案例')->select());
        $result['listThree']['count'] = count(Db::table('goods_type')->where('type', '=', '月子中心')->select());
        $result['listFour']['count'] = count(Db::table('goods_type')->where('type', '=', '政策解析')->select());
        $result['listFive']['count'] = count(Db::table('goods_type')->where('type', '=', '赴加生子费用')->select());
        $result['listSix']['count'] = count(Db::table('goods_type')->where('type', '=', '赴加攻略')->select());
        $result['listSeven']['count'] = count(Db::table('goods_type')->where('type', '=', '赴加签证')->select());
        $result['listEight']['count'] = count(Db::table('goods_type')->where('type', '=', '大温介绍')->select());

        return $this->SuccessReturn('success', $result);
    }

}