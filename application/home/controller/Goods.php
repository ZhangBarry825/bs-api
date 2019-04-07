<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\home\controller;


use app\home\model\GoodsModel;
use app\home\model\GoodsSpecificationModel;
use app\home\model\GoodsValidate;


class Goods extends Base
{
    protected $Goods;
    protected $GoodsSpecification;
    protected $GoodsValidate;


    public function __construct()
    {
        $this->needUser = false;
        parent::__construct();
        $this->Goods = new GoodsModel();
        $this->GoodsSpecification = new GoodsSpecificationModel();
        $this->GoodsValidate = new GoodsValidate();
    }

    public function homeList()
    {
        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->GoodsValidate->check($rec, '', 'lists');

        if ($res) {
            $data['top'] = $this->Goods->where('status', '=', '1')->field('content', true)->limit(0, 3)->select();
            $data['rows'] = $this->Goods->where('status', '=', '1')->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();

            if ($data['top']) {
                return $this->SuccessReturn('success', $data);
            } else {
                return $this->SuccessReturn('success', []);
            }
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
            $data = $this->Goods->where('id', '=', $rec['id'])->find();
            $data['specification']=$this->GoodsSpecification->where('goods_id','=',$data['goods_id'])->select();
            if ($data) {
                return $this->SuccessReturn('success', $data);
            } else {
                return $this->SuccessReturn('success', []);
            }
        } else {
            return $this->ErrorReturn($this->GoodsValidate->getError());
        }
    }


}