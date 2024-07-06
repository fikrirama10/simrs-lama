<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "katbobat".
 *
 * @property int $id
 * @property string $kat
 * @property string $ket
 */
class Katbobat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'katbobat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ket'], 'string'],
            [['kat'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kat' => 'Kat',
            'ket' => 'Ket',
        ];
    }
}
