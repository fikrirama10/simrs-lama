<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rikkes_radiologi".
 *
 * @property int $id
 * @property string $namakegiatan
 * @property string $tanggal
 * @property string $keterangan
 * @property string $jenis
 */
class RikkesRadiologi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rikkes_radiologi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['keterangan', 'jenis'], 'string'],
            [['namakegiatan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namakegiatan' => 'Namakegiatan',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
            'jenis' => 'Jenis',
        ];
    }
}
