<?php
namespace app\common\validate;

use think\Validate;

class Group extends Validate
{
    protected $rule = [
        "name|名称" => "require",
        "check_msg|审核发言" => "require",
        "check_setup|权限" => "require",
    ];
}
