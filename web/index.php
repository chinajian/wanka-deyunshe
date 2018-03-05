<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require_once(__DIR__ . '/../component/fn.php');//引入全局函数文件

$config = require __DIR__ . '/../config/web.php';

require_once(__DIR__ . '/../config/constant.php');//引入常量

(new yii\web\Application($config))->run();
