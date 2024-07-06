<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "suratsakit".
 *
 * @property int $id
 * @property string $bulan
 * @property string $jk
 * @property string $nomor
 * @property string $nama
 * @property string $usia
 * @property string $perusahaan
 * @property string $tanggal
 * @property string $sampai
 * @property string $dari
 * @property string $no_rekmed
 */
class Suratsakit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suratsakit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'sampai', 'dari'], 'safe'],
            [['bulan', 'jk', 'nomor', 'nama', 'usia', 'perusahaan', 'no_rekmed'], 'string', 'max' => 50],
        ];
    }
	 public function genKode($sd)
	{
		$tgl=$sd;
		$pf=$tgl;
		$max = $this::find()->select('max(nomor)')->andFilterWhere(['like','nomor',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->nomor=$id;
		
	}

Public function getRomawi($bln){
                switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
}
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bulan' => 'Bulan',
            'jk' => 'Jk',
            'nomor' => 'Nomor',
            'nama' => 'Nama',
            'usia' => 'Usia',
            'perusahaan' => 'Perusahaan',
            'tanggal' => 'Tanggal',
            'sampai' => 'Sampai',
            'dari' => 'Dari',
            'no_rekmed' => 'No Rekmed',
        ];
    }
}
