<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Loader;
use think\Config;
use think\Db;

class Group extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete]);

        // 特殊过滤器，后缀是方法名的
        $actionFilter = 'filter' . $this->request->action();

        if (method_exists($this, $actionFilter)) {
            $this->$actionFilter($map);
        }

        // 自定义过滤器
        if (method_exists($this, 'filter')) {
            $this->filter($map);
        }

        $list = $this->datalist($model, $map, $field = null, $sortBy = '', $asc = false, $return = true, $paginate = true);
        foreach($list as $key=>$val){
            $list[$key]->check_setup = json_decode($list[$key]->check_setup,true);
        }

        // 模板赋值显示
        $this->view->assign('list', $list);
        $this->view->assign("count", count($list));
        $this->view->assign("page", '');
        $this->view->assign('numPerPage', 0);

        //查询权限设置表
        $setup = collection(Db::table('tp_setupmenu')->select())->toArray();

        return $this->view->fetch('index',array('setup'=>$setup));
    }


    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 更新
            $data = $this->request->post();
            $data['check_setup'] = json_encode($data['check_setup']);
            return Db::table('tp_group')->where(['id'=>$data['id']])->update($data);
            //return 1;
        } else {
            // 编辑
            $id = $this->request->param('id');
            if (!$id) {
                throw new HttpException(404, "缺少参数ID");
            }
            $vo = $this->getModel($controller)->find($id);
            if (!$vo) {
                throw new HttpException(404, '该记录不存在');
            }
            //转化json数据
            $vo->check_setup = json_decode( $vo->check_setup,true);
            //查询权限设置表
            $setup = collection(Db::table('tp_setupmenu')->select())->toArray();
            $this->view->assign("setup", $setup);
            $this->view->assign("vo", $vo);

            return $this->view->fetch();
        }
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 插入
            $data = $this->request->except(['id']);
            $data['check_setup'] = json_encode($data['check_setup']);
            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }

            // 写入数据
            if (
                class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
                || class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
            ) {
                //使用模型写入，可以在模型中定义更高级的操作
                $model = new $modelClass();
                $ret = $model->isUpdate(false)->save($data);
            } else {
                // 简单的直接使用db写入
                Db::startTrans();
                try {
                    $model = Db::name($this->parseTable($controller));
                    $ret = $model->insert($data);
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();

                    return ajax_return_adv_error($e->getMessage());
                }
            }

            return ajax_return_adv('添加成功');
        } else {
            //查询权限设置表
            $setup = collection(Db::table('tp_setupmenu')->select())->toArray();
            // 添加
            return $this->view->fetch(isset($this->template) ? $this->template : 'edit',['setup'=>$setup]);
        }
    }
}
