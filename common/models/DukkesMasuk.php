<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dukkes_masuk".
 *
 * @property int $id
 * @property int $idsuplier
 * @property string $tgl
 * @property int $iduser
 * @property string $keterangan
 * @property string $kodetrx
 */
class DukkesMasuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dukkes_masuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsuplier', 'iduser'], 'integer'],
            [['tgl'], 'safe'],
            [['keterangan'], 'string'],
            [['kodetrx'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idsuplier' => 'Idsuplier',
            'tgl' => 'Tgl',
            'iduser' => 'Iduser',
            'keterangan' => 'Keterangan',
            'kodetrx' => 'Kodetrx',
        ];
    }
	public function genKode()
	{
		$tgl='DM';
		
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
	public function getSuplier()
    {
        return $this->hasOne(DukkesSuplier::className(), ['id' => 'idsuplier']);
    }
}
