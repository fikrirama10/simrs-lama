<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kattindakanlab".
 *
 * @property int $id
 * @property int $kat
 * @property string $nama
 * @property string $ket
 *
 * @property Daflab $kat0
 * @property Subkattindakanlab[] $subkattindakanlabs
 */
class Kattindakanlab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kattindakanlab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kat','jenis'], 'integer'],
            [['ket','harga'], 'string'],
            [['nama'], 'string', 'max' => 50],
            [['kat'], 'exist', 'skipOnError' => true, 'targetClass' => Daflab::className(), 'targetAttribute' => ['kat' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kat' => 'Kat',
            'nama' => 'Nama',
            'ket' => 'Ket',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKat0()
    {
        return $this->hasOne(Daflab::className(), ['id' => 'kat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubkattindakanlabs()
    {
        return $this->hasMany(Subkattindakanlab::className(), ['idkat' => 'id']);
    }
    public static function getOptions(){
		$data=  static::find()->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'nama','nama'); //id = your ID model, name = your caption

		return $value;
	}
}
