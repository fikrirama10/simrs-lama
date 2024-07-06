<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "penilaian".
 *
 * @property int $id
 * @property string $penilaian
 */
class Penilaian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penilaian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['penilaian'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'penilaian' => 'Penilaian',
        ];
    }
}
