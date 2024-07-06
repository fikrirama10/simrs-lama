<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "klpcm".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property string $nama
 * @property int $dpjp
 * @property int $ruangan
 * @property int $ket
 * @property string $tdklengkap
 * @property string $jform
 * @property string $tanggal
 */
class Klpcm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'klpcm';
    }

    /**
     * {@inheritdoc}
     */
	public function Pecah($id){
	$data = json_decode($id);
		return implode(" & ",$data); 
			// for($i=0; $i < count($data); $i++){
				  // $array = $data[$i].',';
				  // echo $array;
				  
			// }
			//echo $data;
	}
    public function rules()
    {
        return [
            [['dpjp', 'ruangan','idpoli','jenisrawat','idrajal','jenispenyakit','keterbacaan'], 'integer'],
            //[[], 'string'],
            [['tanggal','tdklengkap', 'jform','tglkeluar'], 'safe'],
            [['no_rekmed', 'nama','lengkap', 'ket','icd10','ketdiag','dokumen'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'nama' => 'Nama',
            'dpjp' => 'Dpjp',
            'ruangan' => 'Ruangan',
            'ket' => 'Ket',
            'tdklengkap' => 'Tdklengkap',
            'jform' => 'Jform',
            'tanggal' => 'Tanggal',
        ];
    }
	public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'dpjp']);
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	public function getKamar()
    {
        return $this->hasOne(Kamar::className(), ['id' => 'ruangan']);
    }
	public function getPoli()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }
}
