<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */

namespace app\admin\model;


use think\Validate;

class OrderValidate extends Validate
{
    protected $rule=[
        ['shopper','require','shopper必须'],
        ['shopper_id','require','shopper_id必须'],
        ['nickname','require','nickname必须'],
        ['name','require','name必须'],
        ['membership_id','require','membership_id必须'],
        ['status','require','status必须'],
        ['contacts','require','contacts必须'],
        ['phone','require','phone必须'],
        ['address','require','address必须'],
        ['express_company','require','express_company必须'],
        ['express_code','require','express_code必须'],
        ['express_cost','require','express_cost必须'],
        ['price','require','price必须'],
        ['reresh_type','require','更新类型reresh_type必须'],


        ['create_time','require','创建时间必须'],
        ['id','require','id必须'],
        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],

    ];
    protected $scene = [
        'create' => ['shopper','shopper_id','nickname','name','membership_id','price','express_cost',
            'status','contacts','phone','address'],
        'update'  =>  ['id'],
        'delete'  =>  ['id'],
        'lists'  =>['page_num','page_size'],
        'detail'  =>['id'],
        'search' =>['key','page_num','page_size']
    ];
}