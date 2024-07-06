<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pagu".
 *
 * @property int $id
 * @property int $jenispagu
 * @property int $kodepagu
 * @property int $nilaipagu
 * @property string $tahun
 * @property int $iduser
 */
class Pagu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenispagu',  'nilaipagu', 'iduser','revisi'], 'integer'],
            [['kodepagu','tahun'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenispagu' => 'Jenispagu',
            'kodepagu' => 'Kodepagu',
            'nilaipagu' => 'Nilaipagu',
            'tahun' => 'Tahun',
            'iduser' => 'Iduser',
        ];
    }
	
	public function genKode()
	{
		$tgl='PAGU'.date('Y');
		
		$pf=$tgl;
		$max = $this::find()->select('max(kodepagu)')->andFilterWhere(['like','kodepagu',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kodepagu=$id;
		
	}
	public function getBayar()
    {
        return $this->hasOne(Jenisbayar::className(), ['id' => 'jenispagu']);
    }
}
