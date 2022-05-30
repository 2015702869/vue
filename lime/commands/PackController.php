<?php 
namespace app\commands;

use yii\web\Controller;

class PackController extends Controller
{
	public function init(){
      	parent::init();
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;//设置返回类型
    }
    public function beforeAction( $action ){
    	// 设为星号，表示同意任意跨源请求。也可配置特定的域名可访问 如: https://www.xxxx.com
		return true;
	}
}
?>