<?php
namespace app\common\validate;

use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        "goods_name|名称" => "require",
    ];
}
