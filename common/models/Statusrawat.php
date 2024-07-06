<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "statusrawat".
 *
 * @property integer $id
 * @property string $status
 */
class Statusrawat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statusrawat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }
}
