<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaksimanualdetail".
 *
 * @property int $id
 * @property string $idtrx
 * @property int $idtindakan
 * @property int $jumlah
 * @property int $harga
 * @property int $total
 * @property string $tanggal
 * @property int $status
 */
class Transaksimanualdetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksimanualdetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtindakan', 'jumlah', 'harga', 'total', 'status'], 'integer'],
            [['tanggal'], 'safe'],
            [['idtrx'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idtrx' => 'Idtrx',
            'idtindakan' => 'Idtindakan',
            'jumlah' => 'Jumlah',
            'harga' => 'Harga',
            'total' => 'Total',
            'tanggal' => 'Tanggal',
            'status' => 'Status',
        ];
    }
}
