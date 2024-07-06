<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "barang_masuk".
 *
 * @property int $id
 * @property int $idtrx
 * @property string $tanggal
 * @property string $jenismasuk
 * @property int $status
 * @property int $total
 * @property string $faktur
 */
class BarangMasuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang_masuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtrx', 'status', 'total','jenisbarang','idpermintaan'], 'integer'],
            [['tanggal'], 'safe'],
            [['jenismasuk'], 'string'],
            [['faktur'], 'string', 'max' => 100],
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
            'tanggal' => 'Tanggal',
            'jenismasuk' => 'Jenismasuk',
            'status' => 'Status',
            'total' => 'Total',
            'faktur' => 'Faktur',
        ];
    }
	public function genKode()
	{
		
		$tgl='GD'.date('Ymd');
		
		$pf=$tgl;
		$max = $this::find()->select('max(idtrx)')->andFilterWhere(['like','idtrx',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->idtrx=$id;
		
	}
	public function getBayar()
    {
        return $this->hasOne(Jenisbayar::className(), ['id' => 'jenisbarang']);
    }	
}
