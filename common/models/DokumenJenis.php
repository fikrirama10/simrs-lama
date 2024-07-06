<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dokumen_jenis".
 *
 * @property integer $Id
 * @property string $Jenis
 *
 * @property Dokumen[] $dokumens
 */
class DokumenJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokumen_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Jenis'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Jenis' => 'Jenis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumens()
    {
        return $this->hasMany(Dokumen::className(), ['IdJenis' => 'Id']);
    }
}
