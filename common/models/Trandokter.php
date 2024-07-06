<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trandokter".
 *
 * @property int $id
 * @property string $namadokter
 */
class Trandokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trandokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['namadokter'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namadokter' => 'Namadokter',
        ];
    }
}
