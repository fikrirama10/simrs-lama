<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rujukan".
 *
 * @property int $id
 * @property string $kode
 * @property string $no_rekmed
 * @property string $nama
 * @property int $usia
 * @property string $jk
 * @property string $penjamin
 * @property string $diagnosa
 * @property string $kebutuhan
 * @property string $waktu
 */
class Rujukan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rujukan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usia'], 'integer'],
            [['jk', 'penjamin', 'kebutuhan','asal','ke','kd','bln'], 'string'],
            [['waktu','tanggal'], 'safe'],
            [['kode', 'no_rekmed', 'nama', 'diagnosa'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
	 public function genKode($sd)
	{
		$tgl=$sd;
		$pf=$tgl;
		$max = $this::find()->select('max(kode)')->andFilterWhere(['like','kode',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->kode=$id;
		
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'no_rekmed' => 'No Rekmed',
            'nama' => 'Nama',
            'usia' => 'Usia',
            'jk' => 'Jk',
            'penjamin' => 'Penjamin',
            'diagnosa' => 'Diagnosa',
            'kebutuhan' => 'Kebutuhan',
            'waktu' => 'Waktu',
        ];
    }
}
