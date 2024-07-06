<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rawat".
 *
 * @property int $id
 * @property int $idpengirim
 * @property string $waktudikirim
 * @property string $idrawat
 * @property string $rm
 * @property int $idp
 * @property string $status
 */
class Rawat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rawat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpengirim', 'idp'], 'integer'],
            [['waktudikirim'], 'safe'],
            [['idrawat', 'rm', 'status','ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpengirim' => 'Idpengirim',
            'waktudikirim' => 'Waktudikirim',
            'idrawat' => 'Idrawat',
            'rm' => 'Rm',
            'idp' => 'Idp',
            'status' => 'Status',
        ];
    }
	 public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'rm']);
    }
	 public function getJer()
    {
        return $this->hasOne(Jenisrawat::className(), ['id' => 'idp']);
    }
	 public function getRjalan()
    {
        return $this->hasOne(Rawatjalan::className(), ['idrawat' => 'idrawat']);
    }
	 public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'idpengirim']);
    }
}
