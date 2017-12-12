<?php
namespace app\common\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        "title|标题" => "require",
        "typeid|分类" => "require",
    ];
}
