<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class Chatcontents extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("message")) {
            $map['message'] = ["like", "%" . $this->request->param("message") . "%"];
        }
        if ($this->request->param("send_time")) {
            $map['send_time'] = ["like", "%" . $this->request->param("send_time") . "%"];
        }
    }
}
