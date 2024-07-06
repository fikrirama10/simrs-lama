<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property integer $id
 * @property string $no_rekmed
 * @property integer $no_identitas
 * @property string $tempat_lahir
 * @property string $nama_pasien
 * @property string $sbb
 * @property string $jenis_kelamin
 * @property string $gol_darah
 * @property string $nohp
 * @property string $alamat
 * @property string $idprov
 * @property string $idkab
 * @property string $idkec
 * @property string $idkel
 * @property string $agama
 * @property integer $kodepos
 * @property integer $id_status
 * @property string $tanggal_lahir
 * @property string $created_at
 * @property integer $idverifed
 * @property integer $usia
 *
 * @property Statushub $idStatus
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	  public $Cnt;	
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'nama_pasien','id_status','tanggal_lahir'], 'required'],
            [['no_rekmed','no_identitas','nobpjs', 'idkab', 'idkec', 'idkel', 'kodepos', 'id_status','stat','idpekerjaan', 'idverifed','anggota', 'usia','nilaikeyakinan','idbahasa','idhambatan','kethambatan','pendidikan','suku'], 'integer'],
            [['sbb', 'jenis_kelamin','subid', 'gol_darah', 'alamat', 'agama','stpasien','ketber','rmedis'], 'string'],
            [['tanggal_lahir','t_berobat', 'created_at'], 'safe'],
            [['no_rekmed', 'idprov', 'idkab', 'idkec', 'idkel'], 'string', 'max' => 50],
            [['tempat_lahir', 'nama_pasien', 'nohp'], 'string', 'max' => 255],
            //[['nohp'], 'unique'],
            [['no_rekmed'], 'unique'],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Statushub::className(), 'targetAttribute' => ['id_status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'no_identitas' => 'No Identitas',
            'tempat_lahir' => 'Tempat Lahir',
            'nama_pasien' => 'Nama Pasien',
            'sbb' => 'Sbb',
            'jenis_kelamin' => 'Jenis Kelamin',
            'gol_darah' => 'Gol Darah',
            'nohp' => 'Nohp',
            'alamat' => 'Alamat',
            'idprov' => 'Provinsi',
            'idkab' => 'Kabupaten',
            'idkec' => 'Kecamatan',
            'idkel' => 'Kelurahan',
            'agama' => 'Agama',
            'kodepos' => 'Kodepos',
            'id_status' => 'Status',
            'tanggal_lahir' => 'Tanggal Lahir',
            'created_at' => 'Created At',
            'idverifed' => 'Idverifed',
            'usia' => 'Usia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(Statushub::className(), ['id' => 'id_status']);
    }
	 public function getKel()
    {
        return $this->hasOne(Kelurahan::className(), ['id_kel' => 'idkel']);
    }
    public function getSukus()
    {
        return $this->hasOne(Suku::className(), ['id' => 'suku']);
    }
	 public function getKec()
    {
        return $this->hasOne(Kecamatan::className(), ['id_kec' => 'idkec']);
    }
	public function getKab()
    {
        return $this->hasOne(Kabupaten::className(), ['id_kab' => 'idkab']);
    }
		public function getRj()
    {
        return $this->hasOne(Rawatjalan::className(), ['no_rekmed' => 'no_rekmed']);
    }
    public function getKerja()
    {
        return $this->hasOne(Pekerjaan::className(), ['idpasien' => 'no_rekmed']);
    }
	 public function getPekerjaan()
    {
        return $this->hasOne(Jenispekerjaan::className(), ['id' => 'idpekerjaan']);
    }
    public function getSekolah()
    {
        return $this->hasOne(Pendidikan::className(), ['id' => 'pendidikan']);
    }
	public function getId()
	{
		return $this->getPrimaryKey();
	}
	public function genKode()
	{
		$pf='1';
		$max = $this::find()->select('max(no_rekmed)')->where(['kodepos'=>null])->andFilterWhere(['like','no_rekmed',$pf])->scalar(); 
		$last=substr($max,strlen($pf),5) + 1;
		
		if($last<10){
			$id=$pf.'0000'.$last;}
		elseif($last<100){
			$id=$pf.'000'.$last;}
		elseif($last<1000){
			$id=$pf.'00'.$last;}
		elseif($last<10000){
			$id=$pf.'0'.$last;}
		elseif($last<100000){
			$id=$pf.$last;}
		$this->no_rekmed=$id;
		
	}
	
}
