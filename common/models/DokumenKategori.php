<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dokumen_kategori".
 *
 * @property integer $Id
 * @property string $Kategori
 *
 * @property Dokumen[] $dokumens
 */
class DokumenKategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokumen_kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kategori'], 'string', 'max' => 20],
			[['Jumlah'], 'Integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Kategori' => 'Kategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumens()
    {
        return $this->hasMany(Dokumen::className(), ['IdKat' => 'Id']);
    }
}
