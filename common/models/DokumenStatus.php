<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dokumen_status".
 *
 * @property integer $Id
 * @property string $Status
 *
 * @property Dokumen[] $dokumens
 */
class DokumenStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokumen_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Status'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumens()
    {
        return $this->hasMany(Dokumen::className(), ['IdStat' => 'Id']);
    }
}
