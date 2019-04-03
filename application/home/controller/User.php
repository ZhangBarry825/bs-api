<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2018/7/20
 * Time:  17:51
 */

namespace app\home\controller;


use app\home\model\MembershipModel;
use app\home\model\UserModel;
use app\home\model\UserValidate;

class User extends Base
{
    protected $User;
    protected $UserValidate;
    protected $Membership;

    public function __construct()
    {
        $this->needUser = false;
        parent::__construct();
        $this->User = new UserModel();
        $this->UserValidate = new UserValidate();
        $this->Membership = new MembershipModel();
    }

    public function index()
    {
        return $this->SuccessReturn('success', '/home/user/index');
    }

    public function login()
    {
        if (isset($_POST['phone'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }

        $res = $this->UserValidate->check($rec, '', 'login');
        if ($res) {
            $rec['password'] = md5($rec['password']);
            $result = $this->User->where('phone', '=', $rec['phone'])->where('password', '=', $rec['password'])->field('password', true)->find();
            if ($result) {
                session('user', $result);
                return $this->SuccessReturn("success", $result);
            } else {
                return $this->ErrorReturn('账号或密码错误！');
            }
        } else {
            return $this->ErrorReturn($this->UserValidate->getError());
        }
    }

    public function updatepwd()
    {
        if (isset($_POST['old_password'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->UserValidate->check($rec, '', 'updatePwd');

        if ($res) {
            $rec['old_password'] = md5($rec['old_password']);
            $result = $this->User->where('username', '=', 'admin')->where('password', '=', $rec['old_password'])->field('name,roles')->find();
            if ($result) {
                $data['password'] = md5($rec['new_password']);
                $result2 = $this->User->where('username', '=', 'admin')->update($data);
                if ($result2) {
                    return $this->SuccessReturn('success');
                } else {
                    return $this->ErrorReturn('新旧密码不能一致！');
                }
            } else {
                return $this->ErrorReturn('原密码错误！');
            }
        } else {
            return $this->ErrorReturn($this->UserValidate->getError());
        }
    }

    public function logout()
    {
        unsetUser();
        return $this->SuccessReturn();
    }

    public function info()
    {
        if (getUser()) {
            $user = getUser();
            $result = $this->Membership->where('membership_id', '=', $user['membership_id'])->find();

            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->SuccessReturn('success', []);
            }
        } else {
            return $this->ErrorReturn('请先登录');
        }

    }

}