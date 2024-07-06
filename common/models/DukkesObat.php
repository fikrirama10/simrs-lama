<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dukkes_obat".
 *
 * @property int $id
 * @property int $kodeobat
 * @property int $namaobat
 * @property int $stok
 * @property int $kadaluarsa
 * @property string $jenisobat
 * @property int $idsatuan
 */
class DukkesObat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dukkes_obat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'stok',  'idsatuan'], 'integer'],
            [['kodeobat','jenisobat', 'namaobat'], 'string'],
            [['kadaluarsa'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodeobat' => 'Kodeobat',
            'namaobat' => 'Namaobat',
            'stok' => 'Stok',
            'kadaluarsa' => 'Kadaluarsa',
            'jenisobat' => 'Jenisobat',
            'idsatuan' => 'Idsatuan',
        ];
    }
	public function genKode()
	{
		$tgl='BRG';
		
		$pf=$tgl;
		$max = $this::find()->select('max(kodeobat)')->andFilterWhere(['like','kodeobat',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kodeobat=$id;
		
	}
	public function getSatuan()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'idsatuan']);
    }	
}
