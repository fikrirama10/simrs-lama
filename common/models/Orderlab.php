<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orderlab".
 *
 * @property int $id
 * @property string $kodelab
 * @property int $idpengirim
 * @property string $no_rekmed
 * @property string $idrawat
 * @property int $idtkp
 * @property int $idpemeriksa
 * @property string $tgl_order
 */
class Orderlab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orderlab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpengirim', 'idtkp', 'idpemeriksa'], 'integer'],
            [['tgl_order'], 'safe'],
            [['kodelab', 'no_rekmed', 'idrawat'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodelab' => 'Kodelab',
            'idpengirim' => 'Idpengirim',
            'no_rekmed' => 'No Rekmed',
            'idrawat' => 'Idrawat',
            'idtkp' => 'Idtkp',
            'idpemeriksa' => 'Idpemeriksa',
            'tgl_order' => 'Tgl Order',
        ];
    }
	public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'idpengirim']);
    }
	public function getJrawat()
    {
        return $this->hasOne(Jenisrawat::className(), ['id' => 'idtkp']);
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	public function getRawat()
    {
        return $this->hasOne(Rawatjalan::className(), ['idrawat' => 'idrawat']);
    }
	
	public function genKode()
	{
		
		$tgl=date('dm');
		$pf="Lab".$tgl;
		$max = $this::find()->select('max(kodelab)')->andFilterWhere(['like','kodelab',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kodelab=$id;
		
	}
}
