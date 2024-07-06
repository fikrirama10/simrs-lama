<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apotekumum_detail".
 *
 * @property int $id
 * @property string $idtrx
 * @property string $iddetail
 * @property int $idobat
 * @property int $harga
 * @property int $qty
 * @property int $subtotal
 * @property string $dosis
 * @property string $takaran
 * @property string $diminum
 * @property string $khasiat
 *
 * @property Apotekumum $trx
 * @property Obat $obat
 */
class ApotekumumDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apotekumum_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idobat', 'harga', 'qty', 'subtotal'], 'integer'],
            [['idtrx', 'iddetail'], 'string', 'max' => 50],
            [['dosis', 'takaran', 'diminum', 'khasiat','tanggal'], 'string', 'max' => 100],
           // [['idtrx'], 'exist', 'skipOnError' => true, 'targetClass' => Apotekumum::className(), 'targetAttribute' => ['idtrx' => 'idtrx']],
           // [['idobat'], 'exist', 'skipOnError' => true, 'targetClass' => Obat::className(), 'targetAttribute' => ['idobat' => 'id']],
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
            'iddetail' => 'Iddetail',
            'idobat' => 'Idobat',
            'harga' => 'Harga',
            'qty' => 'Qty',
            'subtotal' => 'Subtotal',
            'dosis' => 'Dosis',
            'takaran' => 'Takaran',
            'diminum' => 'Diminum',
            'khasiat' => 'Khasiat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function genKode()
	{
		$tgl='BKY';
		
		$pf=$tgl;
		$max = $this::find()->select('max(iddetail)')->andFilterWhere(['like','iddetail',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->iddetail=$id;
		
	}
	
    public function getTrx()
    {
        return $this->hasOne(Apotekumum::className(), ['idtrx' => 'idtrx']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
}
