<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apotekumum".
 *
 * @property int $id
 * @property string $idtrx
 * @property string $nama
 * @property string $tgltrx
 * @property string $total
 * @property string $status
 *
 * @property ApotekumumDetail[] $apotekumumDetails
 */
class Apotekumum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apotekumum';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgltrx', 'total', 'status'], 'safe'],
            [['idtrx', 'nama'], 'string', 'max' => 50],
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
            'nama' => 'Nama',
            'tgltrx' => 'Tgltrx',
            'total' => 'Total',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function genKode()
	{
		$tgl='APM';
		
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
    public function getApotekumumDetails()
    {
        return $this->hasMany(ApotekumumDetail::className(), ['idtrx' => 'idtrx']);
    }
}
