<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hambatan".
 *
 * @property int $id
 * @property string $jenishambatan
 */
class Hambatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hambatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenishambatan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenishambatan' => 'Jenishambatan',
        ];
    }
}
