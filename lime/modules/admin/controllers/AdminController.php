<?php 
namespace app\modules\admin\controllers;
use app\commands\BackController;
use app\modules\admin\models\Admin;
use yii\data\Pagination;
class AdminController extends BackController
{
	public $enableCsrfValidation = false;//关闭csrf表单验证
	public function actionIndex()
	{
		$request = \Yii::$app->request;
		if($request->isPost)
		{
			$get = $request->get('page',0);
			$page = $get-1;
			$offset = $page * 10;
			$admin = Admin::find()
			->select(['lime_admin.id','username','nickname','status'])
			->joinWith(['tags' => function ($query){
			       /* $query->onCondition(['{{%admin_auth}}.id' => 1]);*/
			    },
			])
			->offset($offset)
			->limit(10)
			->asArray()
			->all();
			\Yii::$app->response->data = [
				"data" => $admin,
			];
		}else{
			\Yii::$app->response->data = [
				"data" => "网络异常，稍后再试",
			];
		}
	}
	public function actionAdd()
	{
		$session = \Yii::$app->session;
		$request = \Yii::$app->request;
		$session_id = $request->post('session_id');
		$accion = $session->get($session_id);//获取session中的token
		if ($session->has($session_id))
		{
			if($accion == $request->post('accion'))//和传过来的token进行验证
			{
				\Yii::$app->response->data = [
					"data" => $session->get($session_id),
				];
			}else{
				\Yii::$app->response->data = [
					"data" => '异常登录，请重新登录',
				];
			}
		}else{
			\Yii::$app->response->data = [
				"data" => '异常登录，请重新登录',
			];
		}
	}
}
?>