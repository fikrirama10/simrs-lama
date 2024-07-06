<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dokumen_type".
 *
 * @property integer $Id
 * @property string $Type
 *
 * @property Dokumen[] $dokumens
 */
class DokumenType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokumen_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Type'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumens()
    {
        return $this->hasMany(Dokumen::className(), ['IdType' => 'Id']);
    }
}
