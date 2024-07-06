<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dafusg".
 *
 * @property int $id
 * @property string $namausg
 * @property string $tarif
 */
class Dafusg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dafusg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['namausg', 'tarif'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namausg' => 'Namausg',
            'tarif' => 'Tarif',
        ];
    }
}
