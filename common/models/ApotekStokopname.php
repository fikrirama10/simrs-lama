<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apotek_stokopname".
 *
 * @property int $id
 * @property int $stokkeluar
 * @property int $stokmasuk
 * @property int $stokawal
 * @property string $kodestok
 * @property int $idobat
 * @property string $tanggal
 * @property int $stokakhir
 */
class ApotekStokopname extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apotek_stokopname';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stokkeluar', 'stokmasuk', 'stokawal', 'idobat', 'stokakhir'], 'integer'],
            [['tanggal'], 'safe'],
            [['kodestok'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
	 public function genKode()
	{
		$tgl='SO';
		
		$pf=date('Y-m-d').$tgl;
		$max = $this::find()->select('max(kodestok)')->andFilterWhere(['like','kodestok',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kodestok=$id;
		
	}
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stokkeluar' => 'Stokkeluar',
            'stokmasuk' => 'Stokmasuk',
            'stokawal' => 'Stokawal',
            'kodestok' => 'Kodestok',
            'idobat' => 'Idobat',
            'tanggal' => 'Tanggal',
            'stokakhir' => 'Stokakhir',
        ];
    }
		public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
}
