<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trxresep".
 *
 * @property int $id
 * @property string $norm
 * @property string $trxid
 * @property string $tanggal
 * @property int $idobat
 * @property string $dosis
 * @property string $ket
 * @property int $iduser
 * @property int $harga
 * @property int $jumlah
 * @property int $satuan
 * @property int $total
 * @property string $diminum
 * @property string $takaran
 * @property string $khasiat
 */
class Trxresep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
     public $jml;
    public static function tableName()
    {
        return 'trxresep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['idobat', 'iduser', 'harga', 'jumlah', 'satuan', 'total'], 'integer'],
            [['norm', 'trxid', 'dosis', 'ket', 'diminum', 'takaran', 'khasiat','bkid'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'norm' => 'Norm',
            'trxid' => 'Trxid',
            'tanggal' => 'Tanggal',
            'idobat' => 'Idobat',
            'dosis' => 'Dosis',
            'ket' => 'Ket',
            'iduser' => 'Iduser',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'satuan' => 'Satuan',
            'total' => 'Total',
            'diminum' => 'Diminum',
            'takaran' => 'Takaran',
            'khasiat' => 'Khasiat',
        ];
    }
	public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
	public function getTrx()
    {
        return $this->hasOne(Trxapotek::className(), ['idtrx' => 'trxid']);
    }
	public function genKode()
	{
		$tgl='BK'.date('Ymd');
		
		$pf=$tgl;
		$max = $this::find()->select('max(bkid)')->andFilterWhere(['like','bkid',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->bkid=$id;
		
	}
	
}
