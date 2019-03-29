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

class GoodsValidate extends Validate
{
    protected $rule=[
        ['name','require','名称必须'],
        ['price','require','价格必须'],
        ['type_id','require','分类必须'],
        ['specification','require','属性必须'],
        ['pic1','require','图片1必须'],
        ['pic2','require','图片2必须'],
        ['pic3','require','图片3必须'],
        ['stock','require','库存必须'],
        ['content','require','内容必须'],
        ['status','require','状态必须'],
        ['express_cost','require','运费必须'],

        ['create_time','require','创建时间必须'],
        ['id','require','id必须'],
        ['page_num','require','page_num必须'],
        ['page_size','require','page_size必须'],

    ];
    protected $scene = [
        'create' => ['name','price','type_id','specification','pic1','pic2','pic3','stock','content','express_cost'],
        'update'  =>  ['id','name','price','type_id','specification','pic1','pic2','pic3','stock','content','express_cost'],
        'delete'  =>  ['id'],
        'lists'  =>['page_num','page_size'],
        'detail'  =>['id'],
        'search' =>['key','page_num','page_size']
    ];
}