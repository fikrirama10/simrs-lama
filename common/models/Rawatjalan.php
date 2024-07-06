<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rawatjalan".
 *
 * @property integer $id
 * @property string $idrawat
 * @property string $no_rekmed
 * @property integer $iddokter
 * @property integer $idpoli
 * @property integer $idbayar
 * @property integer $iddiagnosa
 * @property string $tgldaftar
 * @property string $penanggung
 * @property string $alamat_penanggung
 * @property string $hubungan
 * @property string $notlp
 */
class Rawatjalan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 public $Cnt;
	 public $jumlah;
	 public $jml;
	 public $Kdi;
    public static function tableName()
    {
        return 'rawatjalan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
         return [
		 [['idbayar' ], 'required'],
            [['idverifed', 'iddokter','idperawat', 'idpoli', 'idbayar', 'hubungan', 'idkelas', 'idjenisrawat','anggota', 'idruangan', 'status','triage','oprasi','idkb','rencranap','sbayar','klpcm','pengobatan','jenispenyakit','katpenyakit','katpenyakitmulut','katgigi','macampenyakitmulut','status_melahirkan','batal'], 'integer'],
            [['tgldaftar','tglkeluar','ketpulang','jadwalp','tglkbayar'], 'safe'],
            [['alamat_penanggung','drbayar','caradatang','carakeluar','norujukan','nosuratkontrol','nosep','soap','terapi','tindakan','dokumen'], 'string'],
            [['idrawat', 'antrian','kdiagnosa', 'no_rekmed','ketdiag', 'penanggung', 'notlp', 'rujukan','ketrj','diagket'], 'string', 'max' => 250],
            [['idjenisrawat'], 'exist', 'skipOnError' => true, 'targetClass' => Jenisrawat::className(), 'targetAttribute' => ['idjenisrawat' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrawat' => 'Nomer Rawat',
            'no_rekmed' => 'No Rekmed',
            'idverifed' => 'No Rekmed',
            'iddokter' => 'Dokter',
            'idpoli' => 'Poli',
            'idbayar' => 'Jenis Bayar',
            'tgldaftar' => 'Tgldaftar',
            'penanggung' => 'Penanggung',
            'alamat_penanggung' => 'Alamat Penanggung',
            'hubungan' => 'Hubungan',
            'notlp' => 'Notlp',
            'kodediagnosa' => 'Diagnosa',
            'ketdiag' => 'Keterangan Diagnosa',
        ];
    }
	public function genKode()
	{
		$tgl=date('dmY-');
		
		$pf=$tgl;
		$max = $this::find()->select('max(idrawat)')->andFilterWhere(['like','idrawat',$pf])->scalar(); 
		$last=substr($max,strlen($pf),4) + 1;
		
		if($last<10){
			$id=$pf.'000'.$last;}
		elseif($last<100){
			$id=$pf.'00'.$last;}
		elseif($last<1000){
			$id=$pf.'0'.$last;}
		elseif($last<10000){
			$id=$pf.$last;}
		$this->idrawat=$id;
		
	}
public function genAntri($pf,$iddokter,$ang,$daftar)
	{
		$tgl = $daftar;
		if($ang == 1){
			$max = $this::find()->select('max(antrian)')->where(['batal'=>null])->andFilterWhere(['like', 'idpoli',$pf])->andFilterWhere(['like', 'iddokter',$iddokter])->andFilterWhere(['like','anggota',1])->andFilterWhere(['like','DATE_FORMAT(tgldaftar,"%Y-%m-%d")',date('Y-m-d',strtotime($daftar))])->scalar(); 
			$last=substr($max,strlen($tgl.$pf.$iddokter.$ang),4) + 1;
			//$poli = Poli::find()->where(['id'=>$pf])->one();
			if($last<10){
				$id=$tgl.$pf.$iddokter.$ang.'000'.$last;}
			elseif($last<100){
				$id=$tgl.$pf.$iddokter.$ang.'00'.$last;}
			elseif($last<1000){
				$id=$tgl.$pf.$iddokter.$ang.'0'.$last;}
			elseif($last<10000){
				$id=$tgl.$pf.$iddokter.$ang.$last;}
			$this->antrian=$id;
		}else{
			$max = $this::find()->select('max(antrian)')->where(['batal'=>null])->andFilterWhere(['like', 'idpoli',$pf])->andFilterWhere(['like', 'iddokter',$iddokter])->andFilterWhere(['like','anggota',0])->andFilterWhere(['like','DATE_FORMAT(tgldaftar,"%Y-%m-%d")',date('Y-m-d',strtotime($daftar))])->scalar(); 
			$last=substr($max,strlen($tgl.$pf.$iddokter),4) + 1;
			//$poli = Poli::find()->where(['id'=>$pf])->one();
			if($last<10){
				$id=$tgl.$pf.$iddokter.'000'.$last;}
			elseif($last<100){
				$id=$tgl.$pf.$iddokter.'00'.$last;}
			elseif($last<1000){
				$id=$tgl.$pf.$iddokter.'0'.$last;}
			elseif($last<10000){
				$id=$tgl.$pf.$iddokter.$last;}
			$this->antrian=$id;
		}
		
		
		
	}
	
	 public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	 public function getPolii()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }
	 public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'iddokter']);
    }
     public function getDookter()
    {
        return $this->hasOne(Trandokter::className(), ['id' => 'drbayar']);
    }
	public function getPerawat()
    {
        return $this->hasOne(Perawat::className(), ['id' => 'idperawat']);
    }
	 public function getHub()
    {
        return $this->hasOne(Hubungan::className(), ['id' => 'hubungan']);
    }
	 public function getSttatus()
    {
        return $this->hasOne(Statusrawat::className(), ['id' => 'status']);
    }
	public function getCarabayar()
    {
        return $this->hasOne(Jenisbayar::className(), ['id' => 'idbayar']);
    }
	public function getJerawat()
    {
        return $this->hasOne(Jenisrawat::className(), ['id' => 'idjenisrawat']);
    }
		public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id' => 'idkelas']);
    }
	public function getKamar()
    {
        return $this->hasOne(Kamar::className(), ['id' => 'idruangan']);
    }
	public function getDiagnosa()
    {
        return $this->hasOne(Diagnosa::className(), ['kodediagnosa' => 'kdiagnosa']);
    }
	
	
}
