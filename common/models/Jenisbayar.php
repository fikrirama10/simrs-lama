<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenisbayar".
 *
 * @property integer $id
 * @property string $jenisbayar
 */
class Jenisbayar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenisbayar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenisbayar'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenisbayar' => 'Jenisbayar',
        ];
    }
}
