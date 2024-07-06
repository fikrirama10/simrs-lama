<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "barang_masukdetail".
 *
 * @property int $id
 * @property string $idtrx
 * @property string $iddetail
 * @property int $idbarang
 * @property int $qty
 * @property int $harga
 * @property int $jumlah
 * @property int $satuan
 */
class BarangMasukdetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang_masukdetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idbarang', 'qty', 'harga', 'jumlah', 'satuan'], 'integer'],
            [['ed'],'safe'],
            [['idtrx', 'iddetail'], 'string', 'max' => 50],
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
            'idbarang' => 'Idbarang',
            'qty' => 'Qty',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'satuan' => 'Satuan',
        ];
    }
	public function genKode()
	{
		
		$tgl='BM';
		
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
	public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idbarang']);
    }
}
