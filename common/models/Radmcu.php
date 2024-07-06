<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "radmcu".
 *
 * @property int $id
 * @property int $idrad
 * @property string $tanggal
 * @property int $usia
 * @property string $nama
 * @property string $alamat
 * @property string $dokter
 * @property string $kesan
 * @property string $klinis
 * @property string $hasil
 * @property string $nofoto
 */
class Radmcu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'radmcu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrad', 'status'], 'integer'],
            [['tanggal'], 'safe'],
            [['usia','alamat', 'kesan', 'klinis', 'hasil'], 'string'],
            [['nama', 'dokter', 'nofoto'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrad' => 'Idrad',
            'tanggal' => 'Tanggal',
            'usia' => 'Usia',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'dokter' => 'Dokter',
            'kesan' => 'Kesan',
            'klinis' => 'Klinis',
            'hasil' => 'Hasil',
            'nofoto' => 'Nofoto',
        ];
    }
	public function getDrad()
    {
        return $this->hasOne(Dafrad::className(), ['id' => 'idrad']);
    }
}
