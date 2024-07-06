<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kategori_melahirkan".
 *
 * @property int $id
 * @property string $kategori
 */
class KategoriMelahirkan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori_melahirkan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }
}
