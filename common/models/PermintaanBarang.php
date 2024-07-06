<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "permintaan_barang".
 *
 * @property int $id
 * @property string $idpermintaan
 * @property string $tanggal
 * @property int $total
 * @property int $status
 * @property int $jenis
 */
class PermintaanBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permintaan_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['total', 'status', 'jenis'], 'integer'],
            [['idpermintaan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpermintaan' => 'Idpermintaan',
            'tanggal' => 'Tanggal',
            'total' => 'Total',
            'status' => 'Status',
            'jenis' => 'Jenis',
        ];
    }
	public function genKode()
	{
		$tgl='UP';
		
		$pf=$tgl;
		$max = $this::find()->select('max(idpermintaan)')->andFilterWhere(['like','idpermintaan',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->idpermintaan=$id;
		
	}public function getBayar()
    {
        return $this->hasOne(Jenisbayar::className(), ['id' => 'jenis']);
    }
}
