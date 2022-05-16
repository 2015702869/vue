<?php 
namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\Cors;
use yii\data\Pagination;
use app\modules\admin\models\Login;
use app\modules\admin\models\Admin;

class LoginController extends Controller
{
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

	public function actionLogin()
	{
		$request = \Yii::$app->request;
		if($request->isPost)
		{
			$model = new Login;
			$model->attributes = $request->post();
			//表单验证
			if ($model->validate() && !empty(($request->post()))) {
			    $admin = new Admin();
			    $password = $request->post('password');
			    $username = $request->post('username');
			    $data = $admin->find()->where(['username'=>$username])->one();
			    if($data == null)//验证账号是否正确
			    {
			 		return \Yii::$app->response->data = [
						"data" => false
					];
			    }
			    //调用方法验证用户名密码是否正确
			    if(\Yii::$app->helper->decryption($password,$data['password']) === true)
			    {
			    	$session = \Yii::$app->session;
			    	$session->set('username',$data['username']);
			    	$session->set('nickname',$data['nickname']);
			    	return \Yii::$app->response->data = [
						"data" => true
					];
			    }else{
			    	return \Yii::$app->response->data = [
			    		"data" => false
			    	];
			    }
			} else {
				//验证失败返回
				$errors = $model->errors;
				\Yii::$app->response->data = [
					"data" => $errors
				];
			}
		}else{
			throw new \yii\web\UnauthorizedHttpException;//请求方法错误返回错误
		}
	}
	public function actionAdd()
	{
		/*$admin = new Admin();
		$admin->username = 'admin';
		$admin->password = '$2y$10$5IPx5paOU0snyClSkdYrxuZGykE.D9k8OFwBrhSTNVpvI6X9GYFka';
		$admin->nickname = '图文';
		$admin->save();*/
	}
}