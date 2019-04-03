<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\admin\controller;



use think\Db;

class Statistics extends Base
{
    protected $Statistics;
    protected $StatisticsValidate;


    public function __construct()
    {
        parent::__construct();
//        $this->Statistics = new StatisticsModel();
//        $this->StatisticsValidate = new StatisticsValidate();
    }

    public function index()
    {
        return 'admin/statistics/index';
    }


    public function orderList(){
        $start=mktime(0,0,0,date('m'),1,date('Y'));
        $result=Db::table('order')->where('create_time','>=',$start)->select();
        $count=count($result);
        $days=date("t");
        $data['days']=$days+0;
        $data['count']=$count;
        for($i=0;$i<$days;$i++){
            $map['create_time'] = ['between time', [$start+86400*($i), $start+86400*($i+1)]];
//            $data['rows'][$i]['detail']=Db::table('order')->where($map)->select();
            $data['rows'][$i]=Db::table('order')->where($map)->count();
//            $data['rows'][$i]['day']=$i+1;
        }
        return $this->SuccessReturn('success',$data);
    }

    public function saleAccount(){
        $start=mktime(0,0,0,date('m'),1,date('Y'));
        $result=Db::table('order')->where('status','=',3)->where('create_time','>=',$start)->select();
        $count=count($result);
        $days=date("t");
        $data['days']=$days+0;
        $data['count']=$count;
        $account=0;
        for($i=0;$i<$days;$i++){
            $map['create_time'] = ['between time', [$start+86400*($i), $start+86400*($i+1)]];
            $map['status'] = 3;
            $rows=Db::table('order')->where($map)->select();
            $itemAccount=0;
            foreach ($rows as $key=>$value){
                $itemAccount+=$value['price'];
            }
            $data['rows'][$i]=$itemAccount;
            $account+=$itemAccount;
        }
        $data['account']=$account;
        return $this->SuccessReturn('success',$data);
    }

    public function shopperList(){
        $start=mktime(0,0,0,date('m'),1,date('Y'));
        $result=Db::table('membership')->where('status','=',2)->where('create_time','>=',$start)->select();
        $count=count($result);
        $days=date("t");
        $data['days']=$days+0;
        $data['count']=$count;
        for($i=0;$i<$days;$i++){
            $map['create_time'] = ['between time', [$start+86400*($i), $start+86400*($i+1)]];
            $map['status'] =2;
            $data['rows'][$i]=Db::table('membership')->where($map)->count();
        }
        return $this->SuccessReturn('success',$data);
    }

    public function payCommission(){
        $start=mktime(0,0,0,date('m'),1,date('Y'));
        $result=Db::table('commission')->where('create_time','>=',$start)->select();
        $count=count($result);
        $days=date("t");
        $data['days']=$days+0;
        $data['count']=$count;
        $account=0;
        for($i=0;$i<$days;$i++){
            $map['create_time'] = ['between time', [$start+86400*($i), $start+86400*($i+1)]];
            $result2=Db::table('commission')->where($map)->select();
            $commission_account=0;
            foreach ($result2 as $key=>$value){
                $commission_account+=$value['commission_account'];
            }
            $data['rows'][$i]=$commission_account;
            $account+=$commission_account;
        }
        $data['account']=$account;
        return $this->SuccessReturn('success',$data);
    }
}