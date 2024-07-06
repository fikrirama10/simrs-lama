<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dukkes_keluar_detail".
 *
 * @property int $id
 * @property string $kodetrx
 * @property int $idobat
 * @property int $qty
 * @property string $keterangan
 */
class DukkesKeluarDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dukkes_keluar_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idobat', 'qty'], 'integer'],
            [['keterangan'], 'string'],
            [['kodetrx'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodetrx' => 'Kodetrx',
            'idobat' => 'Idobat',
            'qty' => 'Qty',
            'keterangan' => 'Keterangan',
        ];
    }
	public function getObat()
    {
        return $this->hasOne(DukkesObat::className(), ['id' => 'idobat']);
    }
	
}
