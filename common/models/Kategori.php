<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property int $id
 * @property string $kategori
 * @property string $ket
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ket'], 'string'],
            [['kategori'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori' => 'Kategori',
            'ket' => 'Ket',
        ];
    }
}
