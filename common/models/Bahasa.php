<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bahasa".
 *
 * @property int $id
 * @property string $bahasa
 * @property string $kat
 */
class Bahasa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bahasa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kat'], 'string'],
            [['bahasa'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bahasa' => 'Bahasa',
            'kat' => 'Kat',
        ];
    }
}
