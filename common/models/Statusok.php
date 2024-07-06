<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "statusok".
 *
 * @property int $id
 * @property string $status
 */
class Statusok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statusok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }
}
