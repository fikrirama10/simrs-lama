<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usg".
 *
 * @property int $id
 * @property string $idusg
 * @property string $no_rekmed
 * @property string $stpasien
 * @property string $nama
 * @property string $jenis_kelamin
 * @property string $usia
 * @property string $alamat
 * @property string $tglusg
 * @property string $jam
 * @property string $petugas
 */
class Usg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stpasien', 'jenis_kelamin', 'alamat','dokter','dl'], 'string'],
            [['tglusg', 'jam'], 'safe'],
            [['idusg', 'no_rekmed', 'nama', 'usia', 'petugas'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idusg' => 'Idusg',
            'no_rekmed' => 'No Rekmed',
            'stpasien' => 'Stpasien',
            'nama' => 'Nama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'usia' => 'Usia',
            'alamat' => 'Alamat',
            'tglusg' => 'Tglusg',
            'jam' => 'Jam',
            'petugas' => 'Petugas',
        ];
    }
	public function genKode()
	{
		
		$tgl=date('dmY');
		$pf="USG".$tgl;
		$max = $this::find()->select('max(idusg)')->andFilterWhere(['like','idusg',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->idusg=$id;
		
	}
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
