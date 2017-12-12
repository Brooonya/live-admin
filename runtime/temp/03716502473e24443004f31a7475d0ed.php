<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"D:\phpStudy\WWW\master\public/../application/admin\view\article\edit.html";i:1513066788;s:74:"D:\phpStudy\WWW\master\public/../application/admin\view\template\base.html";i:1512461756;s:85:"D:\phpStudy\WWW\master\public/../application/admin\view\template\javascript_vars.html";i:1512461756;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title><?php echo \think\Config::get('site.title'); ?></title>
    <link rel="Bookmark" href="__ROOT__/favicon.ico" >
    <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__LIB__/html5.js"></script>
    <script type="text/javascript" src="__LIB__/respond.min.js"></script>
    <script type="text/javascript" src="__LIB__/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css"/>
    
    <!--[if IE 6]>
    <script type="text/javascript" src="__LIB__/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--定义JavaScript常量-->
<script>
    window.THINK_ROOT = '<?php echo \think\Request::instance()->root(); ?>';
    window.THINK_MODULE = '<?php echo \think\Url::build("/" . \think\Request::instance()->module(), "", false); ?>';
    window.THINK_CONTROLLER = '<?php echo \think\Url::build("___", "", false); ?>'.replace('/___', '');
</script>
</head>
<body>

<nav class="breadcrumb">
    <div id="nav-title"></div>
    <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:;" title="刷新"><i class="Hui-iconfont"></i></a>
</nav>


<!--layui的css可能与H-ui有点冲突 滚动条没有了~-->
<link rel="stylesheet" href="/static/admin/layui/css/layui.css">
<div class="page-container" style="padding-top: 60px;">
    <form class="form form-horizontal" id="form" method="post" action="<?php echo \think\Request::instance()->baseUrl(); ?>">
        <input type="hidden" name="id" value="<?php echo isset($vo['id']) ? $vo['id'] :  ''; ?>">
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">标题：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="标题" name="title" value="<?php echo isset($vo['title']) ? $vo['title'] :  ''; ?>" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">URL：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <?php if(!(empty($vo['url']) || (($vo['url'] instanceof \think\Collection || $vo['url'] instanceof \think\Paginator ) && $vo['url']->isEmpty()))): ?>
                <input type="text" class="input-text" placeholder="URL" name="url" value="<?php echo isset($vo['url']) ? $vo['url'] :  ''; ?>" >
                <?php else: ?>
                <button type="button" class="layui-btn" id="test1">
                    <i class="layui-icon">&#xe67c;</i>上传文件
                </button>
                <input type="hidden" value="" id="file" name="url">
                <span id="showFileName"></span>
                <?php endif; ?>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">分类：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <!--<input type="text" class="input-text" placeholder="分类" name="typeid" value="<?php echo isset($vo['typeid']) ? $vo['typeid'] :  ''; ?>" >-->
                <select name="typeid" id="">
                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vv['id']; ?>"><?php echo $vv['typename']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">点击次数：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="点击次数 可为空" name="click_number" value="<?php echo isset($vo['click_number']) ? $vo['click_number'] :  ''; ?>" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">下载次数：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="下载次数 可为空" name="download_number" value="<?php echo isset($vo['download_number']) ? $vo['download_number'] :  ''; ?>" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">内容：</label>
            <div class="formControls col-xs-6 col-sm-6" style="width:70%;">
                <!--<input type="text" class="input-text" placeholder="内容" name="content" value="<?php echo isset($vo['content']) ? $vo['content'] :  ''; ?>" >-->
                <!-- 加载编辑器的容器 -->
                <script id="container" name="content" type="text/plain">
                </script>
                <!-- 配置文件 -->
                <script type="text/javascript" src="/static/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
                <!-- 编辑器源码文件 -->
                <script type="text/javascript" src="/static/admin/lib/ueditor/1.4.3/ueditor.all.js"></script>
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    console.log(ue);
                </script>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-primary radius">&nbsp;&nbsp;提交&nbsp;&nbsp;</button>
                <button type="button" class="btn btn-default radius ml-20" onClick="layer_close();">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>

<script type="text/javascript" src="/static/admin/layui/layui.js"></script>
<script type="text/javascript" src="__LIB__/Validform/5.3.2/Validform.min.js"></script>
<script>
    $(function () {


        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form").Validform({
            tiptype: 2,
            ajaxPost: true,
            showAllError: true,
            callback: function (ret){
                ajax_progress(ret);
            }
        });

        layui.use('upload', function(){
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                ,url: '/admin/upload/image' //上传接口
                ,accept:'file'
                ,done: function(res){
                    //上传完毕回调
                    $('#file').val(res.src);
                    $('#showFileName').html(res.src);
                }
                ,error: function(){
                    //请求异常回调
                }
            });
        });

    })
</script>

</body>
</html>