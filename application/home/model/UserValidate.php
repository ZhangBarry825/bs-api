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

class UserValidate extends Validate
{
    protected $rule=[
        ['phone','require','手机号必须'],
        ['password','require','密码必须'],
        ['old_password','require','原密码必须'],
        ['new_password','require','新密码必须']
    ];
    protected $scene = [
        'login' => ['phone','password'],
        'updatePwd'=>['new_password','old_password']
    ];
}