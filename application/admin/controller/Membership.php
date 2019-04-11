<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 2019/3/27
 * Time: 9:33
 */

namespace app\admin\controller;


use app\admin\model\MembershipModel;
use app\admin\model\MembershipValidate;
use think\Db;

class Membership extends Base
{

    protected $Membership;
    protected $MembershipValidate;

    public function __construct()
    {
        $this->needUser = true;
        parent::__construct();
        $this->Membership = new MembershipModel();
        $this->MembershipValidate = new MembershipValidate();
    }

    public function newMembership()
    {
        if (isset($_POST['name'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MembershipValidate->check($rec, '', 'newMembership');

        if ($res) {
            $rep = $this->Membership->where('phone', '=', $rec['phone'])->find();
            if ($rep) {
                return $this->ErrorReturn('该号码已存在!');
            } else {

                $rec['create_time'] = time();
                $rec['balance'] = 0;
                $rec['expense'] = 0;
                $rec['password'] = md5($rec['password']);
                $rec['membership_id'] = substr($rec['phone'], -4) . substr(time(), -4);
                $rec['status'] = 0;
                $result = $this->Membership->isUpdate(false)->save($rec);
                if ($result) {
                    return $this->SuccessReturn('success', $rec);
                } else {
                    return $this->ErrorReturn($this->Membership->getError());
                }
            }


        } else {
            return $this->ErrorReturn($this->MembershipValidate->getError());
        }

    }

    public function allMemberships()
    {

        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }

        $res = $this->MembershipValidate->check($rec, '', 'allMembership');
        if ($res) {
            $result = Db::table('membership')->page($rec['page_num'], $rec['page_size'])->select();
            if ($result) {
                $count = count(Db::table('membership')->select());
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);
            } else {
                $data['count'] = 0;
                $data['rows'] = [];
                return $this->SuccessReturn('success', $data);
            }
        } else {
            return $this->ErrorReturn($this->MembershipValidate->getError());
        }

    }

    public function deleteMembership()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MembershipValidate->check($rec, '', 'deleteMembership');

        if ($res) {
            $result = false;
            for ($i = 0; $i < count($rec['id']); $i++) {
                $result = $this->Membership->where('id', '=', $rec['id'][$i])->delete();
            }

            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->ErrorReturn();
            }
        } else {
            return $this->ErrorReturn($this->MembershipValidate->getError());
        }


    }

    public function getMembership()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MembershipValidate->check($rec, '', 'getMembership');

        if ($res) {
            $result = $this->Membership->where('id', '=', $rec['id'])->find();
            $result1=$this->Membership->where('referrer_id', '=', $result['membership_id'])->select();
            $result['levelTwo']=$result1;
            $result['levelThree']=[];
            foreach ($result1 as $key=>$value){
                $result3=$this->Membership->where('referrer_id', '=', $value['membership_id'])->select();
                $result['levelThree']=array_merge($result['levelThree'],$result3);
            }
            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->SuccessReturn('success', []);
            }
        } else {
            return $this->ErrorReturn($this->MembershipValidate->getError());
        }

    }

    public function updateMembership()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MembershipValidate->check($rec, '', 'updateMembership');

        if ($res) {
//            $rec['create_time'] = time();
            $result = $this->Membership->update($rec);
            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->ErrorReturn($this->Membership->getError());
            }
        } else {
            return $this->ErrorReturn($this->MembershipValidate->getError());
        }

    }

    public function resetPassword(){
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->MembershipValidate->check($rec, '', 'resetPassword');

        if ($res) {
            $data['password'] = md5('123456');
            $result = $this->Membership->where('id', '=', $rec['id'])->update($data);
            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->SuccessReturn('success');
            }
        } else {
            return $this->ErrorReturn($this->MembershipValidate->getError());
        }


    }


    public function allSaleMembers()
    {

        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }

        $res = $this->MembershipValidate->check($rec, '', 'allMembership');
        if ($res) {
            $result = Db::table('membership')->where('status','>',0)->page($rec['page_num'], $rec['page_size'])->order('create_time desc')->select();
            if ($result) {
                $count = count(Db::table('membership')->select());
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);
            } else {
                $data['count'] = 0;
                $data['rows'] = [];
                return $this->SuccessReturn('success', $data);
            }
        } else {
            return $this->ErrorReturn($this->MembershipValidate->getError());
        }

    }

}