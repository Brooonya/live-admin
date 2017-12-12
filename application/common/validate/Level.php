<?php
namespace app\common\validate;

use think\Validate;

class Level extends Validate
{
    protected $rule = [
        "level|等级" => "require",
        "name|等级名称" => "require",
    ];
}
