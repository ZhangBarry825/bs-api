<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\home\controller;


use app\home\model\AddressModel;
use app\home\model\AddressValidate;
use think\Db;
use think\Request;

class Address extends Base
{
    protected $Address;
    protected $AddressValidate;


    public function __construct()
    {
        parent::__construct();
        $this->Address = new AddressModel();
        $this->AddressValidate = new AddressValidate();
    }

    public function index()
    {
        return 'admin/address/index';
    }
    public function create(){
        if (isset($_POST['contacts'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->AddressValidate->check($rec, '', 'create');
        if($res){
            $levelOne['contacts']=$rec['contacts'];
            $levelOne['phone']=$rec['phone'];
            $levelOne['address']=$rec['address'];
            $levelOne['membership_id']=$rec['membership_id'];
            $result = $this->Address->isUpdate(false)->insert($levelOne);
            return $this->SuccessReturn();
        }else{
            return $this->ErrorReturn($this->AddressValidate->getError());
        }
    }

    public function delete(){
        if (isset($_POST['id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->AddressValidate->check($rec, '', 'delete');

        if($res){
            $levelOne['id']=$rec['id'];
            $result = $this->Address->where($levelOne)->delete();
            return $this->SuccessReturn();
        }else{
            return $this->ErrorReturn($this->AddressValidate->getError());
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
        $res = $this->AddressValidate->check($rec, '', 'lists');
        if ($res) {
            $result = Db::table('address')->where('membership_id','=',$rec['membership_id'])->page($rec['page_num'], $rec['page_size'])->select();
            $count = count(Db::table('address')->where('membership_id','=',$rec['membership_id'])->select());
            if ($result) {
                $data['count'] = $count;
                $data['rows'] = $result;
                return $this->SuccessReturn('success', $data);
            } else {
                return $this->SuccessReturn('success', (object)[
                    'count' => 0,
                    'rows' => []
                ]);
            }
        } else {
            return $this->ErrorReturn($this->AddressValidate->getError());
        }
    }

    public function province(){
        $result=Db::table('cn_nojd')->where('belong_id','=',0)->select();
        if($result){
            $data['count']=count($result);
            $data['rows']=$result;
            return $this->SuccessReturn('success',$data);
        }else{
            return $this->SuccessReturn('success',[]);
        }
    }

    public function area(){
        if (isset($_POST['pid'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->AddressValidate->check($rec, '', 'area');
        if($res){
            $result=Db::table('cn_nojd')->where('belong_id','=',$rec['pid'])->select();
            if($result){
                $data['count']=count($result);
                $data['rows']=$result;
                return $this->SuccessReturn('success',$data);
            }else{
                return $this->SuccessReturn('success',[]);
            }
        }else{
            return $this->ErrorReturn($this->AddressValidate->getError());
        }
    }

}