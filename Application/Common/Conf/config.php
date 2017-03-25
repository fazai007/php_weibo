<?php
return array(
    //开启调试模式
    'SHOW_PAGE_TRACE'=>true,
    //模块访问权限
    'MODULE_ALLOW_LIST' => array('Home','Admin'),
    'DEFAULT_MODULE' => 'Home',
    //设置模板文件后缀
    'TMPL_TEMPLATE_SUFFIX' => '.tpl',
    //上传文件根目录
    'UPLOADS' => __ROOT__.'/Uploads',
    //模板常量设置
    'TMPL_PARSE_STRING' => array(
        '__UPLOADS__' => __ROOT__.'/Uploads',
        
        '__CSS__' => __ROOT__.'/Public/css',
        '__JS__' => __ROOT__.'/Public/js',
        '__IMG__' => __ROOT__.'/Public/img',
        '__UPLOADIFY__' => __ROOT__.'/Public/uploadify',

        //前台文件路径
        '__HOME_JS__' => __ROOT__.'/Application/Home/View/js',
        '__HOME_CSS__' => __ROOT__.'/Application/Home/View/css',
        '__HOME_IMG__' => __ROOT__.'/Application/Home/View/img',

        //后台文件路径
        '__ADMIN__' => __ROOT__.'/Application/Admin',
        '__ADMIN_JS__' => __ROOT__.'/Application/Admin/View/js',
        '__ADMIN_CSS__' => __ROOT__.'/Application/Admin/View/css',
        '__EASYUI__' => __ROOT__.'/Application/Admin/View/jquery-easyui',
    ),
    //cookie密钥
    'COOKIE_KEY' => 'www.fazaiblog.com',
    //缓存设置
    'DATA_CACHE_TYPE' => 'Memcache',
    'DATA_CACHE_TIME' => 600,
);