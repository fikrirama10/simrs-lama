<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_ranap_rad".
 *
 * @property int $id
 * @property int $idpemeriksaan
 * @property int $idrawat
 * @property string $tanggal
 * @property int $iddokter
 * @property int $idrad
 * @property int $status
 */
class PemeriksaanRanapRad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_ranap_rad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpemeriksaan', 'idrawat', 'iddokter', 'idrad', 'status'], 'integer'],
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
            'idpemeriksaan' => 'Idpemeriksaan',
            'idrawat' => 'Idrawat',
            'tanggal' => 'Tanggal',
            'iddokter' => 'Iddokter',
            'idrad' => 'Idrad',
            'status' => 'Status',
        ];
    }
}
