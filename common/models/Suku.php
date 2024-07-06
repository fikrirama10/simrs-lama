<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "suku".
 *
 * @property int $id
 * @property string $suku
 */
class Suku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['suku'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'suku' => 'Suku',
        ];
    }
}
