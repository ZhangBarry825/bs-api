<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\home\controller;


use app\home\model\CommissionModel;
use app\home\model\CommissionValidate;
use think\Db;
use think\Request;

class Commission extends Base
{
    protected $Commission;
    protected $CommissionValidate;


    public function __construct()
    {
        parent::__construct();
        $this->Commission = new CommissionModel();
        $this->CommissionValidate = new CommissionValidate();
    }

    public function index()
    {
        return 'admin/commission/index';
    }

    public function lists()
    {
        if (isset($_POST['membership_id'])) {
            $rec = $_POST;
        } else {
            $request_data = file_get_contents('php://input');
            $rec = json_decode($request_data, true);
        }
        $res = $this->CommissionValidate->check($rec, '', 'lists');
        if ($res) {
            $result1 = Db::table('commission')->query("SELECT * from commission where level_one_id = " . $rec['membership_id']);
            foreach ($result1 as $key => $value) {
                $result1[$key]['commission_receive'] = $value['level_one_commission'];
            }
            $result2 = Db::table('commission')->query("SELECT * from commission where level_two_id = " . $rec['membership_id']);
            foreach ($result2 as $key => $value) {
                $result2[$key]['commission_receive'] = $value['level_two_commission'];
            }
            $result3 = Db::table('commission')->query("SELECT * from commission where level_three_id = " . $rec['membership_id']);
            foreach ($result3 as $key => $value) {
                $result3[$key]['commission_receive'] = $value['level_three_commission'];
            }
            $result = array_merge($result1, $result2, $result3);

            $newArr = array();

            foreach ($result as $key => $v) {
                $newArr[$key]['create_time'] = $v['create_time'];
            }
            array_multisort($newArr, SORT_DESC, $result);//SORT_DESC为降序，SORT_ASC为升序
            $data['rows'] = $result;
            $data['count'] = count($result);
            return $this->SuccessReturn('success', $data);
        } else {
            return $this->ErrorReturn($this->CommissionValidate->getError());
        }
    }


}