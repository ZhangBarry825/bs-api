<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\home\controller;


use app\home\model\MessageModel;
use app\home\model\MessageValidate;
use think\Db;

class Message extends Base
{
    protected $Message;
    protected $MessageValidate;


    public function __construct()
    {
        parent::__construct();
        $this->Message = new MessageModel();
        $this->MessageValidate = new MessageValidate();
    }

    public function index()
    {
        return 'admin/message/index';
    }

    public function lists()
    {
        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MessageValidate->check($rec, '', 'lists');
        if ($res) {
            $result = Db::table('message')->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->select();
            $count = count(Db::table('message')->select());
            $data['count'] = $count;
            $data['rows'] = $result;
            return $this->SuccessReturn('success', $data);
        } else {
            return $this->ErrorReturn($this->MessageValidate->getError());
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
        $res = $this->MessageValidate->check($rec, '', 'detail');

        if ($res) {
            $result = Db::table('message')->where('id', '=', $rec['id'])->find();
            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->ErrorReturn('获取失败');
            }
        }else{
            return $this->ErrorReturn($this->MessageValidate->getError());
        }
    }

    public function allList(){
        $result['pictures']['count']=count(Db::table('message')->where('type', '=', '轮播图')->where('status','=',1)->select());
        $result['listOne']['count']=count(Db::table('message')->where('type', '=', '赴加生子福利')->where('status','=',1)->select());
        $result['listTwo']['count']=count(Db::table('message')->where('type', '=', '成功案例')->where('status','=',1)->select());
        $result['listThree']['count']=count(Db::table('message')->where('type', '=', '月子中心')->where('status','=',1)->select());
        $result['listFour']['count']=count(Db::table('message')->where('type', '=', '政策解析')->where('status','=',1)->select());
        $result['listFive']['count']=count(Db::table('message')->where('type', '=', '赴加生子费用')->where('status','=',1)->select());
        $result['listSix']['count']=count(Db::table('message')->where('type', '=', '赴加攻略')->where('status','=',1)->select());
        $result['listSeven']['count']=count(Db::table('message')->where('type', '=', '赴加签证')->where('status','=',1)->select());
        $result['listEight']['count']=count(Db::table('message')->where('type', '=', '大温介绍')->where('status','=',1)->select());

        return $this->SuccessReturn('success',$result);
    }

}