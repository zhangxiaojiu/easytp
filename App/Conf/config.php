<?php
return array(
	//'配置项'=>'配置值'
	'APP_GROUP_LIST' => 'Home,Admin',//项目分组名称
	'DEFAULT_GROUP' => 'Home',//默认分组名称
	'APP_GROUP_MODE' => 1,//项目分组方式，0 普通分组，1 独立分组
	'APP_GROUP_PATH' => 'Modules',//分组文件夹

	//开启URL路由
	'URL_ROUTER_ON' => true,
	'URL_ROUTE_RULES' =>array(
		//'常量/：get变量' => '映射地址'，
		'list/:id/:p' => 'Home/List/index',
		'page/:id' => 'Home/Page/index',
		'message/:id' => 'Home/Message/index',
		),
	//'SHOW_PAGE_TRACE' => true,
    //完整域名部署
    'APP_SUB_DOMAIN_DEPLOY' => true,
    'APP_SUB_DOMAIN_RULES'    =>    array(
        'ssc288888888.com'  => array('Home/Lottery'),
        'www.ssc288888888.com'   => array('Home/Lottery'),
        'ssc188888888.com'  => array('Home/'),
        'www.ssc188888888.com'   => array('Home/'),
        'admin.ssc188888888.com'   => array('Admin/')
    ),

	'LOAD_EXT_CONFIG' => 'mysqldb',
);