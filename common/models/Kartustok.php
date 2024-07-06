<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kartustok".
 *
 * @property int $id
 * @property int $idobat
 * @property string $tgl
 * @property int $stokawal
 * @property int $qty
 * @property int $stokakhir
 * @property int $idtkp
 * @property string $trxid
 * @property int $user
 * @property int $idtrx
 */
class Kartustok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kartustok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idobat', 'stokawal', 'qty', 'stokakhir', 'idtkp', 'user','jenismutasi','stokmasuk','stokkeluar'], 'integer'],
            [['tgl'], 'safe'],
            [['trxid', 'idtrx','keterangan'], 'string', 'max' => 50],
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
            'tgl' => 'Tgl',
            'stokawal' => 'Stokawal',
            'qty' => 'Qty',
            'stokakhir' => 'Stokakhir',
            'idtkp' => 'Idtkp',
            'trxid' => 'Trxid',
            'user' => 'User',
            'idtrx' => 'Idtrx',
        ];
    }
	public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
	public function getMutasi()
    {
        return $this->hasOne(KartustokJenismutasi::className(), ['id' => 'jenismutasi']);
    }
}
