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
            $data['top'] = $this->Goods->order('create_time desc')->where('status', '=', '1')->field('content', true)->limit(0, 3)->select();
            $data['rows'] = $this->Goods->order('create_time desc')->where('status', '=', '1')->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->field('content', true)->select();
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
        if (isset($_POST['id']) || isset($_POST['goods_id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        if (isset($rec['id'])) {
            $data = $this->Goods->where('id', '=', $rec['id'])->find();
            $data['specification'] = $this->GoodsSpecification->where('goods_id', '=', $data['goods_id'])->select();
            if ($data) {
                return $this->SuccessReturn('success', $data);
            } else {
                return $this->SuccessReturn('success', []);
            }
        } else {
            $data = $this->Goods->where('goods_id', '=', $rec['goods_id'])->find();
            $data['specification'] = $this->GoodsSpecification->where('goods_id', '=', $data['goods_id'])->select();
            if ($data) {
                return $this->SuccessReturn('success', $data);
            } else {
                return $this->SuccessReturn('success', []);
            }
        }


    }

    public function search()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->GoodsValidate->check($rec, '', 'search');
        if ($res) {
            $data['count']=0;
            $data['rows']=[];
            if (isset($rec['type_id'])&&$rec['type_id']!="") {
                $result=$this->Goods->where('type_id','=',$rec['type_id'])
                    ->where('status','=',1)
                    ->page($rec['page_num'], $rec['page_size'])->field('content',true)->select();
                $data['count']=count($result);
                $data['rows']=$result;
            } else if (isset($rec['keyword'])&&$rec['keyword']!="") {
                $result=$this->Goods->where('name','like',"%{$rec['keyword']}%")
                    ->where('status','=',1)
                    ->page($rec['page_num'], $rec['page_size'])->field('content',true)->select();
                $data['count']=count($result);
                $data['rows']=$result;
            } else {
                return $this->SuccessReturn('success',[]);
            }
            return $this->SuccessReturn('success',$data);
        } else {
            return $this->ErrorReturn($this->GoodsValidate->getError());
        }
    }


}