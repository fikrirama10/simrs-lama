<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jadwaloprasi".
 *
 * @property int $id
 * @property string $kodebooking
 * @property string $no_rekmed
 * @property string $nobpjs
 * @property string $tglpelaksanaan
 * @property string $jenistindakan
 * @property int $idpoli
 * @property int $terlaksana
 * @property int $idbayar
 */
class Jadwaloprasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jadwaloprasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id'], 'required'],
            [['id', 'idpoli', 'terlaksana', 'idbayar'], 'integer'],
            [['tglpelaksanaan'], 'safe'],
            [['kodebooking', 'no_rekmed', 'nobpjs', 'jenistindakan'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodebooking' => 'Kodebooking',
            'no_rekmed' => 'No Rekmed',
            'nobpjs' => 'Nobpjs',
            'tglpelaksanaan' => 'Tglpelaksanaan',
            'jenistindakan' => 'Jenistindakan',
            'idpoli' => 'Idpoli',
            'terlaksana' => 'Terlaksana',
            'idbayar' => 'Idbayar',
        ];
    }
	
	public function genKode()
	{
		$tgl=date('dmY');
		
		$pf=$tgl;
		$max = $this::find()->select('max(kodebooking)')->andFilterWhere(['like','kodebooking',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kodebooking=$id;
		
	}
	public function getPoli()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	
}
