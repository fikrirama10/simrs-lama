<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rekamedis".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property int $iddokter
 * @property string $idrawat
 * @property int $bulan
 * @property string $tglpinjam
 * @property string $peminjam
 */
class Rekamedis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rekamedis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddokter', 'bulan'], 'integer'],
            [['tglpinjam'], 'safe'],
            [['no_rekmed', 'idrawat', 'peminjam'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'iddokter' => 'Iddokter',
            'idrawat' => 'Idrawat',
            'bulan' => 'Bulan',
            'tglpinjam' => 'Tglpinjam',
            'peminjam' => 'Peminjam',
        ];
    }
	 public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	 public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'iddokter']);
    }
}
