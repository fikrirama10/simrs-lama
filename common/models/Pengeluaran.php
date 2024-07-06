<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pengeluaran".
 *
 * @property int $id
 * @property string $trxid
 * @property string $nama
 * @property string $jabatan
 * @property string $keterangan
 * @property string $tanggal
 * @property int $biaya
 * @property int $casier
 */
class Pengeluaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengeluaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jabatan', 'keterangan'], 'string'],
            [['tanggal'], 'safe'],
            [['biaya', 'casier'], 'integer'],
            [['trxid', 'nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trxid' => 'Trxid',
            'nama' => 'Nama',
            'jabatan' => 'Jabatan',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
            'biaya' => 'Biaya',
            'casier' => 'Casier',
        ];
    }
	public function genKode()
	{
		$tgl='TRXK';
		
		$pf=$tgl;
		$max = $this::find()->select('max(trxid)')->andFilterWhere(['like','trxid',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->trxid=$id;
		
	}
}
