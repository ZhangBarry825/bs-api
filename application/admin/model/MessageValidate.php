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

class MessageValidate extends Validate
{
    protected $rule=[
        ['id','require','id必须'],
        ['title','require','标题必须'],
        ['content','require','内容必须'],
        ['content_short','require','摘要必须'],
        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],
    ];
    protected $scene = [
        'updateMessage'=>['id'],
        'deleteMessage'=>['id'],
        'getMessage'=>['id'],
        'allMessage' =>['page_num','page_size'],
        'newMessage' =>['title','content','content_short'],
    ];
}