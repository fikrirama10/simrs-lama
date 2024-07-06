<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "revmcu".
 *
 * @property int $id
 * @property string $nofoto
 * @property string $kesan
 */
class Revmcu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'revmcu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kesan'], 'string'],
            [['nofoto'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nofoto' => 'Nofoto',
            'kesan' => 'Kesan',
        ];
    }
}
