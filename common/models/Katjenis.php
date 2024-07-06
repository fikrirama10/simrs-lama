<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "katjenis".
 *
 * @property int $id
 * @property string $katjenis
 */
class Katjenis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'katjenis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['katjenis'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'katjenis' => 'Katjenis',
        ];
    }
}
