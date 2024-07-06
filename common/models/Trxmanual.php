<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trxmanual".
 *
 * @property int $id
 * @property string $trxid
 * @property string $nama
 * @property string $tgl
 * @property string $ket
 * @property int $casier
 * @property int $status
 */
class Trxmanual extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trxmanual';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl'], 'safe'],
            [['casier', 'status'], 'integer'],
            [['trxid', 'nama', 'ket' ,'usia','alamat'], 'string', 'max' => 250],
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
            'tgl' => 'Tgl',
            'ket' => 'Ket',
            'casier' => 'Casier',
            'status' => 'Status',
        ];
    }
	public function genKode()
	{
		$tgl='TRXM';
		
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
