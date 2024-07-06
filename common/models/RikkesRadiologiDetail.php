<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rikkes_radiologi_detail".
 *
 * @property int $id
 * @property int $idrikes
 * @property string $nama
 * @property string $nomer_tes
 * @property int $usia
 * @property string $tgl_lahir
 * @property string $pemeriksaan
 * @property string $kesan
 * @property string $kualifikasi
 */
class RikkesRadiologiDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rikkes_radiologi_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrikes', 'usia'], 'integer'],
            [['tgl_lahir'], 'safe'],
            [['pemeriksaan', 'kesan','nofoto'], 'string'],
            [['nama', 'nomer_tes', 'kualifikasi'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrikes' => 'Idrikes',
            'nama' => 'Nama',
            'nomer_tes' => 'Nomer Tes',
            'usia' => 'Usia',
            'tgl_lahir' => 'Tgl Lahir',
            'pemeriksaan' => 'Pemeriksaan',
            'kesan' => 'Kesan',
            'kualifikasi' => 'Kualifikasi',
        ];
    }
}
