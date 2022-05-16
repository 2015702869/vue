<?php 
namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\modules\admin\models\Login;
use app\modules\admin\models\Admin;
use app\commands\BackController;

class LoginController extends BackController
{
	public $enableCsrfValidation = false;//关闭csrf表单验证
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
	/**
	 * 首页
	 */
	public function actionAdd()
	{
		return \Yii::$app->controller->module->id.'/'.\Yii::$app->controller->id.'/'.\Yii::$app->controller->action->id;	
	}
}