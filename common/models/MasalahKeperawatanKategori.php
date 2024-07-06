<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan_kategori".
 *
 * @property int $id
 * @property string $kategori
 * @property string $ket
 *
 * @property MasalahKeperawatanSub[] $masalahKeperawatanSubs
 * @property MasalahKeperawatanTindakan[] $masalahKeperawatanTindakans
 */
class MasalahKeperawatanKategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan_kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kategori', 'ket'], 'string', 'max' => 50],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasalahKeperawatanSubs()
    {
        return $this->hasMany(MasalahKeperawatanSub::className(), ['idkategori' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasalahKeperawatanTindakans()
    {
        return $this->hasMany(MasalahKeperawatanTindakan::className(), ['idkategori' => 'id']);
    }
}
