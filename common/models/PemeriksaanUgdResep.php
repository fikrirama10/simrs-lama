<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_ugd_resep".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $idpemeriksaan
 * @property int $idbayar
 * @property int $idobat
 * @property string $dosis
 * @property int $iduser
 * @property int $jumlah
 */
class PemeriksaanUgdResep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_ugd_resep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idpemeriksaan', 'idbayar', 'idobat', 'iduser', 'jumlah'], 'integer'],
            [['dosis'], 'string', 'max' => 50],
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
            'idpemeriksaan' => 'Idpemeriksaan',
            'idbayar' => 'Idbayar',
            'idobat' => 'Idobat',
            'dosis' => 'Dosis',
            'iduser' => 'Iduser',
            'jumlah' => 'Jumlah',
        ];
    }
	public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
}
