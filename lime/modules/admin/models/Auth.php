<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Auth extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%admin_auth}}';
	}
}
?>