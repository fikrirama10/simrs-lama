<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dokter".
 *
 * @property integer $id
 * @property integer $kodedokter
 * @property string $namadokter
 * @property integer $idpoli
 *
 * @property Poli $idpoli0
 * @property Jadwaldokter[] $jadwaldokters
 */
class Dokter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpoli'], 'integer'],
            [['kodedokter','namadokter','jeniskelamin'], 'string', 'max' => 50],
            [['idpoli'], 'exist', 'skipOnError' => true, 'targetClass' => Poli::className(), 'targetAttribute' => ['idpoli' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodedokter' => 'Kodedokter',
            'namadokter' => 'Namadokter',
            'idpoli' => 'Idpoli',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolie()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }
public function getPoli()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwaldokters()
    {
        return $this->hasMany(Jadwaldokter::className(), ['iddokter' => 'id']);
    }
}
