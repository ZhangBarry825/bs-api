<?php
/**
 * Created by PhpStorm.
 * User:  barry
 * Email: 530027054@qq.com
 * Date:  2019/3/20
 * Time:  15:31
 */
namespace app\admin\controller;

use app\admin\model\ArticleModel;
use app\admin\model\ArticleValidate;

class Index extends Base
{
    public function __construct()
    {
        $this->needUser=false;
        parent::__construct();

    }
    public function index()
    {
        return $this->SuccessReturn();
    }
}
