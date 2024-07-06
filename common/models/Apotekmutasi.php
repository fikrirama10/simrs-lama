<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apotekmutasi".
 *
 * @property int $id
 * @property int $idobat
 * @property string $ket
 * @property int $jumlah
 * @property int $idsatuan
 * @property string $tanggal
 * @property int $idver
 */
class Apotekmutasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apotekmutasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idobat', 'jumlah', 'idsatuan', 'idver'], 'integer'],
            [['ket','status'], 'string'],
            [['tanggal'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idobat' => 'Idobat',
            'ket' => 'Ket',
            'jumlah' => 'Jumlah',
            'idsatuan' => 'Idsatuan',
            'tanggal' => 'Tanggal',
            'idver' => 'Idver',
        ];
    }
	public function getSatu()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'idsatuan']);
    }
}
