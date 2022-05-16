<?php 
namespace app\commands;

use yii\web\Controller;
use yii\filters\Cors;

class BackController extends Controller{
	public $enableCsrfValidation = false;//关闭csrf表单验证
	public function behaviors()
	{
		//设置请求头
	    return [
	        'corsFilter'=>[
	            'class' => Cors::className(),
	            'cors'=>[
	                'Access-Control-Allow-Credentials' => false,
	                'Origin' => ['*'],
	            ]
	        ]
	    ];
	}
	public function init(){
      	parent::init();
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;//设置返回类型
    }
}

?>