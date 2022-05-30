<?php 
namespace app\modules\admin\controllers;
use app\commands\PackController;
use app\modules\admin\models\Admin;
class UnsController extends PackController
{
	public $enableCsrfValidation = false;//关闭csrf表单验证
	public function actionIndex()
	{
		$admin = Admin::findOne(2);
		\Yii::$app->response->data = [
			"data" => $admin,
		];
	}
}
?>