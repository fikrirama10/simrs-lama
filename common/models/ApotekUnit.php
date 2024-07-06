<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apotek_unit".
 *
 * @property int $id
 * @property int $idtrx
 * @property string $unit
 * @property string $tanggal
 * @property string $nama
 * @property int $iduser
 * @property int $status
 */
class ApotekUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apotek_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtrx', 'iduser', 'status'], 'integer'],
            [['unit'], 'string'],
            [['tanggal'], 'safe'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
	public function genKode()
	{
		$tgl='APU';
		
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idtrx' => 'Idtrx',
            'unit' => 'Unit',
            'tanggal' => 'Tanggal',
            'nama' => 'Nama',
            'iduser' => 'Iduser',
            'status' => 'Status',
        ];
    }
}
