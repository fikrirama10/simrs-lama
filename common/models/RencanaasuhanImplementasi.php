<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rencanaasuhan_implementasi".
 *
 * @property int $id
 * @property string $implementasi
 * @property int $jenis
 * @property string $keterangan
 */
class RencanaasuhanImplementasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rencanaasuhan_implementasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['implementasi', 'keterangan'], 'string'],
            [['jenis'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'implementasi' => 'Implementasi',
            'jenis' => 'Jenis',
            'keterangan' => 'Keterangan',
        ];
    }
}
