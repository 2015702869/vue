<?php 
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Admin extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%admin}}';
	}
    public function getTags(){
        return $this->hasOne(Auth::className(),['id'=>'auth_id'])
            ->viaTable('lime_admin_gour',['admin_id'=>'id'])
            ->asArray();
    }
    public function getOrders()
    {
        return $this->hasMany(Auth::className(), ['id' => 'id']);
    }
}