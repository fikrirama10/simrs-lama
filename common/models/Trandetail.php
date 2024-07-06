<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trandetail".
 *
 * @property int $id
 * @property string $idtrx
 * @property int $idtindakan
 * @property int $harga
 * @property string $tanggal
 * @property int $jumlah
 * @property string $no_rm
 */
class Trandetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trandetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtindakan', 'harga', 'jumlah','idrawat'], 'integer'],
            [['tanggal'], 'safe'],
            [['idtrx', 'no_rm'], 'string', 'max' => 50],
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
            'harga' => 'Harga',
            'tanggal' => 'Tanggal',
            'jumlah' => 'Jumlah',
            'no_rm' => 'No Rm',
        ];
    }
	public function getTindakan()
    {
        return $this->hasOne(Tarif::className(), ['id' => 'idtindakan']);
    }
	public function getTransaksi()
    {
        return $this->hasOne(Transaksi::className(), ['idtrx' => 'idtrx']);
    }
}
