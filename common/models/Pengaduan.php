<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pengaduan".
 *
 * @property int $id
 * @property string $nomer
 * @property string $nama
 * @property string $email
 * @property string $nohp
 * @property string $pengaduan
 * @property string $tgl
 * @property int $idjenispengaduan
 *
 * @property Pengaduan $jenispengaduan
 * @property Pengaduan[] $pengaduans
 */
class Pengaduan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengaduan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pengaduan'], 'string'],
            [['tgl'], 'safe'],
            [['idjenispengaduan','idpenilaian'], 'integer'],
            [['nomer', 'nama', 'email', 'nohp','foto'], 'string', 'max' => 50],
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomer' => 'Nomer',
            'nama' => 'Nama',
            'email' => 'Email',
            'nohp' => 'Nohp',
            'pengaduan' => 'Pengaduan',
            'tgl' => 'Tgl',
            'idjenispengaduan' => 'Idjenispengaduan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function genKode()
	{
		$tgl=date('dmY');
		
		$pf="P".$tgl;
		$max = $this::find()->select('max(nomer)')->andFilterWhere(['like','nomer',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->nomer=$id;
		
	}
    public function getJenispengaduan()
    {
        return $this->hasOne(Pengaduan::className(), ['id' => 'idjenispengaduan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengaduans()
    {
        return $this->hasMany(Pengaduan::className(), ['idjenispengaduan' => 'id']);
    }
}
