<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "formtdk".
 *
 * @property int $id
 * @property string $tdk
 */
class Formtdk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formtdk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tdk'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tdk' => 'Tdk',
        ];
    }
	public static function getOptions(){
		$data=  static::find()->orderBy(['tdk'=>SORT_ASC])->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'tdk','tdk'); //id = your ID model, name = your caption

		return $value;
	}
}
