<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\admin\controller;


use app\admin\model\GoodsModel;
use app\admin\model\GoodsValidate;
use app\admin\model\SpecificationModel;
use think\Db;
use think\Request;

class Goods extends Base
{
    protected $Goods;
    protected $GoodsValidate;
    protected $Specification;


    public function __construct()
    {
        parent::__construct();
        $this->Goods = new GoodsModel();
        $this->Specification = new SpecificationModel();
        $this->GoodsValidate = new GoodsValidate();
    }

    public function index()
    {
        return 'admin/Goods/index';
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
        $res = $this->GoodsValidate->check($rec, '', 'create');
        if ($res) {
            $rec['create_time'] = time();
            $rec['goods_id'] = substr(time(), -5) . mt_rand(1000, 9999);
            $levelOne['create_time'] = $rec['create_time'];
            $levelOne['goods_id'] = $rec['goods_id'];
            $levelOne['price'] = $rec['price'];
            $levelOne['name'] = $rec['name'];
            $levelOne['type_id'] = $rec['type_id'];
            $levelOne['pic1'] = $rec['pic1'];
            $levelOne['pic2'] = $rec['pic2'];
            $levelOne['pic3'] = $rec['pic3'];
            $levelOne['status'] = $rec['status'];
            $levelOne['stock'] = $rec['stock'];
            $levelOne['content'] = $rec['content'];
            $levelOne['express_cost'] = $rec['express_cost'];
            $result = $this->Goods->isUpdate(false)->insert($levelOne);
            if ($result) {
                foreach ($rec['specification'] as $key => $value) {
                    $value['goods_id'] = $rec['goods_id'];
                    $result2 = $this->Specification->insert($value);
                }
                return $this->SuccessReturn('success', $rec);
            } else {
                return $this->ErrorReturn($this->Goods->getError());
            }
        } else {
            return $this->ErrorReturn($this->GoodsValidate->getError());
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
        $res = $this->GoodsValidate->check($rec, '', 'update');
        if ($res) {
            $levelOne['id'] = $rec['id'];
            $levelOne['create_time'] = $rec['create_time'];
            $levelOne['goods_id'] = $rec['goods_id'];
            $levelOne['price'] = $rec['price'];
            $levelOne['name'] = $rec['name'];
            $levelOne['type_id'] = $rec['type_id'];
            $levelOne['pic1'] = $rec['pic1'];
            $levelOne['pic2'] = $rec['pic2'];
            $levelOne['pic3'] = $rec['pic3'];
            $levelOne['status'] = $rec['status'];
            $levelOne['stock'] = $rec['stock'];
            $levelOne['content'] = $rec['content'];
            $levelOne['express_cost'] = $rec['express_cost'];
            $result = $this->Goods->update($levelOne);
            if ($result) {
                foreach ($rec['specification'] as $key => $value) {
                    $result2 = $this->Specification->update($value);
                }
                return $this->SuccessReturn();
            } else {
                return $this->ErrorReturn($this->Goods->getError());
            }
        } else {
            return $this->ErrorReturn($this->GoodsValidate->getError());
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
        $res = $this->GoodsValidate->check($rec, '', 'delete');

        if ($res) {
            $result = false;
            for ($i = 0; $i < count($rec['id']); $i++) {
                $result2 = $this->Goods->where('id', '=', $rec['id'][$i])->find();
                $result3 = $this->Specification->where('goods_id', '=', $result2['goods_id'])->delete();
                $result = $this->Goods->where('id', '=', $rec['id'][$i])->delete();
            }

            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->ErrorReturn();
            }
        } else {
            return $this->ErrorReturn($this->GoodsValidate->getError());
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
        $res = $this->GoodsValidate->check($rec, '', 'lists');
        if ($res) {
            if (isset($rec['type'])) {
                $result = Db::table('goods')->where('type', '=', $rec['type'])->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();
                $count = count(Db::table('goods')->where('type', '=', $rec['type'])->select());
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);

            } else {
                $result = Db::table('goods')->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();
                $count = count(Db::table('goods')->select());
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
            return $this->ErrorReturn($this->GoodsValidate->getError());
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
        $res = $this->GoodsValidate->check($rec, '', 'search');
        if ($res) {
            $count = count(Db::table('goods')->where('title', 'like', '%' . $rec['key'] . '%')->where('type', '=', $rec['type'])->order('create_time desc')->field('content', true)->select());
            $result = Db::table('goods')->where('title', 'like', '%' . $rec['key'] . '%')->where('type', '=', $rec['type'])->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();
            $ret['count'] = $count;
            $ret['rows'] = $result;

            return $this->SuccessReturn('success', $ret);
        } else {
            return $this->ErrorReturn($this->GoodsValidate->getError());
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
        $res = $this->GoodsValidate->check($rec, '', 'detail');

        if ($res) {
            $result = Db::table('goods')->where('id', '=', $rec['id'])->find();
            $result2 = Db::table('goods_specification')->where('goods_id', '=', $result['goods_id'])->select();
            $result['specification'] = $result2;
            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->ErrorReturn('获取失败');
            }
        } else {
            return $this->ErrorReturn($this->GoodsValidate->getError());
        }
    }

}