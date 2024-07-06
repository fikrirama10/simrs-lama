<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trxapotek".
 *
 * @property int $id
 * @property string $idtrx
 * @property string $total
 * @property string $idbayar
 * @property string $status
 * @property int $idrawat
 * @property string $koderawat
 * @property string $norm
 * @property int $idlok
 * @property string $tgl
 * @property string $tglresep
 * @property string $nama
 */
class Trxapotek extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $jml;
    public static function tableName()
    {
        return 'trxapotek';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idlok'], 'integer'],
            [['tgl', 'tglresep'], 'safe'],
            [['idtrx', 'total', 'idbayar', 'status', 'koderawat', 'norm', 'nama'], 'string', 'max' => 50],
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
            'total' => 'Total',
            'idbayar' => 'Idbayar',
            'status' => 'Status',
            'idrawat' => 'Idrawat',
            'koderawat' => 'Koderawat',
            'norm' => 'Norm',
            'idlok' => 'Idlok',
            'tgl' => 'Tgl',
            'tglresep' => 'Tglresep',
            'nama' => 'Nama',
        ];
    }
	public function genNoresep()
	{
		$tgl='RI';
		
		$pf=$tgl.'-'.date('Ymd');
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
	 public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'norm']);
    }
    public function getBayar()
    {
        return $this->hasOne(Jenisbayar::className(), ['id' => 'idbayar']);
    }
    public function getJenisrawat()
    {
        return $this->hasOne(Jenisrawat::className(), ['id' => 'idlok']);
    }
	public function getRawat()
    {
        return $this->hasOne(Rawatjalan::className(), ['id' => 'idrawat']);
    }
}
