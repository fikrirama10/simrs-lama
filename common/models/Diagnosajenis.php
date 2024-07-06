<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diagnosajenis".
 *
 * @property int $id
 * @property string $jenis
 */
class Diagnosajenis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosajenis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis' => 'Jenis',
        ];
    }
}
