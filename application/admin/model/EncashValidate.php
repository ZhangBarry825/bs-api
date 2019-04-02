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

class EncashValidate extends Validate
{
    protected $rule=[
        ['id','require','id必须'],
        ['name','require','姓名必须'],
        ['nickname','require','昵称必须'],
        ['phone','require','手机号必须'],
        ['balance','require','余额必须'],
        ['expense','require','消费额必须'],
        ['create_time','require','创建时间必须'],
        ['password','require','密码必须'],
        ['referrer','require','推荐人必须'],
        ['membership_id','require','membership_id必须'],
        ['nickname','require','nickname必须'],
        ['account','require','account必须'],
        ['encash_type','require','encash_type必须'],
        ['status','require','status必须'],
        ['account','require','account必须'],

        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],
    ];
    protected $scene = [
        'updateEncash'=>['id','status','account','membership_id'],
        'resetPassword'=>['id'],
        'deleteEncash'=>['id'],
        'getEncash'=>['id'],
        'allEncash' =>['page_num','page_size'],
        'newEncash' =>['membership_id','nickname','account','encash_type'],
    ];
}