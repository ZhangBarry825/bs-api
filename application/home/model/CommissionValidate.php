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

class CommissionValidate extends Validate
{
    protected $rule=[
        ['title','require|max:100','标题必须'],
        ['type','require','文章类型必须'],
        ['status','require','状态必须'],
        ['create_time','require','发布时间必须'],
        ['update_time','require','修改时间必须'],
        ['description','require','摘要必须'],
        ['membership_id','require','membership_id必须'],
        ['content','require','内容必须'],
        ['id','require','文章id必须'],
        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],
        ['key','require','key必须'],
        ['pid','require','pid必须'],
        ['contacts','require','contacts必须'],
        ['phone','require','phone必须'],
        ['address','require','address必须'],

    ];
    protected $scene = [
        'create' => ['contacts','phone','address','membership_id'],
        'update'  =>  ['id','title','type','status','update_time','description','content'],
        'delete'  =>  ['id'],
        'lists'  =>['page_num','page_size','membership_id'],
        'detail'  =>['id'],
        'search' =>['key','page_num','page_size'],
        'area' =>['pid']
    ];
}