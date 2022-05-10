<?php 
namespace app\controllers;

use yii\web\Controller;
use yii\filters\Cors;
use app\models\Cylinder;
use yii\data\Pagination;

Class AdminController extends Controller
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
	public function actionIndex()
	{
		$request = \Yii::$app->request;
		if($request->isPost)
		{
			$post = $request->post();
			$query = Cylinder::find()->where(['barcode' => 'QY16']);
			$count = $query->count();
			$pagination = new Pagination(['totalCount' => $count,'pageSize'=>10]);
			$articles = $query->offset($pagination->offset)
		    ->limit($pagination->limit)
		    ->asArray()
		    ->all();
			\Yii::$app->response->data = [
				"data" => $articles,
			];
		}else{
			throw new \yii\web\UnauthorizedHttpException;
		}
	}
}