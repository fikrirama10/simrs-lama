<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dokumen_download".
 *
 * @property integer $Id
 * @property string $Kode
 * @property string $Waktu
 * @property string $IP
 * @property integer $UserId
 */
class DokumenDownload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokumen_download';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Waktu'], 'safe'],
            [['UserId'], 'integer'],
            [['Kode'], 'string', 'max' => 20],
            [['IP'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Kode' => 'Kode',
            'Waktu' => 'Waktu',
            'IP' => 'Ip',
            'UserId' => 'User ID',
        ];
    }

    public function getDokumen()
    {
        return $this->hasOne(Dokumen::className(), ['Kode' => 'Kode']);
    }

    
    
}
