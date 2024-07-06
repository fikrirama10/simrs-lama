<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_ranap_visite".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $iddokter
 * @property string $pemeriksaan_dokter
 * @property string $tanggal
 * @property string $catatan
 */
class PemeriksaanRanapVisite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_ranap_visite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'iddokter'], 'integer'],
            [['pemeriksaan_dokter', 'catatan'], 'string'],
            [['tanggal'], 'safe'],
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
            'iddokter' => 'Iddokter',
            'pemeriksaan_dokter' => 'Pemeriksaan Dokter',
            'tanggal' => 'Tanggal',
            'catatan' => 'Catatan',
        ];
    }
}
