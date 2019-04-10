<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\home\controller;


use app\home\model\RegulationModel;
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
    }

    public function index()
    {
        return 'admin/regulation/index';
    }

    public function detail()
    {

        $result = $this->Regulation->limit(1)->find();
        if ($result) {
            return $this->SuccessReturn('success', $result);
        } else {
            return $this->ErrorReturn('获取失败');
        }

    }


}