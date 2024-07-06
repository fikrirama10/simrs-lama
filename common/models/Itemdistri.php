<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "itemdistri".
 *
 * @property int $id
 * @property string $nodistri
 * @property int $idobat
 * @property int $idsatuan
 * @property int $jumlah
 * @property string $status
 */
class Itemdistri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemdistri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idobat', 'idsatuan', 'jumlah'], 'integer'],
            [['nodistri', 'status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nodistri' => 'Nodistri',
            'idobat' => 'Idobat',
            'idsatuan' => 'Idsatuan',
            'jumlah' => 'Jumlah',
            'status' => 'Status',
        ];
    }
	public function getFaktur()
    {
        return $this->hasOne(Distribusi::className(), ['nodistri' => 'nodistri']);
    }
	public function getNobat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
	public function getSatu()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'idsatuan']);
    }
}
