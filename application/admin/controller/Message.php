<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 2019/3/27
 * Time: 9:33
 */

namespace app\admin\controller;


use app\admin\model\MessageModel;
use app\admin\model\MessageValidate;
use think\Db;

class Message extends Base
{

    protected $Message;
    protected $MessageValidate;

    public function __construct()
    {
        $this->needUser = true;
        parent::__construct();
        $this->Message = new MessageModel();
        $this->MessageValidate = new MessageValidate();
    }

    public function newMessage()
    {
        if (isset($_POST['title'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MessageValidate->check($rec, '', 'newMessage');

        if ($res) {
            $rec['create_time']=time();
            $result = $this->Message->isUpdate(false)->save($rec);
            if ($result) {
                return $this->SuccessReturn('success', $rec);
            } else {
                return $this->ErrorReturn($this->Message->getError());
            }
        } else {
            return $this->ErrorReturn($this->MessageValidate->getError());
        }

    }

    public function allMessages()
    {

        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }

        $res = $this->MessageValidate->check($rec, '', 'allMessage');
        if ($res) {
            $result = Db::table('message')->page($rec['page_num'], $rec['page_size'])->select();
            if ($result) {
                $count = count(Db::table('message')->select());
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);
            } else {
                $data['count'] = 0;
                $data['rows'] = [];
                return $this->SuccessReturn('success', $data);
            }
        } else {
            return $this->ErrorReturn($this->MessageValidate->getError());
        }

    }

    public function deleteMessage()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MessageValidate->check($rec, '', 'deleteMessage');

        if ($res) {
            $result=false;
            for ($i = 0; $i < count($rec['id']); $i++) {
                if ($rec['id'][$i] != 1) {
                    $result = $this->Message->where('id', '=', $rec['id'][$i])->delete();
                }
            }

            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->ErrorReturn();
            }
        } else {
            return $this->ErrorReturn($this->MessageValidate->getError());
        }


    }

    public function getMessage(){
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MessageValidate->check($rec, '', 'getMessage');

        if($res){
            $result=$this->Message->where('id', '=',  $rec['id'])->find();
            if($result){
                return $this->SuccessReturn('success',$result);
            }else{
                return $this->SuccessReturn('success',[]);
            }
        }else{
            return $this->ErrorReturn($this->MessageValidate->getError());
        }

    }

    public function updateMessage()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MessageValidate->check($rec, '', 'updateMessage');

        if ($res) {
            $rec['create_time']=time();
            $result = $this->Message->update($rec);
            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->ErrorReturn($this->Message->getError());
            }
        } else {
            return $this->ErrorReturn($this->MessageValidate->getError());
        }

    }

}