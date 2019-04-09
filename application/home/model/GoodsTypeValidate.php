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

class GoodsTypeValidate extends Validate
{
    protected $rule=[
        ['name','require','名称必须'],
        ['children','require','子分类必须'],
        ['avatar','require','图片必须'],
        ['children','require','子分类必须'],
        ['create_time','require','发布时间必须'],
        ['id','require','id必须'],
        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],

    ];
    protected $scene = [
        'create' => ['name','children'],
        'update'  =>  ['id','name','children'],
        'delete'  =>  ['id'],
        'lists'  =>['page_num','page_size'],
        'detail'  =>['id'],
        'search' =>['key','page_num','page_size']
    ];
}