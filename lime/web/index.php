<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$config = require __DIR__ . '/../config/web.php';
header('Access-Control-Allow-Origin:http://localhost:8080'); // 
header("Access-Control-Allow-Headers:token");
header("Access-Control-Allow-Credentials:true");
(new yii\web\Application($config))->run();
