<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hubungan".
 *
 * @property int $id
 * @property string $hubungan
 * @property string $keterangan
 */
class Hubungan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hubungan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hubungan', 'keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hubungan' => 'Hubungan',
            'keterangan' => 'Keterangan',
        ];
    }
}
