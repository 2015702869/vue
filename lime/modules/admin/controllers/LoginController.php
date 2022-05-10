<?php 
namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\Cors;
use yii\data\Pagination;
use app\modules\admin\models\Login;
use app\modules\admin\models\Admin;

class LoginController extends Controller
{
	public $enableCsrfValidation = false;
	public function behaviors()
	{
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
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }
	public function actionLogin()
	{
		$request = \Yii::$app->request;
		if($request->isPost)
		{
			$model = new Login;
			$model->attributes = $request->post();
			if ($model->validate() && !empty(($request->post()))) {
			    $admin = new Admin();
			    $password = $request->post('password');
			    $username = $request->post('username');
			    $data = $admin->find()->where(['username'=>$username])->one();

			    \Yii::$app->response->data = [
					"data" => \Yii::$app->helper->decryption($password,$data['password'])
				];
			} else {
				$errors = $model->errors;
				\Yii::$app->response->data = [
					"data" => $errors
				];
			}
		}else{
			throw new \yii\web\UnauthorizedHttpException;
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