<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "triage".
 *
 * @property int $id
 * @property string $warna
 * @property string $kategori
 */
class Triage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'triage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['warna', 'kategori'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warna' => 'Warna',
            'kategori' => 'Kategori',
        ];
    }
}
