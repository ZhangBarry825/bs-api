<?php
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
