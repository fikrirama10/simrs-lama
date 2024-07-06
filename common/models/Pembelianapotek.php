<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pembelianapotek".
 *
 * @property int $id
 * @property int $idobat
 * @property string $tanggal
 * @property int $idver
 * @property int $idsup
 * @property int $jumlah
 * @property string $nofaktur
 * @property string $harga
 * @property string $bayar
 * @property int $status
 * @property int $sisabayar
 * @property int $idsatuan
 */
class Pembelianapotek extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembelianapotek';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idver', 'idsup', 'status', 'sisabayar'], 'integer'],
            [['tanggal'], 'safe'],
            [['bayar','total'], 'number'],
            [['nofaktur'], 'string', 'max' => 50],
			[['nofaktur'],'unique']
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
            'tanggal' => 'Tanggal',
            'idver' => 'Idver',
            'idsup' => 'Idsup',
            'jumlah' => 'Jumlah',
            'nofaktur' => 'Nofaktur',
            'harga' => 'Harga',
            'bayar' => 'Bayar',
            'status' => 'Status',
            'sisabayar' => 'Sisabayar',
            'idsatuan' => 'Idsatuan',
        ];
    }
	public function getSupli()
    {
        return $this->hasOne(Suplier::className(), ['id' => 'idsup']);
    }
	public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
}
