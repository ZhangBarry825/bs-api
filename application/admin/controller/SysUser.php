<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2018/7/20
 * Time:  17:51
 */

namespace app\admin\controller;


use app\admin\model\SysUserModel;
use app\admin\model\SysUserValidate;
use think\Db;

class SysUser extends Base
{
    protected $User;
    protected $UserValidate;

    public function __construct()
    {
        $this->needUser = false;
        parent::__construct();
        $this->User = new SysUserModel();
        $this->UserValidate = new SysUserValidate();
    }

    public function login()
    {
//        $rec = $_POST;
        if (isset($_POST['username'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }

        $res = $this->UserValidate->check($rec, '', 'login');
        if ($res) {
            $rec['password'] = md5($rec['password']);
            $result = $this->User->where('username', '=', $rec['username'])->where('password', '=', $rec['password'])->field('id,username,name,nickname,avatar,roles')->find();
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

    public function updateUserPwd()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->UserValidate->check($rec, '', 'updateUserPwd');

        if ($res) {
            $data['password'] = md5('123456');
            $result = $this->User->where('id', '=', $rec['id'])->update($data);
            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->SuccessReturn('success');
            }
        } else {
            return $this->ErrorReturn($this->UserValidate->getError());
        }


    }

    public function deleteUser()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->UserValidate->check($rec, '', 'deleteUser');

        if ($res) {
            $result = false;
            for ($i = 0; $i < count($rec['id']); $i++) {
                if ($rec['id'][$i] != 1) {
                    $result = $this->User->where('id', '=', $rec['id'][$i])->delete();
                }
            }

            if ($result) {
                return $this->SuccessReturn('success');
            } else {
                return $this->SuccessReturn('系统管理员禁止删除！');
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
            return $this->SuccessReturn('success', getUser());
        } else {
            return $this->ErrorReturn('获取信息失败');
        }
    }

    public function allUsers()
    {

        if (isset($_POST['page_num'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }

        $res = $this->UserValidate->check($rec, '', 'allUsers');
        if ($res) {
            $result = Db::table('sys_user')->page($rec['page_num'], $rec['page_size'])->field('id,username,name,nickname,roles,avatar')->select();
            if ($result) {
                $count = count(Db::table('sys_user')->select());
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);
            } else {
                $data['count'] = 0;
                $data['rows'] = [];
                return $this->SuccessReturn('success', $data);
            }
        } else {
            return $this->ErrorReturn($this->UserValidate->getError());
        }

    }

    public function newUser()
    {
        if (isset($_POST['username'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->UserValidate->check($rec, '', 'newUser');

        if ($res) {
            $rec['roles'] = 'manager';
            $rec['password'] = md5($rec['password']);
            $count = count($this->User->where('username', '=', $rec['username'])->select());
            if ($count > 0) {
                return $this->ErrorReturn('该账号已存在！');
            } else {
                $result = $this->User->isUpdate(false)->save($rec);
                if ($result) {
                    return $this->SuccessReturn('success', $rec);
                } else {
                    return $this->ErrorReturn($this->User->getError());
                }
            }


        } else {
            return $this->ErrorReturn($this->UserValidate->getError());
        }


    }

    public function updateUser()
    {
        if (isset($_POST['username'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->UserValidate->check($rec, '', 'updateUser');

        if ($res) {
            $rec['password'] = md5($rec['password']);
            $count = count($this->User->where('id', 'neq', $rec['id'])->where('username', '=', $rec['username'])->select());
            if ($count > 0) {
                return $this->ErrorReturn('该手机号已存在！');
            } else {
                $result = $this->User->where('id', '=', $rec['id'])->update($rec);
                if ($result) {
                    return $this->SuccessReturn('success', $rec);
                } else {
                    return $this->ErrorReturn($this->User->getError());
                }
            }


        } else {
            return $this->ErrorReturn($this->UserValidate->getError());
        }


    }

    public function getUserDetail()
    {
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->UserValidate->check($rec, '', 'getUserDetail');
        if ($res) {
            $result = $this->User->where('id', '=', $rec['id'])->field('password',true)->find();
            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->ErrorReturn($this->User->getError());
            }
        } else {
            return $this->ErrorReturn($this->UserValidate->getError());
        }
    }
}