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

class SysUserValidate extends Validate
{
    protected $rule=[
        ['id','require','id必须'],
        ['name','require','姓名必须'],
        ['username','require','账号必须'],
        ['nickname','require','昵称必须'],
        ['password','require','密码必须'],
        ['old_password','require','原密码必须'],
        ['new_password','require','新密码必须'],
        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],
    ];
    protected $scene = [
        'login' => ['username','password'],
        'updateUserPwd'=>['id'],
        'deleteUser'=>['id'],
        'getUserDetail'=>['id'],
        'updatePwd'=>['new_password','old_password'],
        'allUsers' =>['page_num','page_size'],
        'newUser' =>['username','nickname','name','password'],
        'updateUser' =>['id','username','nickname','name','password'],
    ];
}