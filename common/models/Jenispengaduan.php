<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenispengaduan".
 *
 * @property int $id
 * @property string $jenispengaduan
 */
class Jenispengaduan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenispengaduan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenispengaduan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenispengaduan' => 'Jenispengaduan',
        ];
    }
}
