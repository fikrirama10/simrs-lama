<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jadwaldokter".
 *
 * @property integer $id
 * @property integer $idhari
 * @property integer $iddokter
 * @property string $mulaijam
 * @property string $selesaijam
 *
 * @property Dokter $iddokter0
 * @property Hari $idhari0
 */
class Jadwaldokter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwaldokter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idhari', 'iddokter','kuota','idpoli'], 'integer'],
            [['mulaijam', 'selesaijam'], 'safe'],
            [['iddokter'], 'exist', 'skipOnError' => true, 'targetClass' => Dokter::className(), 'targetAttribute' => ['iddokter' => 'id']],
            [['idhari'], 'exist', 'skipOnError' => true, 'targetClass' => Hari::className(), 'targetAttribute' => ['idhari' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idhari' => 'Hari',
            'iddokter' => 'Dokter',
            'mulaijam' => 'Mulaijam',
            'selesaijam' => 'Selesaijam',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getdokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'iddokter']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function gethari()
    {
        return $this->hasOne(Hari::className(), ['id' => 'idhari']);
    }
}
