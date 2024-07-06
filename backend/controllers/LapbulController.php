<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Poli;
use common\models\Rawatjalan;
use kartik\mpdf\Pdf;
use common\models\Jenisrawat;

class LapbulController extends \yii\rest\Controller
{
    
 
	function angkaNol($nilai){
		if($nilai == 0){
			return '-';
		}else{
			return $nilai;
		}
	}
	public function actionLapbulRj($awal,$akhir,$jenis){
		//tniaumil
		$tniaumilbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>NULL])->count();
		$tniaumilulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>NULL])->count();
		$tniaumilsemua = $tniaumilbaru + $tniaumilulang;
		//tniaukel
		$tniaukelbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>NULL])->count();
		$tniaukelulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>NULL])->count();
		$tniaukelsemua = $tniaukelbaru + $tniaukelulang;
		//tniausip
		$tniausipbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=> 2])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>NULL])->count();
		$tniausipulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=> 2])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>NULL])->count();
		$tniausipsemua = $tniausipbaru + $tniausipulang;
		
		//bpjs
		$bpjsbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['between','pasien.idpekerjaan',5,16])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>NULL])->count();
		$bpjsulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['between','pasien.idpekerjaan',5,16])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>NULL])->count();
		$bpjssemua = $bpjsbaru + $bpjsulang;
		
		//yanmas
		$yanmasbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['between','pasien.idpekerjaan',5,16])->andwhere(['idbayar'=>4])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>NULL])->count();
		$yanmasulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['between','pasien.idpekerjaan',5,16])->andwhere(['idbayar'=>4])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>NULL])->count();
		$yanmassemua = $yanmasbaru + $yanmasulang;
		
		//jumlah
		$jumlahbaru = $tniaumilbaru + $tniaukelbaru + $tniausipbaru + $bpjsbaru + $yanmasbaru;
		$jumlahulang = $tniaumilulang + $tniaukelulang + $tniausipulang + $bpjsulang + $yanmasulang;
		$jumlahsemua = $tniaumilsemua + $tniaukelsemua + $tniausipsemua + $bpjssemua + $yanmassemua;
		$jeni = Jenisrawat::find()->where(['id'=>$jenis])->one();
		
		return (array(
				
				"tniau"=>array(
					"Mil"=>array(
						"PengunjungMilBaru" => $tniaumilbaru,
						"PengunjungMilLama" => $tniaumilulang,
						"PengunjungMilSemua" => $tniaumilsemua,
					),
					"Kel"=>array(
						"PengunjungKelBaru" => $tniaukelbaru,
						"PengunjungKelLama" => $tniaukelulang,
						"PengunjungKelSemua" => $tniaukelsemua,
					),
					"Sip"=>array(
						"PengunjungSipBaru" => $tniausipbaru,
						"PengunjungSipLama" => $tniausipulang,
						"PengunjungSipSemua" => $tniausipsemua,
					),
					
				),
				
				"Bpjs"=>array(
					"BpjsBaru" => $bpjsbaru,
					"BpjsLama" => $bpjsulang,
					"BpjsSemua" => $bpjssemua,
				),
				"Yanmas"=>array(
					"YanmasBaru" => $yanmasbaru,
					"YanmasLama" => $yanmasulang,
					"YanmasSemua" => $yanmassemua,
				),
				"Jumlah"=>array(
					
					"JumlahBaru" => $jumlahbaru,
					"JumlahLama" => $jumlahulang,
					"JumlahSemua" => $jumlahsemua,
				),
				//"Poli"=> $poll->namapoli,
				"JenisRawat"=> $jeni->jenisrawat,
				"Tahun"=> date('Y',strtotime($awal)),
				"Bulan"=> date('F',strtotime($awal)),
			
				
				
						
				));
	}
	public function actionLapbulAll($awal,$akhir){
		//tniaumil
		$tniaumilbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan < 2 ')->count();
		$tniaumilulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan > 1 ')->count();
		$tniaumilsemua = $tniaumilbaru + $tniaumilulang;
		//tniaukel
		$tniaukelbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->count();
		$tniaukelulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 1 ')->count();
		$tniaukelsemua = $tniaukelbaru + $tniaukelulang;
		//tniausip
		$tniausipbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=> 2])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->count();
		$tniausipulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=> 2])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 1 ')->count();
		$tniausipsemua = $tniausipbaru + $tniausipulang;
		
		//bpjs
		$bpjsbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->andwhere('kunjungan < 2 ')->count();
		$bpjsulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->andwhere('kunjungan > 1 ')->count();
		$bpjssemua = $bpjsbaru + $bpjsulang;
		
		//yanmas
		$yanmasbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->andwhere('kunjungan < 2 ')->count();
		$yanmasulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->andwhere('kunjungan > 1 ')->count();
		$yanmassemua = $yanmasbaru + $yanmasulang;
		
		//jumlah
		$jumlahbaru = $tniaumilbaru + $tniaukelbaru + $tniausipbaru + $bpjsbaru + $yanmasbaru;
		$jumlahulang = $tniaumilulang + $tniaukelulang + $tniausipulang + $bpjsulang + $yanmasulang;
		$jumlahsemua = $tniaumilsemua + $tniaukelsemua + $tniausipsemua + $bpjssemua + $yanmassemua;
		//$jeni = Jenisrawat::find()->where(['id'=>$jenis])->one();
		
		return (array(
				
				"tniau"=>array(
					"Mil"=>array(
						"PengunjungMilBaru" => $tniaumilbaru,
						"PengunjungMilLama" => $tniaumilulang,
						"PengunjungMilSemua" => $tniaumilsemua,
					),
					"Kel"=>array(
						"PengunjungKelBaru" => $tniaukelbaru,
						"PengunjungKelLama" => $tniaukelulang,
						"PengunjungKelSemua" => $tniaukelsemua,
					),
					"Sip"=>array(
						"PengunjungSipBaru" => $tniausipbaru,
						"PengunjungSipLama" => $tniausipulang,
						"PengunjungSipSemua" => $tniausipsemua,
					),
					
				),
				
				"Bpjs"=>array(
					"BpjsBaru" => $bpjsbaru,
					"BpjsLama" => $bpjsulang,
					"BpjsSemua" => $bpjssemua,
				),
				"Yanmas"=>array(
					"YanmasBaru" => $yanmasbaru,
					"YanmasLama" => $yanmasulang,
					"YanmasSemua" => $yanmassemua,
				),
				"Jumlah"=>array(
					
					"JumlahBaru" => $jumlahbaru,
					"JumlahLama" => $jumlahulang,
					"JumlahSemua" => $jumlahsemua,
				),
				//"Poli"=> $poll->namapoli,
				//"JenisRawat"=> $jeni->jenisrawat,
				"Tahun"=> date('Y',strtotime($awal)),
				"Bulan"=> date('F',strtotime($awal)),
			
				
				
						
				));
	}
	public function actionLapbulpolibyid($awal,$akhir,$poli){
		
		//tniaumil
		$tniaumilbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>null])->count();
		
		$tniaumilulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>null])->count();
		$tniaumilsemua = $tniaumilbaru + $tniaumilulang;
		//tniaukel
		$tniaukelbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>null])->count();
		$tniaukelulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>null])->count();
		$tniaukelsemua = $tniaukelbaru + $tniaukelulang;
		//tniausip
		$tniausipbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=> 2])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>null])->count();
		$tniausipulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=> 2])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>null])->count();
		$tniausipsemua = $tniausipbaru + $tniausipulang;
		
		//bpjs
		$bpjsbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>null])->count();
		$bpjsulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>null])->count();
		$bpjssemua = $bpjsbaru + $bpjsulang;
		
		//yanmas
		$yanmasbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->andwhere('kunjungan < 2 ')->andwhere(['batal'=>null])->count();
		$yanmasulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->andwhere('kunjungan > 1 ')->andwhere(['batal'=>null])->count();
		$yanmassemua = $yanmasbaru + $yanmasulang; 
		
		//jumlah
		$jumlahbaru = $tniaumilbaru + $tniaukelbaru + $tniausipbaru + $bpjsbaru + $yanmasbaru;
		$jumlahulang = $tniaumilulang + $tniaukelulang + $tniausipulang + $bpjsulang + $yanmasulang;
		$jumlahsemua = $tniaumilsemua + $tniaukelsemua + $tniausipsemua + $bpjssemua + $yanmassemua;
		$poll = Poli::find()->where(['id'=>$poli])->one();
		
		return (array(
				
				"tniau"=>array(
					"Mil"=>array(
						"PengunjungMilBaru" => $this->angkaNol($tniaumilbaru),
						"PengunjungMilLama" => $this->angkaNol($tniaumilulang),
						"PengunjungMilSemua" => $this->angkaNol($tniaumilsemua),
					),
					"Kel"=>array(
						"PengunjungKelBaru" => $this->angkaNol($tniaukelbaru),
						"PengunjungKelLama" => $this->angkaNol($tniaukelulang),
						"PengunjungKelSemua" => $this->angkaNol($tniaukelsemua),
					),
					"Sip"=>array(
						"PengunjungSipBaru" => $this->angkaNol($tniausipbaru),
						"PengunjungSipLama" => $this->angkaNol($tniausipulang),
						"PengunjungSipSemua" =>$this->angkaNol($tniausipsemua),
					),
					
				),
				
				"Bpjs"=>array(
					"BpjsBaru" => $this->angkaNol($bpjsbaru),
					"BpjsLama" => $this->angkaNol($bpjsulang),
					"BpjsSemua" => $this->angkaNol($bpjssemua),
				),
				"Yanmas"=>array(
					"YanmasBaru" => $this->angkaNol($yanmasbaru),
					"YanmasLama" => $this->angkaNol($yanmasulang),
					"YanmasSemua" => $this->angkaNol($yanmassemua),
				),
				"Jumlah"=>array(
					
					"JumlahBaru" => $this->angkaNol($jumlahbaru),
					"JumlahLama" => $this->angkaNol($jumlahulang),
					"JumlahSemua" => $this->angkaNol($jumlahsemua),
				),
				"Poli"=> $poll->namapoli,
				"Tahun"=> date('Y',strtotime($awal)),
				"Bulan"=> date('F',strtotime($awal)),
			
				
				
						
				));
	}
	
	public function actionKeybpjs(){
			$data = "29250";
			$secretKey = "5lQ5E30F4C";
         // Computes the timestamp
          date_default_timezone_set('UTC');
          $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
           // Computes the signature by hashing the salt with the secret key as the key
			$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
 
   // base64 encode…
   $encodedSignature = base64_encode($signature);
	 return $this->render('keybpjs', [
            'secretKey' => $secretKey,
            'encodedSignature' => $encodedSignature,
			'tStamp'=>$tStamp,
			
        ]);
   }

}