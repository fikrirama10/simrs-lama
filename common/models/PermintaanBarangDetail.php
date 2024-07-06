<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "permintaan_barang_detail".
 *
 * @property int $id
 * @property string $idpermintaan
 * @property string $tanggal
 * @property int $status
 * @property int $idobat
 * @property string $namaobat
 * @property int $qty
 * @property int $idsatuan
 * @property int $harga
 * @property int $total
 * @property int $idtrx
 * @property int $sisastok
 */
class PermintaanBarangDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permintaan_barang_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status', 'idobat', 'qty', 'idsatuan', 'harga', 'total', 'idtrx', 'sisastok'], 'integer'],
            [['idpermintaan', 'namaobat'], 'string', 'max' => 50],
            [['keterangan','namaobat'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpermintaan' => 'Idpermintaan',
            'tanggal' => 'Tanggal',
            'status' => 'Status',
            'idobat' => 'Idobat',
            'namaobat' => 'Namaobat',
            'qty' => 'Qty',
            'idsatuan' => 'Idsatuan',
            'harga' => 'Harga',
            'total' => 'Total',
            'idtrx' => 'Idtrx',
            'sisastok' => 'Sisastok',
        ];
    }
	public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
	public function getSatuan()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'idsatuan']);
    }
}
