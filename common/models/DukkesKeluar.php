<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dukkes_keluar".
 *
 * @property int $id
 * @property string $kodetrx
 * @property string $tgl
 * @property int $iduser
 * @property string $keterangan
 * @property string $kegiatan
 */
class DukkesKeluar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dukkes_keluar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl'], 'safe'],
            [['iduser'], 'integer'],
            [['keterangan'], 'string'],
            [['kodetrx'], 'string', 'max' => 50],
            [['kegiatan'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodetrx' => 'Kodetrx',
            'tgl' => 'Tgl',
            'iduser' => 'Iduser',
            'keterangan' => 'Keterangan',
            'kegiatan' => 'Kegiatan',
        ];
    }
	public function genKode()
	{
		$tgl='DK';
		
		$pf=$tgl;
		$max = $this::find()->select('max(kodetrx)')->andFilterWhere(['like','kodetrx',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kodetrx=$id;
		
	}
}
