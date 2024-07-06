<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tableicd".
 *
 * @property int $id
 * @property string $Kode
 * @property string $Inggris
 * @property string $Indonesia
 */
class Tableicd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tableicd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Kode', 'Inggris', 'Indonesia'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Kode' => 'Kode',
            'Inggris' => 'Inggris',
            'Indonesia' => 'Indonesia',
        ];
    }
}
