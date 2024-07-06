<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "keadaan".
 *
 * @property int $id
 * @property string $keaddan
 */
class Keadaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keadaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keaddan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keaddan' => 'Keaddan',
        ];
    }
}
