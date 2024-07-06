<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pasienonline".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property int $nokartu
 * @property int $idbayar
 * @property string $noregistrasi
 * @property string $tanggal
 * @property int $idpoli
 * @property string $nohp
 */
class Pasienonline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasienonline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'idbayar', 'idpoli','jenisantrian','polieksekutif','jenisreferensi','jenisrequest'], 'integer'],
            [['tanggal'], 'safe'],
            [['nohp','idbayar'], 'required'],
            [['nokartu','norujukan','no_rekmed', 'noregistrasi','nik', 'nohp','antrian','dilayani','kodepoli','nama','jenispasien'], 'string', 'max' => 150],
        ];
    }

	public function genKode()
	{
		$tgl=date('dmY');
		
		$pf=$tgl;
		$max = $this::find()->select('max(noregistrasi)')->andFilterWhere(['like','noregistrasi',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->noregistrasi=$id;
		
	}
	
	public function genAntri($pf)
	{
		
		$max = $this::find()->select('max(antrian)')->andFilterWhere(['like', 'kodepoli',$pf])->andFilterWhere(['like','DATE_FORMAT(tanggal,"%Y-%m-%d")',date('Y-m-d')])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		//$poli = Poli::find()->where(['id'=>$pf])->one();
		if($last<10){
			$id=$pf.'0'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->antrian=$id;
		
	}
	
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'nokartu' => 'Nokartu',
            'idbayar' => 'Idbayar',
            'noregistrasi' => 'Noregistrasi',
            'tanggal' => 'Tanggal',
            'idpoli' => 'Idpoli',
            'nohp' => 'Nohp',
        ];
    }
		    public function getPoli()
    {
        return $this->hasOne(Daftaronline::className(), ['id' => 'idpoli']);
    }
	public function getPolii()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }
		    public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
