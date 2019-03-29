<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\admin\controller;


use app\admin\model\RegulationModel;
use app\admin\model\RegulationValidate;
use think\Db;
use think\Request;

class Regulation extends Base
{
    protected $Regulation;
    protected $RegulationValidate;


    public function __construct()
    {
        parent::__construct();
        $this->Regulation = new RegulationModel();
        $this->RegulationValidate = new RegulationValidate();
    }

    public function index()
    {
        return 'admin/regulation/index';
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
        $res = $this->RegulationValidate->check($rec, '', 'update');
        if ($res) {
            $result = $this->Regulation->update($rec);
            if ($result) {
                return $this->SuccessReturn();
            } else {
                return $this->ErrorReturn($this->Regulation->getError());
            }
        } else {
            return $this->ErrorReturn($this->RegulationValidate->getError());
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
        $res = $this->RegulationValidate->check($rec, '', 'detail');

        if ($res) {
            $result = Db::table('regulation')->where('id', '=', $rec['id'])->find();
            if ($result) {
                return $this->SuccessReturn('success', $result);
            } else {
                return $this->ErrorReturn('获取失败');
            }
        }else{
            return $this->ErrorReturn($this->RegulationValidate->getError());
        }
    }



}