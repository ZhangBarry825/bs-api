<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\home\model;


use think\Validate;

class ChargeValidate extends Validate
{
    protected $rule=[

        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],
        ['key','require','key必须'],
        ['membership_id','require','membership_id必须'],
        ['charge_account','require','charge_account必须'],
        ['nickname','require','nickname必须'],

    ];
    protected $scene = [
        'lists'=>['membership_id','page_num','page_size'],
        'charge'  =>  ['membership_id','charge_account','nickname'],

    ];
}