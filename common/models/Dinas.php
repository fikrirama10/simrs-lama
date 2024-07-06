<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dinas".
 *
 * @property int $id
 * @property string $dinas
 */
class Dinas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dinas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dinas'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dinas' => 'Dinas',
        ];
    }
}
