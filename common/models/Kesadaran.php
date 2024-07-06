<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kesadaran".
 *
 * @property int $id
 * @property string $kesadaran
 * @property string $ket
 */
class Kesadaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kesadaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kesadaran', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kesadaran' => 'Kesadaran',
            'ket' => 'Ket',
        ];
    }
}
