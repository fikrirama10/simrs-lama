<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "folmulir".
 *
 * @property int $id
 * @property string $jenisform
 */
class Folmulir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folmulir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenisform'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenisform' => 'Jenisform',
        ];
    }
	public static function getOptions(){
		$data=  static::find()->orderBy(['jenisform'=>SORT_ASC])->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'jenisform','jenisform'); //id = your ID model, name = your caption

		return $value;
	}

}
