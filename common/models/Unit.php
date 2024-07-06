<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property int $id
 * @property string $unit
 * @property string $ket
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit' => 'Unit',
            'ket' => 'Ket',
        ];
    }
}
