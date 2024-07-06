<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apotek_unitdetail".
 *
 * @property int $id
 * @property string $iddetail
 * @property string $idtrx
 * @property int $idobat
 * @property int $qty
 * @property int $keterangan
 * @property string $tanngal
 */
class ApotekUnitdetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apotek_unitdetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idobat', 'qty', 'keterangan','harga','total','satuan'], 'integer'],
            [['tanggal'], 'safe'],
            [['iddetail', 'idtrx'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iddetail' => 'Iddetail',
            'idtrx' => 'Idtrx',
            'idobat' => 'Idobat',
            'qty' => 'Qty',
            'keterangan' => 'Keterangan',
            'tanngal' => 'Tanngal',
        ];
    }
	  public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
	public function genKode()
	{
		$tgl='BKU';
		
		$pf=$tgl;
		$max = $this::find()->select('max(iddetail)')->andFilterWhere(['like','iddetail',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->iddetail=$id;
		
	}
}
