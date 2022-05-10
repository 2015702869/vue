<?php
namespace app\modules\admin\models;

use yii\base\Model;
use yii\captcha\Captcha;

class Login extends Model
{
	public $username;
	public $password;
	public $inputcaptcha;
	
	public function rules()
	{
		return [
			['username','required','message' => '用户名不能为空'],
			['password','required','message' => '密码不能为空'],
			['inputcaptcha', 'required', 'message' => '请填写验证码'],
		];
	}
} 