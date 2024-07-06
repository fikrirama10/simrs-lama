<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id
 * @property string $idtrx
 * @property string $no_rm
 * @property string $idrawat
 * @property int $idbayar
 * @property string $tglbayar
 * @property int $iduser
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $jml;
    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idbayar', 'iduser','status','kodedokter'], 'integer'],
            [['tglbayar'], 'safe'],
            [['idtrx', 'no_rm', 'idrawat'], 'string', 'max' => 50],
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
            'no_rm' => 'No Rm',
            'idrawat' => 'Idrawat',
            'idbayar' => 'Idbayar',
            'tglbayar' => 'Tglbayar',
            'iduser' => 'Iduser',
        ];
    }
	public function genKode()
	{
		$tgl='TRX'.date('Ymd');
		
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
	
	public function getDokter()
    {
        return $this->hasOne(Trandokter::className(), ['id' => 'kodedokter']);
    }
	
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rm']);
    }
    
    	public function getJenisrawat()
    {
        return $this->hasOne(Jenisrawat::className(), ['id' => 'idjenisrawat']);
    }
    	public function getJerawat()
    {
        return $this->hasOne(Jenisrawat::className(), ['id' => 'idjenisrawat']);
    }
	public function getBayar()
    {
        return $this->hasOne(Jenisbayar::className(), ['id' => 'idbayar']);
    }
	public function getRawat()
    {
        return $this->hasOne(Rawatjalan::className(), ['id' => 'idrawat']);
    }
}
