<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 2019/3/27
 * Time: 9:33
 */

namespace app\admin\controller;


use app\admin\model\EncashModel;
use app\admin\model\EncashValidate;
use app\admin\model\MembershipModel;
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
            $result = Db::table('encash')->order('create_time desc')->page($rec['page_num'], $rec['page_size'])->select();
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
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->EncashValidate->check($rec, '', 'getEncash');

        if ($res) {
            $result = $this->Encash->where('id', '=', $rec['id'])->find();
            $result1 = $this->Encash->where('referrer_id', '=', $result['encash_id'])->select();
            $result['levelTwo'] = $result1;
            $result['levelThree'] = [];
            foreach ($result1 as $key => $value) {
                $result3 = $this->Encash->where('referrer_id', '=', $value['encash_id'])->select();
                $result['levelThree'] = array_merge($result['levelThree'], $result3);
            }
            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->SuccessReturn('success', []);
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
                if($result2['commission']>=$rec['account']){
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
                return $this->ErrorReturn('佣金不足，提现失败！');
            }

        } else {
            return $this->ErrorReturn($this->EncashValidate->getError());
        }

    }


}