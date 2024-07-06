<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaksi_return".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $idtrx
 * @property int $idobat
 * @property int $qty
 * @property double $harga
 * @property double $total
 * @property int $status
 * @property string $tgl
 */
class TransaksiReturn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_return';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idtrx', 'idobat', 'qty', 'status'], 'integer'],
            [['harga', 'total'], 'number'],
            [['tgl'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrawat' => 'Idrawat',
            'idtrx' => 'Idtrx',
            'idobat' => 'Idobat',
            'qty' => 'Qty',
            'harga' => 'Harga',
            'total' => 'Total',
            'status' => 'Status',
            'tgl' => 'Tgl',
        ];
    }
}
