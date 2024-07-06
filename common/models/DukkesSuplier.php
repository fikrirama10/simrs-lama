<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dukkes_suplier".
 *
 * @property int $id
 * @property string $suplier
 * @property string $asal
 * @property string $keterangan
 */
class DukkesSuplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dukkes_suplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asal', 'keterangan'], 'string'],
            [['suplier'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'suplier' => 'Suplier',
            'asal' => 'Asal',
            'keterangan' => 'Keterangan',
        ];
    }
}
