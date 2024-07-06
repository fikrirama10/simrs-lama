<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dafrad".
 *
 * @property int $id
 * @property string $jenispemeriksaan
 * @property double $tarif
 * @property string $ket
 */
class Dafrad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dafrad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarif'], 'number'],
            [['jenispemeriksaan', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenispemeriksaan' => 'Jenispemeriksaan',
            'tarif' => 'Tarif',
            'ket' => 'Ket',
        ];
    }
	public static function getOptions(){
		$data=  static::find()->orderBy(['jenispemeriksaan'=>SORT_ASC])->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'jenispemeriksaan','jenispemeriksaan'); //id = your ID model, name = your caption

		return $value;
	}
}
