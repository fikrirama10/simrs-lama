<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tarif".
 *
 * @property int $id
 * @property string $nama
 * @property int $tarif
 * @property int $idjenis
 * @property int $status
 * @property string $ket
 * @property string $kode_tarif
 */
class Tarif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarif', 'idjenis', 'status','jenisterima','jenistarif'], 'integer'],
            [['nama', 'ket', 'kode_tarif'], 'string', 'max' => 50],
			[['idjenis'],'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'tarif' => 'Tarif',
            'idjenis' => 'Jenis Tarif',
            'status' => 'Status',
            'ket' => 'Ket',
            'kode_tarif' => 'Kode Tarif',
        ];
    }
	public function genKode()
	{
		$tgl='TRF';
		
		$pf=$tgl;
		$max = $this::find()->select('max(kode_tarif)')->andFilterWhere(['like','kode_tarif',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kode_tarif=$id;
		
	}
	public function getBayar()
    {
        return $this->hasOne(Jenisbayar::className(), ['id' => 'idjenis']);
    }
	public function getJenis()
    {
        return $this->hasOne(Jenistarif::className(), ['id' => 'jenistarif']);
    }
	public function getTerima()
    {
        return $this->hasOne(JenispenerimaanDetail::className(), ['id' => 'jenisterima']);
    }
    public static function getOptions($id){
		$data=  static::find()->where(['idjenis'=>$id])->all();
		$value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'nama','nama'); //id = your ID model, name = your caption

		return $value;
	}
}
