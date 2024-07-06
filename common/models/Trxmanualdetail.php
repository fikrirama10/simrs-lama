<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trxmanualdetail".
 *
 * @property int $id
 * @property string $trxid
 * @property int $idtindakan
 * @property string $tanggal
 * @property int $jumlah
 * @property int $harga
 * @property int $total
 * @property int $status
 * @property string $ket
 *
 * @property Trxmanual $trx
 */
class Trxmanualdetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trxmanualdetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trxid'], 'required'],
            [['idtindakan', 'jumlah', 'harga', 'total', 'status'], 'integer'],
            [['tanggal'], 'safe'],
            [['trxid', 'ket'], 'string', 'max' => 50],
            [['trxid'], 'exist', 'skipOnError' => true, 'targetClass' => Trxmanual::className(), 'targetAttribute' => ['trxid' => 'trxid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trxid' => 'Trxid',
            'idtindakan' => 'Idtindakan',
            'tanggal' => 'Tanggal',
            'jumlah' => 'Jumlah',
            'harga' => 'Harga',
            'total' => 'Total',
            'status' => 'Status',
            'ket' => 'Ket',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getTindakan()
    {
        return $this->hasOne(Tindakan::className(), ['id' => 'idtindakan']);
    }
    public function getTransaksi()
    {
        return $this->hasOne(Trxmanual::className(), ['trxid' => 'trxid']);
    }
}
