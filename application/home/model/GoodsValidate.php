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

class GoodsValidate extends Validate
{
    protected $rule=[
        ['id','require','id必须'],
        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],

    ];
    protected $scene = [
        'lists'  =>['page_num','page_size'],
        'detail'  =>['id'],
        'search' =>['key','page_num','page_size']
    ];
}