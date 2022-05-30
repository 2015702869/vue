<?php 
namespace app\commands;

use yii\web\Controller;
use yii\filters\Cors;

class BackController extends Controller{
	public $enableCsrfValidation = false;//关闭csrf表单验证
	public function init(){
      	parent::init();
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;//设置返回类型
    }
    public function beforeAction( $action ){
    	$cmd = $action->controller->module->id.'/'.$action->controller->id.'/'.$func = $action->id;	
    	if($cmd == 'admin/login/login')
    	{
    		return true;
    	}else{
    		$session = \Yii::$app->session;
			$request = \Yii::$app->request;
			$session_id = $request->post('session_id');
			$accion = $session->get($session_id);//获取session中的token
			if ($session->has($session_id))
			{
				if($accion == $request->post('accion'))//和传过来的token进行验证
				{
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
    	}
	}
}

?>