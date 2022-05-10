<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Cylinder extends ActiveRecord
{
	public static function tableName()
    {
        return '{{wxpjg_cylinder}}';
    }
}