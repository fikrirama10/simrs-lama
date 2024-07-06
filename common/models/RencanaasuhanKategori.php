<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rencanaasuhan_kategori".
 *
 * @property int $id
 * @property string $kategori
 * @property string $keterangan
 *
 * @property Rencanaasuhan[] $rencanaasuhans
 */
class RencanaasuhanKategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rencanaasuhan_kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kategori', 'keterangan'], 'string', 'max' => 50],
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
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRencanaasuhans()
    {
        return $this->hasMany(Rencanaasuhan::className(), ['idkategori' => 'id']);
    }
}
