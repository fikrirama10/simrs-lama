<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "radiologi".
 *
 * @property int $id
 * @property string $idrad
 * @property int $idpengirim
 * @property int $idpemeriksa
 * @property string $tanggal
 * @property int $status
 */
class Radiologi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'radiologi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpengirim', 'idpemeriksa', 'status'], 'integer'],
            [['tanggal'], 'safe'],
            [['idrad','no_rekmed', 'idrawat'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrad' => 'Idrad',
            'idpengirim' => 'Idpengirim',
            'idpemeriksa' => 'Idpemeriksa',
            'tanggal' => 'Tanggal',
            'status' => 'Status',
        ];
    }
	public function genKode()
	{
		
		$tgl=date('dmY');
		$pf="RAD".$tgl;
		$max = $this::find()->select('max(idrad)')->andFilterWhere(['like','idrad',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->idrad=$id;
		
	}
	 public function getRawatjalan()
    {
        return $this->hasOne(Rawatjalan::className(), ['idrawat' => 'idrawat']);
    }
		
	 public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	 public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'idpengirim']);
    }
    	 public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idpemeriksa']);
    }
	  
}
