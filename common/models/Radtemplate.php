<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "radtemplate".
 *
 * @property int $id
 * @property string $kesan
 * @property string $keterangan
 * @property string $hasil
 * @property string $klinis
 */
class Radtemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'radtemplate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kesan', 'keterangan', 'hasil', 'klinis'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kesan' => 'Kesan',
            'keterangan' => 'Keterangan',
            'hasil' => 'Hasil',
            'klinis' => 'Klinis',
        ];
    }
}
