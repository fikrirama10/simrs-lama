<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diagnosaranap".
 *
 * @property int $id
 * @property string $idrawat
 * @property int $idjenisrawat
 * @property string $kdiagnosa
 * @property int $jenis
 * @property string $tgl
 * @property string $rm
 * @property int $pemeriksa
 */
class Diagnosaranap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosaranap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idjenisrawat', 'jenis', 'pemeriksa'], 'integer'],
            [['tgl','df'], 'safe'],
            [['jenis'], 'required'],
            [['idrawat', 'rm'], 'string', 'max' => 50],
            [['kadiagnosa','kd'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrawat' => 'Idrawat',
            'idjenisrawat' => 'Idjenisrawat',
            'kdiagnosa' => 'Kdiagnosa',
            'jenis' => 'Jenis',
            'tgl' => 'Tgl',
            'rm' => 'Rm',
            'pemeriksa' => 'Pemeriksa',
        ];
    }
	 public function getJenisdiag()
    {
        return $this->hasOne(Diagnosajenis::className(), ['id' => 'jenis']);
    }
	public function getRawatja()
    {
        return $this->hasOne(Rawatjalan::className(), ['idrawat' => 'idrawat']);
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'rm']);
    }
	public function getIcd()
    {
        return $this->hasOne(Tableicd::className(), ['kode' => 'kd']);
    }

}
