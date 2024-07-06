<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan_igd".
 *
 * @property int $id
 * @property string $kodeperiksa
 * @property int $idrawat
 * @property string $keluhanutama
 * @property string $rwpenyakit
 * @property int $idkesadaran
 * @property int $triase
 * @property string $td
 * @property string $nadi
 * @property string $pernapasan
 * @property string $suhu
 * @property string $ku_kepala
 * @property string $ku_leher
 * @property string $ku_tparu
 * @property string $ku_tjantung
 * @property string $abdomen
 * @property string $kulit
 * @property string $extremitas
 * @property int $keadaanumum
 * @property string $diagnosa
 * @property int $status
 * @property int $iddokter
 */
class PemeriksaanIgd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan_igd';
    }
	public function Pecah($id){
	$data = json_decode($id);
		if($data > 0){
		return implode(" , ",$data); 
		}else{
			return '';
		}
	}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idkesadaran', 'triase', 'keadaanumum', 'status', 'iddokter'], 'integer'],
            [['keluhanutama', 'rwpenyakit', 'idkesadaran', 'triase', 'diagnosa', 'iddokter'], 'required'],
            [['keluhanutama', 'rwpenyakit', 'td', 'nadi', 'pernapasan', 'suhu', 'ku_kepala', 'ku_leher', 'ku_tparu', 'ku_tjantung', 'abdomen', 'kulit', 'extremitas','statuspasien','detailtindakan','detailobat','prosedur'], 'string'],
			[['lab','tindakan','radiologi','obat'],'safe'],
            [['kodeperiksa', 'diagnosa'], 'string', 'max' => 350],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodeperiksa' => 'Kodeperiksa',
            'idrawat' => 'Idrawat',
            'keluhanutama' => 'Keluhanutama',
            'rwpenyakit' => 'Rwpenyakit',
            'idkesadaran' => 'Idkesadaran',
            'triase' => 'Triase',
            'td' => 'Td',
            'nadi' => 'Nadi',
            'pernapasan' => 'Pernapasan',
            'suhu' => 'Suhu',
            'ku_kepala' => 'Ku Kepala',
            'ku_leher' => 'Ku Leher',
            'ku_tparu' => 'Ku Tparu',
            'ku_tjantung' => 'Ku Tjantung',
            'abdomen' => 'Abdomen',
            'kulit' => 'Kulit',
            'extremitas' => 'Extremitas',
            'keadaanumum' => 'Keadaanumum',
            'diagnosa' => 'Diagnosa',
            'status' => 'Status',
            'iddokter' => 'Iddokter',
        ];
    }
	
	public function getKesadaran()
    {
        return $this->hasOne(Kesadaran::className(), ['id' => 'idkesadaran']);
    }
	public function getTri()
    {
        return $this->hasOne(Triage::className(), ['id' => 'triase']);
    }
	public function getRawat()
    {
        return $this->hasOne(Rawatjalan::className(), ['id' => 'idrawat']);
    }
}
