<?php
namespace backend\controllers;
use common\models\Rawatjalan;
use common\models\ApotekStokopname;
use common\models\Trxresep;
use common\models\Trxapotek;
use common\models\JenisDiagnosa;
use common\models\PemeriksaanIgd;
use common\models\KategoriPenyakit;
use common\models\Trandetail;
use common\models\Pasien;
use common\models\Kattindakanlab;
use common\models\KategoriPenyakitMulut;
use common\models\Daflab;
use common\models\Obat;
use common\models\Trandokter;
use common\models\Lab;
use common\models\Tindakan; 
use common\models\Transaksi;
use common\models\KategoriTindakan; 
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\CompositeAuth;
use yii\helpers\ArrayHelper;

class RestController extends \yii\rest\Controller
{  
    
    public function actionResepTransaksi(){
		$belumumum = Rawatjalan::find()->where(['apotek'=>null])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")'=>date('Y-m-d')])->andwhere(['idbayar'=>4])->count();
		$selesaiumum = Trxapotek::find()->where(['>','status',0])->andwhere(['tglresep'=>date('Y-m-d')])->andwhere(['idbayar'=>4])->count();
		
		$belumbpjs = Rawatjalan::find()->where(['apotek'=>null])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")'=>date('Y-m-d')])->andwhere(['idbayar'=>5])->count();
		$selesaibpjs = Trxapotek::find()->where(['>','status',0])->andwhere(['tglresep'=>date('Y-m-d')])->andwhere(['idbayar'=>5])->count();
		
		return (array(
			'TrxSelesaiUmum'=>$selesaiumum,
			'TrxBelumUmum'=>$belumumum,
			'TrxSelesaiBpjs'=>$selesaibpjs,
			'TrxBelumBpjs'=>$belumbpjs,
		));
	}
	public function actionResep($rm){
		$rawat = Rawatjalan::find()->where(['no_rekmed'=>$rm])->andwhere(['apotek'=>null])->orderBy(['tgldaftar'=>SORT_DESC])->all();
		$arrdip = array();
		foreach($rawat as $rawat){
			if($rawat->idjenisrawat == 1){
				$poli = $rawat->polii->namapoli;
			}else{
				$poli = 'Poli '.$rawat->jerawat->jenisrawat;
			}
			array_push($arrdip,[
				'Id'=>$rawat->id,
				'Nama'=>$rawat->pasien->nama_pasien,
				'NoRm'=>$rawat->no_rekmed,
				'JenisBayar'=>$rawat->carabayar->jenisbayar,
				'IdRawat'=>$rawat->idrawat,
				'TglDaftar'=>date('Y/m/d',strtotime($rawat->tgldaftar)),
				//'TglMasuk'=>date('Y/m/d',strtotime($rawat->tglmasuk)),
				'JenisRawat'=>$rawat->jerawat->jenisrawat,
				'Poliklinik'=>$poli,
			]);
		}
		return $arrdip;
	}
	public function actionResepDetail($rm){
		$rawat = Trxapotek::find()->where(['norm'=>$rm])->all();
		$arrdip = array();
		foreach($rawat as $rawat){
			// if($rawat->idjenisrawat == 1){
				// $poli = $rawat->rawat->polii->namapoli;
			// }else{
				// $poli = 'Poli '.$rawat->rawat->jerawat->jenisrawat;
			// }
			array_push($arrdip,[
				'Id'=>$rawat->id,
				'IdRajal'=>$rawat->idrawat,
				'Nama'=>$rawat->nama,
				'NoRm'=>$rawat->norm,
				'JenisBayar'=>$rawat->bayar->jenisbayar,
				'IdRawat'=>$rawat->koderawat,
				'IdResep'=>$rawat->idtrx,
				'TglDaftar'=>date('Y/m/d',strtotime($rawat->tglresep)),
				//'TglMasuk'=>date('Y/m/d',strtotime($rawat->tglmasuk)),
				'JenisRawat'=>$rawat->jenisrawat->jenisrawat,
				// 'Poliklinik'=>$poli,
				'Total'=>$rawat->total,
			]);
		}
		return $arrdip;
	}
    public function actionBilling($rm){
		$rawat = Rawatjalan::find()->where(['sbayar'=>null])->andwhere(['no_rekmed'=>$rm])->orderBy(['tgldaftar'=>SORT_DESC])->all();
		$arrdip = array();
		foreach($rawat as $rawat){
			if($rawat->idjenisrawat == 1){
				$poli = $rawat->polii->namapoli;
			}else{
				$poli = 'Poli '.$rawat->jerawat->jenisrawat;
			}
			array_push($arrdip,[
				'Id'=>$rawat->id,
				'Nama'=>$rawat->pasien->nama_pasien,
				'NoRm'=>$rawat->no_rekmed,
				'JenisBayar'=>$rawat->carabayar->jenisbayar,
				'IdRawat'=>$rawat->idrawat,
				'TglDaftar'=>date('Y/m/d',strtotime($rawat->tgldaftar)),
				//'TglMasuk'=>date('Y/m/d',strtotime($rawat->tglmasuk)),
				'JenisRawat'=>$rawat->jerawat->jenisrawat,
				'IdJenis'=>$rawat->idjenisrawat,
				'Poliklinik'=>$poli,
			]);
		}
		return $arrdip;
	}
	public function actionBillingTransaksi(){
		$belumumum = Rawatjalan::find()->where(['sbayar'=>null])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")'=>date('Y-m-d')])->andwhere(['idbayar'=>4])->andwhere(['batal'=>0])->count();
		$selesaiumum = Transaksi::find()->where(['>','status',0])->andwhere(['tglbayar'=>date('Y-m-d')])->andwhere(['idbayar'=>4])->count();
		
		$belumbpjs = Rawatjalan::find()->where(['sbayar'=>null])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")'=>date('Y-m-d')])->andwhere(['idbayar'=>5])->andwhere(['batal'=>0])->count();
		$selesaibpjs = Transaksi::find()->where(['>','status',0])->andwhere(['tglbayar'=>date('Y-m-d')])->andwhere(['idbayar'=>5])->count();
		
		return (array(
			'TrxSelesaiUmum'=>$selesaiumum,
			'TrxBelumUmum'=>$belumumum,
			'TrxSelesaiBpjs'=>$selesaibpjs,
			'TrxBelumBpjs'=>$belumbpjs,
		));
	}
	public function actionBilling2($rm){
		$rawat = Transaksi::find()->where(['no_rm'=>$rm])->all();
		$arrdip = array();
		foreach($rawat as $rawat){
			if($rawat->idjenisrawat == 1){
				$poli = '-';
			}else{
				$poli = 'Poli '.$rawat->idjenisrawat;
			}
			if($rawat->idjenisrawat== null){
			    $polii = '';
			}else{
			    $polii= $rawat->jerawat->jenisrawat;
			}
			array_push($arrdip,[
				'Id'=>$rawat->id,
				'Nama'=>$rawat->pasien->nama_pasien,
				'NoRm'=>$rawat->no_rm,
				'JenisBayar'=>$rawat->bayar->jenisbayar,
				'IdRawat'=>$rawat->idrawat,
				'TglDaftar'=>date('Y/m/d',strtotime($rawat->tglbayar)),
				//'TglMasuk'=>date('Y/m/d',strtotime($rawat->tglmasuk)),
				'JenisRawat'=>$polii,
				'Poliklinik'=>$poli,
				'Total'=>$rawat->total,
			]);
		}
		return $arrdip;
	}
    public function actionSisaEd(){
		$ed = Obat::find()->where(['>','sisastok','0'])->andwhere(['<>','sisaed','0'])->orderBy(['sisaed'=>SORT_ASC])->all();
		$arrdip = array();
		foreach($ed as $ed){
			array_push($arrdip,[
				'Nama'=>$ed->namaobat,
				'TotalStok'=>$ed->stok,
				'StokLama'=>$ed->sisastok,
				'ED'=>$ed->kadaluarsa,
				'SisaED'=>$ed->sisaed,
			]);
		}
		return $arrdip;
	}
    public function actionMinimalStok($awal,$akhir){
		$obat = Obat::find()->where(['status'=>1])->orderBy(['stok'=>SORT_ASC])->all();
		$dt1 = strtotime($awal);
		$dt2 = strtotime($akhir);
		$diff = abs($dt2-$dt1);
		$telat = $diff/86400 + 1; 
		$arrdip = array();
			foreach($obat as $t){
				$trxresep = Trxresep::find()->where(['idobat'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $awal, $akhir])->sum('jumlah');
				$trxresepc = Trxresep::find()->where(['idobat'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $awal, $akhir])->count();				
				if($trxresepc < 1){
					$rata = 'Belum ada transaksi tercatat';
				}else{
					$rata = $trxresep / $trxresepc .' '.$t->satuan->satuan;
				}
				
				array_push($arrdip,[
					'IdObat'=>$t->id,
					'Nama'=>$t->namaobat,
					'Kadaluarsa'=>$t->kadaluarsa,
					'SisaStok'=>$t->stok,
					'MinimalStok'=>$t->mstok,
					'Resep'=>$trxresepc,
					'RataKeluar'=>$rata,
				]);
			}
			
			return $arrdip;
		
	}
    public function actionPendapatanFarmasi($awal,$akhir){
		$jumlahresepumum = Trxapotek::find()->where(['status'=>1])->andwhere(['idbayar'=>4])->andwhere(['between', 'DATE_FORMAT(tgl,"%Y-%m-%d")', $awal, $akhir])->count();
		$jumlahnominalumum = Trxapotek::find()->where(['status'=>1])->andwhere(['idbayar'=>4])->andwhere(['between', 'DATE_FORMAT(tgl,"%Y-%m-%d")', $awal, $akhir])->sum('total');
		$jumlahresepbpjs = Trxapotek::find()->where(['status'=>1])->andwhere(['idbayar'=>5])->andwhere(['between', 'DATE_FORMAT(tgl,"%Y-%m-%d")', $awal, $akhir])->count();
		$jumlahnominalbpjs = Trxapotek::find()->where(['status'=>1])->andwhere(['idbayar'=>5])->andwhere(['between', 'DATE_FORMAT(tgl,"%Y-%m-%d")', $awal, $akhir])->sum('total');
		return (array(					
					"ResepUmum"=>$jumlahresepumum,
					"NominalUmum"=>$jumlahnominalumum,
					
					"ResepBpjs"=>$jumlahresepbpjs,
					"NominalBpjs"=>$jumlahnominalbpjs,
				));
		
	}
    public function actionPenerimaanResep($awal,$akhir){
		$rawatjalan = Trxapotek::find()->where(['<>','idlok',2])->andwhere(['between', 'DATE_FORMAT(tglresep,"%Y-%m-%d")', $awal, $akhir])->count();
		$mondok = Trxapotek::find()->where(['idlok'=>2])->andwhere(['between', 'DATE_FORMAT(tglresep,"%Y-%m-%d")', $awal, $akhir])->count();
		$jumlah = $rawatjalan + $mondok;
		return (array(					
					"Rajal"=>$rawatjalan,
					"Mondok"=>$mondok,
					"Jumlah"=>$jumlah,
				));
	}
	public function actionKegiatanUgd($awal,$akhir){
		
			$bedahrawat = PemeriksaanIgd::find()->joinWith(['rawat as rawat'])->where(['statuspasien'=>'Dirawat'])->andwhere(['between', 'DATE_FORMAT(rawat.tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['rawat.prosedur'=>'Bedah'])->andwhere(['rawat.batal'=>NULL])->andwhere(['between', 'rawat.status', 2, 8])->count();
		$bedahrujuk = PemeriksaanIgd::find()->joinWith(['rawat as rawat'])->where(['statuspasien'=>'Dirujuk'])->andwhere(['between', 'DATE_FORMAT(rawat.tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['rawat.prosedur'=>'Bedah'])->andwhere(['rawat.batal'=>NULL])->andwhere(['between', 'rawat.status', 2, 8])->count();
		$bedahpulang = PemeriksaanIgd::find()->joinWith(['rawat as rawat'])->where(['statuspasien'=>'Pulang'])->andwhere(['between', 'DATE_FORMAT(rawat.tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['rawat.prosedur'=>'Bedah'])->andwhere(['rawat.batal'=>NULL])->andwhere(['between', 'rawat.status', 2, 8])->count();
		$bedahmeninggal = PemeriksaanIgd::find()->joinWith(['rawat as rawat'])->where(['statuspasien'=>'Meninggal'])->andwhere(['between', 'DATE_FORMAT(rawat.tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['rawat.prosedur'=>'Bedah'])->andwhere(['rawat.batal'=>NULL])->andwhere(['between', 'rawat.status', 2, 8])->count();
		
		$nonrawat = PemeriksaanIgd::find()->joinWith(['rawat as rawat'])->where(['statuspasien'=>'Dirawat'])->andwhere(['between', 'DATE_FORMAT(rawat.tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['rawat.prosedur'=>'Non Bedah'])->andwhere(['rawat.batal'=>NULL])->andwhere(['between', 'rawat.status', 2, 8])->count();
		$nonrujuk = PemeriksaanIgd::find()->joinWith(['rawat as rawat'])->where(['statuspasien'=>'Dirujuk'])->andwhere(['between', 'DATE_FORMAT(rawat.tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['rawat.prosedur'=>'Non Bedah'])->andwhere(['rawat.batal'=>NULL])->andwhere(['between', 'rawat.status', 2, 8])->count();
		$nonpulang = PemeriksaanIgd::find()->joinWith(['rawat as rawat'])->where(['statuspasien'=>'Pulang'])->andwhere(['between', 'DATE_FORMAT(rawat.tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['rawat.prosedur'=>'Non Bedah'])->andwhere(['rawat.batal'=>NULL])->andwhere(['between', 'rawat.status', 2, 8])->count();
		$nonmeninggal = PemeriksaanIgd::find()->joinWith(['rawat as rawat'])->where(['statuspasien'=>'Meninggal'])->andwhere(['between', 'DATE_FORMAT(rawat.tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['rawat.prosedur'=>'Non Bedah'])->andwhere(['rawat.batal'=>NULL])->andwhere(['between', 'rawat.status', 2, 8])->count();
		$jumlahbedah = $bedahrawat + $bedahrujuk + $bedahpulang + $bedahmeninggal;
		$jumlahnon = $nonrawat + $nonrujuk + $nonpulang + $nonmeninggal;
		
		$jumlahrawat = $nonrawat + $bedahrawat  ;
		$jumlahrujuk = $nonrujuk + $bedahrujuk;
		$jumlahpulang = $nonpulang + $bedahpulang;
		$jumlahmeninggal = $nonmeninggal + $bedahmeninggal ;
		
		$jumlah = $jumlahbedah + $jumlahnon ;
		return (array(					
					"Bedah"=>array(
						"Rawat" => $bedahrawat,
						"Rujuk" => $bedahrujuk,
						"Pulang" => $bedahpulang,
						"Meninggal" => $bedahmeninggal,
					),
					"NonBedah"=>array(
						"Rawat" => $nonrawat,
						"Rujuk" => $nonrujuk,
						"Pulang" => $nonpulang,
						"Meninggal" => $nonmeninggal,
					),
					"JumlahRawat"=>$jumlahrawat,
					"JumlahRujuk"=>$jumlahrujuk,
					"JumlahPulang"=>$jumlahpulang,
					"JumlahMeninggal"=>$jumlahmeninggal,
					"JumlahBedah"=>$jumlahbedah,
					"JumlahNonBedah"=>$jumlahnon,
					"Jumlah"=>$jumlah,
				));
	}
    public function actionPenyakitGigi($awal,$akhir){
		$penyakit = KategoriPenyakitMulut::find()->all();
		$arrdip = array();
		foreach($penyakit as $t){
			$tniaumil = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>1])->andwhere(['macampenyakitmulut'=>$t->id])->andwhere(['pasien.idpekerjaan'=>1])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();		
			$tniausip = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['macampenyakitmulut'=>$t->id])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['idpoli'=>1])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
			$tniaukel = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['macampenyakitmulut'=>$t->id])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere(['idpoli'=>1])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
			
			$bpjs = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['macampenyakitmulut'=>$t->id])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idpoli'=>1])->andwhere(['idbayar'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
			
			$yanmas = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['macampenyakitmulut'=>$t->id])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
			
			$jumlah = $tniaumil+$tniausip+$tniaukel+$bpjs+$yanmas;
			array_push($arrdip,[
				'Nama'=>$t->penyakit,
				'TniauMil'=>$this->angkaNol($tniaumil),
				'TniauSip'=>$this->angkaNol($tniausip),
				'TniauKel'=>$this->angkaNol($tniaukel),  
				'Yanmas'=>$this->angkaNol($yanmas),
				'Bpjs'=>$this->angkaNol($bpjs), 
				'Jumlah'=>$this->angkaNol($jumlah), 
			]);
		}
		return $arrdip;
		
		
	}
	public function actionKelahiran($awal,$akhir){
		$tniaumilnh = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>1])->andwhere(['status_melahirkan'=>1])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();		
		$tniaumilnm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>1])->andwhere(['status_melahirkan'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniaumilsch = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>1])->andwhere(['status_melahirkan'=>3])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();		
		$tniaumilscm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>1])->andwhere(['status_melahirkan'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniaumilim = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>1])->andwhere(['status_melahirkan'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		
		$tniausipnh = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>1])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniausipnm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniausipsch = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>3])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniausipscm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniausipib = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		
		$tniaukelnh = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>1])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniaukelnm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniaukelsch = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>3])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniaukelscm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['status_melahirkan'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$tniaukelib = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		
		$bpjsnh = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>1])->andwhere(['idbayar'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$bpjsnm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>2])->andwhere(['idbayar'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$bpjssch = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>3])->andwhere(['idbayar'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$bpjsscm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>4])->andwhere(['idbayar'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$bpjsim = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>5])->andwhere(['idbayar'=>5])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
			
		$yanmasnh = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>1])->andwhere(['idbayar'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$yanmasnm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>2])->andwhere(['idbayar'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$yanmassch = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>3])->andwhere(['idbayar'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$yanmasscm = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>4])->andwhere(['idbayar'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		$yanmasim = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['status_melahirkan'=>5])->andwhere(['idbayar'=>4])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->count();
		
		$kelahirannh = $tniaumilnh + $tniausipnh + $tniaukelnh + $yanmasnh + $bpjsnh ;
		$kelahirannm = $tniaumilnm + $tniausipnm + $tniaukelnm + $yanmasnm + $bpjsnm ;
		$snh = $tniaumilsch + $tniausipsch + $tniaukelsch + $yanmassch + $bpjssch ;
		$snm = $tniaumilscm + $tniausipsch + $tniaukelscm + $yanmasscm + $bpjsscm ;
		$im = $tniaumilim + $tniaukelib + $tniausipib + $yanmasim + $bpjsim ;
		
		return (array(					
					"tniau"=>array(
						"Mil"=>array(
							"NormalHidup" => $this->angkaNol($tniaumilnh),
							"NormalMati" => $this->angkaNol($tniaumilnm),
							"ScHidup" => $this->angkaNol($tniaumilsch),
							"ScMati" => $this->angkaNol($tniaumilscm),
							"IbuMeninggal" => $this->angkaNol($tniaumilim),
						),
						"Sip"=>array(
							"NormalHidup" => $this->angkaNol($tniausipnh),
							"NormalMati" => $this->angkaNol($tniausipnm),
							"ScHidup" => $this->angkaNol($tniausipsch),
							"ScMati" => $this->angkaNol($tniausipscm),
							"IbuMeninggal" => $this->angkaNol($tniausipib),
						),
						"Kel"=>array(
							"NormalHidup" => $this->angkaNol($tniaukelnh),
							"NormalMati" => $this->angkaNol($tniaukelnm),
							"ScHidup" => $this->angkaNol($tniaukelsch),
							"ScMati" => $this->angkaNol($tniaukelscm),
							"IbuMeninggal" => $this->angkaNol($tniaukelib),
						),
					),
					"Yanmas"=>array(
							"NormalHidup" => $this->angkaNol($yanmasnh),
							"NormalMati" => $this->angkaNol($yanmasnm),
							"ScHidup" => $this->angkaNol($yanmassch),
							"ScMati" => $this->angkaNol($yanmasscm),
							"IbuMeninggal" => $this->angkaNol($yanmasim),
						),
					"Bpjs"=>array(
							"NormalHidup" => $this->angkaNol($bpjsnh),
							"NormalMati" => $this->angkaNol($bpjsnm),
							"ScHidup" => $this->angkaNol($bpjssch),
							"ScMati" => $this->angkaNol($bpjsscm),
							"IbuMeninggal" => $this->angkaNol($bpjsim),
						),
					"Jumlah"=>array(
							"NormalHidup" => $this->angkaNol($kelahirannh),
							"NormalMati" => $this->angkaNol($kelahirannm),
							"ScHidup" => $this->angkaNol($snh),
							"ScMati" => $this->angkaNol($snm),
							"IbuMeninggal" => $this->angkaNol($im),
						),
				  )
				);
	}
	public function actionLab($awal,$akhir){ 
		$tindakan = Daflab::find()->all();
		$arrdip = array();
		foreach($tindakan as $t){
			$labtnimil = Lab::find()->where(['idjenisp'=>$t->id])->joinWith(['orlab as orlab'])->joinWith(['orlab.pasien as pasien'])->andwhere(['between', 'DATE_FORMAT(tanggal_req,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=>1])->count();
			$labtnisip = Lab::find()->where(['idjenisp'=>$t->id])->joinWith(['orlab as orlab'])->joinWith(['orlab.pasien as pasien'])->joinWith(['orlab.rawat as rawat'])->andwhere(['between', 'DATE_FORMAT(tanggal_req,"%Y-%m-%d")', $awal, $akhir])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['rawat.anggota'=>1])->count();  
			$labtnikel = Lab::find()->where(['idjenisp'=>$t->id])->joinWith(['orlab as orlab'])->joinWith(['orlab.pasien as pasien'])->joinWith(['orlab.rawat as rawat'])->andwhere(['between', 'DATE_FORMAT(tanggal_req,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawat.anggota'=>1])->count(); 
			$labyanmas = Lab::find()->where(['idjenisp'=>$t->id])->joinWith(['orlab as orlab'])->joinWith(['orlab.pasien as pasien'])->joinWith(['orlab.rawat as rawat'])->andwhere(['between', 'DATE_FORMAT(tanggal_req,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawat.idbayar'=>12])->count(); 
			$labbpjs = Lab::find()->where(['idjenisp'=>$t->id])->joinWith(['orlab as orlab'])->joinWith(['orlab.pasien as pasien'])->joinWith(['orlab.rawat as rawat'])->andwhere(['between', 'DATE_FORMAT(tanggal_req,"%Y-%m-%d")', $awal, $akhir])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawat.idbayar'=>5])->count(); 
			
			$labjumlah = $labbpjs+$labtnikel+$labtnimil+$labtnisip+$labyanmas;
			array_push($arrdip,[
				'Nama'=>$t->namapemeriksaan,   
				'TniauMil'=>$labtnimil,   
				'TniauKel'=>$labtnikel,   
				'TniauSip'=>$labtnisip,   
				'Yanmas'=>$labyanmas,   
				'Bpjs'=>$labbpjs,   
				'Jumlah'=>$labjumlah,  
			]); 
		}
		return $arrdip;
	}
	public function actionKunjunganGigi($awal,$akhir){
		$jenis = 1;
		$tniaumilbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan < 2 ')->count();
		$tniaumilulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan > 1 ')->count();
		$tniaumilsemua = $tniaumilbaru + $tniaumilulang;
		//tniaukel
		$tniaukelbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->count();
		$tniaukelulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 1 ')->count();
		$tniaukelsemua = $tniaukelbaru + $tniaukelulang;
		//tniausip
		$tniausipbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['pasien.idpekerjaan'=> 2])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->count();
		$tniausipulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['pasien.idpekerjaan'=> 2])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 1 ')->count();
		$tniausipsemua = $tniausipbaru + $tniausipulang;
		
		//bpjs
		$bpjsbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->andwhere('kunjungan < 2 ')->count();
		$bpjsulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->andwhere('kunjungan > 1 ')->count();
		$bpjssemua = $bpjsbaru + $bpjsulang;
		
		//yanmas
		$yanmasbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->andwhere('kunjungan < 2 ')->count();
		$yanmasulang = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>$jenis])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $awal, $akhir])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->andwhere('kunjungan > 1 ')->count();
		$yanmassemua = $yanmasbaru + $yanmasulang;
		$jumlahbaru = $tniaumilbaru + $tniaukelbaru + $tniausipbaru + $bpjsbaru + $yanmasbaru;
		$jumlahulang = $tniaumilulang + $tniaukelulang + $tniausipulang + $bpjsulang + $yanmasulang;
		$jumlahsemua = $tniaumilsemua + $tniaukelsemua + $tniausipsemua + $bpjssemua + $yanmassemua;
		
		return (array(
				
				"tniau"=>array(
					"Mil"=>array(
						"PengunjungMilBaru" =>$this->angkaNol($tniaumilbaru),
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
						"PengunjungSipSemua" => $this->angkaNol($tniausipsemua),
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
				//"Poli"=> $poll->namapoli,
				"Tahun"=> date('Y',strtotime($awal)),
				"Bulan"=> date('F',strtotime($awal)),		
						
				));
		
	}
	public function actionPrintPengobatanGigi($kat,$start='',$end=''){
		$tindakan = Tindakan::find()->where(['golongan'=>$kat])->all();
		$arrdip = array();
		foreach($tindakan as $t){ 
		$tniaumil = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>1])->andwhere(['katpenyakitmulut'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['pasien.idpekerjaan'=>1])->count();		
			$tniausip = Rawatjalan::find()->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['katpenyakitmulut'=>$t->id])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['idpoli'=>1])->count();
			$tniaukel = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakitmulut'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere(['idpoli'=>1])->count();
			
			$bpjs = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakitmulut'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idpoli'=>1])->andwhere(['idbayar'=>5])->count();
			
			$yanmas = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakitmulut'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->count();
			$jumlah = $tniaumil +$tniausip + $tniaukel + $yanmas + $bpjs ;
			array_push($arrdip,[
				'Nama'=>$t->namatindakan,
				'Id'=>$t->id,   
				'TniauMil'=>$tniaumil,
				'TniauSip'=>$tniausip,
				'TniauKel'=>$tniaukel,  
				'Yanmas'=>$yanmas,
				'Bpjs'=>$bpjs,
				'Jumlah'=>$jumlah,
			]);
		}
		return $arrdip;
		
	} 
	public function actionPengobatanGigi($kat){
		$tindakan = Tindakan::find()->where(['golongan'=>$kat])->all();
		$arrdip = array();
		foreach($tindakan as $t){ 			
			array_push($arrdip,[
				'Nama'=>$t->namatindakan,
			]);
		}
		return $arrdip;
		
	} 
	public function actionPengobatanGigiKat($start='',$end=''){
		
		$arrdip = array();
		$kattindakan = KategoriTindakan::find()->all();
		foreach($kattindakan as $kt){ 
		$tindakan = Tindakan::find()->where(['golongan'=>$kt->id])->andwhere(['gigi'=>1])->all(); 
		foreach($tindakan as $t){
			$tniaumil = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idpoli'=>1])->andwhere(['katpenyakitmulut'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['pasien.idpekerjaan'=>1])->count();		
			$tniausip = Rawatjalan::find()->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['katpenyakitmulut'=>$t->id])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['idpoli'=>1])->count();
			$tniaukel = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakitmulut'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->andwhere(['idpoli'=>1])->count();
			
			$bpjs = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakitmulut'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idpoli'=>1])->andwhere(['idbayar'=>5])->count();
			
			$yanmas = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakitmulut'=>$t->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['idpoli'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->count();
			$jumlah = $tniaumil +$tniausip + $tniaukel + $yanmas + $bpjs ;
			array_push($arrdip,[
				'Nama'=>$t->namatindakan,
				'Id'=>$t->id,   
				'TniauMil'=>$this->angkaNol($tniaumil),
				'TniauSip'=>$this->angkaNol($tniausip),
				'TniauKel'=>$this->angkaNol($tniaukel),  
				'Yanmas'=>$this->angkaNol($yanmas),
				'Bpjs'=>$this->angkaNol($bpjs),
				'Jumlah'=>$this->angkaNol($jumlah), 
			]);
		}
		}
		return $arrdip;
		
	}
	public function actionPelayananRanap($start='',$end=''){
		$kp = KategoriPenyakit::find()->all();
		$arrdip = array();
			foreach ($kp as $q){
				$tniaumil = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['katpenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>1])->count();				
				$tniaumilhr = Rawatjalan::find()->joinWith(['pasien as pasien'])->andwhere(['idjenisrawat'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['katpenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>1])->sum('lamarawat');						
				
				$tniausip = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['katpenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['rawatjalan.anggota'=>1])->count();				
				$tniausiphr = Rawatjalan::find()->joinWith(['pasien as pasien'])->andwhere(['idjenisrawat'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['katpenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>2])->andwhere(['rawatjalan.anggota'=>1])->sum('lamarawat');						
				
				$tniaukel = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakit'=>$q->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->count();
				$tniaukelhr = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakit'=>$q->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->sum('lamarawat');
				
				$tniadmil = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['katpenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>3])->count();				
				$tniadmilhr = Rawatjalan::find()->joinWith(['pasien as pasien'])->andwhere(['idjenisrawat'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['katpenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>3])->sum('lamarawat');		
				
				$tnialmil = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['idjenisrawat'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['katpenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>4])->count();				
				$tnialmilhr = Rawatjalan::find()->joinWith(['pasien as pasien'])->andwhere(['idjenisrawat'=>2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['katpenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>4])->sum('lamarawat');		
				
				$bpjs = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakit'=>$q->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->count();
				$bpjshr = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakit'=>$q->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->sum('lamarawat');
			
				$yanmas = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakit'=>$q->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->count();
				$yanmashr = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['katpenyakit'=>$q->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['idjenisrawat'=>2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->sum('lamarawat');
				
				$jor = $tniadmil + $tnialmil + $tniaumil +$tniausip + $tniaukel + $yanmas + $bpjs;
				$jhr = $tniadmilhr + $tnialmilhr + $tniaumilhr +$tniausiphr + $tniaukelhr + $yanmashr + $bpjshr;
				array_push($arrdip,[
						'Nama'=>$q->kategori,
						'TniAu'=>array(
							'Mil'=>$this->angkaNol($tniaumil),
							'MilHr'=>$this->angkaNol($tniaumilhr),
							'Sip'=>$this->angkaNol($tniausip),
							'SipHr'=>$this->angkaNol($tniausiphr),
							'Kel'=>$this->angkaNol($tniaukel),
							'Kelhr'=>$this->angkaNol($tniaukelhr),
						),
						'TniAd'=>array(
							'Mil'=>$this->angkaNol($tniadmil),
							'MilHr'=>$this->angkaNol($tniadmilhr),
							'Sip'=>'-',
							'SipHr'=>'-',
							'Kel'=>'-',
							'Kelhr'=>'-',
						),
						'TniAl'=>array(
							'Mil'=>$this->angkaNol($tnialmil),
							'MilHr'=>$this->angkaNol($tnialmilhr),
							'Sip'=>'-',
							'SipHr'=>'-',
							'Kel'=>'-',
							'Kelhr'=>'-',
						),
						'Bpjs'=>array(
							'Jumlah'=>$this->angkaNol($bpjs),
							'Hr'=>$this->angkaNol($bpjshr),
						),
						'Yanmas'=>array(
							'Jumlah'=>$this->angkaNol($yanmas),
							'Hr'=>$this->angkaNol($yanmashr),
						),
						'Jumlah'=>array(
							'Jumlah'=>$this->angkaNol($jor), 
							'Hr'=>$this->angkaNol($jhr),
						),
						
					]);
				}
				return $arrdip;
		}
		
	function angkaNol($nilai){
		if($nilai == 0){
			return '-';
		}else{
			return $nilai;
		}
	}
	public function actionMacamPenyakit($start='',$end=''){
		$jd = JenisDiagnosa::find()->all();
		$arrdip=array();
		foreach ($jd as $q){
			$tniad = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['jenispenyakit'=>$q->id])->andwhere(['<>','idjenisrawat',2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['pasien.idpekerjaan'=>3])->count();
			$tnial = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['jenispenyakit'=>$q->id])->andwhere(['<>','idjenisrawat',2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['pasien.idpekerjaan'=>4])->count();
			
			$tniaumil = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['jenispenyakit'=>$q->id])->andwhere(['<>','idjenisrawat',2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['pasien.idpekerjaan'=>1])->count();						
			$tniausip = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.anggota'=>1])->andwhere(['<>','idjenisrawat',2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['jenispenyakit'=>$q->id])->andwhere(['pasien.idpekerjaan'=>2])->count();
			$tniaukel = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['jenispenyakit'=>$q->id])->andwhere(['<>','idjenisrawat',2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>1])->count();
			
			$bpjs = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['jenispenyakit'=>$q->id])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['<>','idjenisrawat',2])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['rawatjalan.anggota'=>NULL])->andwhere(['idbayar'=>5])->count();
			 
			$yanmas = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['jenispenyakit'=>$q->id])->andwhere(['<>','idjenisrawat',2])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->andwhere(['>','pasien.idpekerjaan',4])->andwhere(['idbayar'=>4])->count();
			
			$jumlah = $tniad + $tnial + $tniaumil +$tniausip + $tniaukel + $yanmas + $bpjs ;
			array_push($arrdip,[
			'Nama' => $q->jenisdiagnosa,
			'IcdX' => $q->icd10,
			'TniAd' =>$this->angkaNol($tniad),
			'TniAl' => $this->angkaNol($tnial),
			'TniauMil' => $this->angkaNol($tniaumil),
			'TniauKel' => $this->angkaNol($tniaukel),
			'TniauSip' => $this->angkaNol($tniausip),
			'Bpjs' => $this->angkaNol($bpjs),
			'Yanmas' => $this->angkaNol($yanmas),
			'Jumlah' => $this->angkaNol($jumlah),
			'Bulan' =>$start,
			'Tahun' =>date('Y',strtotime($start)),
			]);
		}
		
		return $arrdip;
		
	}
	public function actionIncomeBulanan($tahun){
		$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
		$arraytr = array();
		$arrayri = array();
		$arrayrj = array();
		$all = array();
		for($bulan = 1;$bulan < 13;$bulan++)
				{
			$query = Transaksi::find()->select(['transaksi.*', 'SUM(total) AS jml'])->where(['between','idjenisrawat',1,3])->andwhere(['MONTH(tglbayar)'=>$bulan])->andwhere(['idbayar'=>4])->andwhere(['YEAR(tglbayar)'=>$tahun])->all();
			foreach($query as $tr):
				// $arraytr[$bulan][] = (int) $tr->Cnt;
				array_push($arraytr,$tr->jml );
			endforeach;
			$query2 = Transaksi::find()->select(['transaksi.*', 'SUM(total) AS jml'])->where(['between','idjenisrawat',1,3])->andwhere(['MONTH(tglbayar)'=>$bulan])->andwhere(['idbayar'=>5])->andwhere(['YEAR(tglbayar)'=>$tahun])->all();
			foreach($query2 as $ts):
				// $arraytr[$bulan][] = (int) $tr->Cnt;
				array_push($arrayrj,$ts->jml);
			endforeach;
		}
			array_push($all,[
			'JumlahUmum'=>$arraytr,
			'JumlahBpjs'=>$arrayrj
		]);
		
		return [
			'data'=>$all,
			'label'=>$label,
		];
	}
	public function actionIncomeHarian($b,$y,$bayar){
		$kalender = CAL_GREGORIAN;
		$satu = $y.'-'.$b.'-'.'01';
		$dua = $y.'-'.$b.'-'.'01';
		$bulan = date('m',strtotime($satu));
		$tahun = date('Y',strtotime($dua));
		$hari = cal_days_in_month($kalender, $bulan, $tahun);
		$arrdip=array();
		for($poe = 1;$poe < $hari; $poe++)
		{
			$query = Transaksi::find()->select(['transaksi.*', 'SUM(total) AS jml'])->where(['idbayar'=>$bayar])->andwhere(['between','idjenisrawat',1,3])->andwhere(['DAY(tglbayar)'=>$poe])->andwhere(['MONTH(tglbayar)'=>$b])->andwhere(['YEAR(tglbayar)'=>$y])->groupBy('tglbayar')->all();
			$summ=0;
			foreach($query as $tr):				
				array_push($arrdip,[
					'hari' => date('d',strtotime($tr->tglbayar)),
					'income'=> (int) $tr->jml,
				]);
			endforeach;
		}
		
		return $arrdip;
	}
	public function actionIncomeHarianRajal($b,$y,$bayar){
		$kalender = CAL_GREGORIAN;
		$satu = $y.'-'.$b.'-'.'01';
		$dua = $y.'-'.$b.'-'.'01';
		$bulan = date('m',strtotime($satu));
		$tahun = date('Y',strtotime($dua));
		$hari = cal_days_in_month($kalender, $bulan, $tahun);
		$arrdip=array();
		for($poe = 1;$poe < $hari; $poe++)
		{
			$query = Transaksi::find()->select(['transaksi.*', 'SUM(total) AS jml'])->where(['idbayar'=>$bayar])->andwhere(['idjenisrawat'=>1])->andwhere(['DAY(tglbayar)'=>$poe])->andwhere(['MONTH(tglbayar)'=>$b])->andwhere(['YEAR(tglbayar)'=>$y])->groupBy('tglbayar')->all();
			$summ=0;
			foreach($query as $tr):				
				array_push($arrdip,[
					'hari' => date('d',strtotime($tr->tglbayar)),
					'income'=> (int) $tr->jml,
				]);
			endforeach;
		}
		
		return $arrdip;
	}
	public function actionIncomeHarianUgd($b,$y,$bayar){
		$kalender = CAL_GREGORIAN;
		$satu = $y.'-'.$b.'-'.'01';
		$dua = $y.'-'.$b.'-'.'01';
		$bulan = date('m',strtotime($satu));
		$tahun = date('Y',strtotime($dua));
		$hari = cal_days_in_month($kalender, $bulan, $tahun);
		$arrdip=array();
		for($poe = 1;$poe < $hari; $poe++)
		{
			$query = Transaksi::find()->select(['transaksi.*', 'SUM(total) AS jml'])->where(['idbayar'=>$bayar])->andwhere(['idjenisrawat'=>3])->andwhere(['DAY(tglbayar)'=>$poe])->andwhere(['MONTH(tglbayar)'=>$b])->andwhere(['YEAR(tglbayar)'=>$y])->groupBy('tglbayar')->all();
			$summ=0;
			foreach($query as $tr):				
				array_push($arrdip,[
					'hari' => date('d',strtotime($tr->tglbayar)),
					'income'=> (int) $tr->jml,
				]);
			endforeach;
		}
		
		return $arrdip;
	}
	public function actionIncomeHarianRanap($b,$y,$bayar){
		$kalender = CAL_GREGORIAN;
		$satu = $y.'-'.$b.'-'.'01';
		$dua = $y.'-'.$b.'-'.'01';
		$bulan = date('m',strtotime($satu));
		$tahun = date('Y',strtotime($dua));
		$hari = cal_days_in_month($kalender, $bulan, $tahun);
		$arrdip=array();
		for($poe = 1;$poe < $hari; $poe++)
		{
			$query = Transaksi::find()->select(['transaksi.*', 'SUM(total) AS jml'])->where(['idbayar'=>$bayar])->andwhere(['idjenisrawat'=>2])->andwhere(['DAY(tglbayar)'=>$poe])->andwhere(['MONTH(tglbayar)'=>$b])->andwhere(['YEAR(tglbayar)'=>$y])->groupBy('tglbayar')->all();
			$summ=0;
			foreach($query as $tr):				
				array_push($arrdip,[
					'hari' => date('d',strtotime($tr->tglbayar)),
					'income'=> (int) $tr->jml,
				]);
			endforeach;
		}
		
		return $arrdip;
	}
	public function actionHari($b,$y,$obat){
		$kalender = CAL_GREGORIAN;
		$satu = $y.'-'.$b.'-'.'01';
		$dua = $y.'-'.$b.'-'.'01';
		$bulan = date('m',strtotime($satu));
		$tahun = date('Y',strtotime($dua));
		$hari = cal_days_in_month($kalender, $bulan, $tahun);
		$arrdip=array();
		$all=array();
		for($poe = 1;$poe < $hari; $poe++)
		{
			$query = ApotekStokopname::find()->where(['idobat'=>$obat])->andwhere(['DAY(tanggal)'=>$poe])->andwhere(['MONTH(tanggal)'=>$b])->andwhere(['YEAR(tanggal)'=>$y])->all();
			foreach($query as $tr):
				array_push($arrdip,[
					'keluar' => $tr->stokkeluar,
					'masuk' => $tr->stokmasuk,
					'hari' => date('d',strtotime($tr->tanggal)),				
				]);
			endforeach;
		}
		
		return $arrdip;
		
	}
	public function actionIndex($tahun){
		$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
		$arraytr = array();
		$arrayri = array();
		$arrayrj = array();
		$all = array();
		for($bulan = 1;$bulan < 13;$bulan++)
		{
			$query = Rawatjalan::find()->select(['COUNT(id) as Cnt'])->where(['MONTH(tgldaftar)'=>$bulan])->andwhere(['YEAR(tgldaftar)'=>$tahun])->andwhere(['idjenisrawat'=>3])->all();
			foreach($query as $tr):
				// $arraytr[$bulan][] = (int) $tr->Cnt;
				array_push($arraytr,$tr->Cnt);
			endforeach;
			
			$query2 = Rawatjalan::find()->select(['COUNT(id) as Cnt'])->where(['MONTH(tgldaftar)'=>$bulan])->andwhere(['YEAR(tgldaftar)'=>$tahun])->andwhere(['idjenisrawat'=>2])->all();
			foreach($query2 as $tr):
				// $arraytr[$bulan][] = (int) $tr->Cnt;
				array_push($arrayri,$tr->Cnt);
			endforeach;
			
			$query3 = Rawatjalan::find()->select(['COUNT(id) as Cnt'])->where(['MONTH(tgldaftar)'=>$bulan])->andwhere(['YEAR(tgldaftar)'=>$tahun])->andwhere(['idjenisrawat'=>1])->all();
			foreach($query3 as $tr):
				// $arraytr[$bulan][] = (int) $tr->Cnt;
				array_push($arrayrj,$tr->Cnt);
			endforeach;
			
		}
		array_push($all,[
			'JumlahIGD'=>$arraytr,
			'JumlahRI'=>$arrayri,
			'JumlahRJ'=>$arrayrj
		]);
		return [
			'data'=>$all,
			'label'=>$label,
			'tahun'=>$tahun,
		];
	}
	
	public function actionObatHarian($awal,$akhir,$jobat,$limit=''){
		$query = Trxresep::find()->select(['trxresep.*', 'SUM(jumlah) AS jml'])->joinWith(['obat as obt'])->where(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $awal, $akhir])->andwhere(['obt.idjenisobat'=>$jobat])->groupby('idobat')->orderBy(['jml'=>SORT_DESC])->limit($limit);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$obat = Obat::find()->where(['id'=>$q->idobat])->count();
			if($obat < 1){
				$tes =  $q->idobat;
			}else{
				$tes =  $q->obat->namaobat;
			}
			array_push($arrdip,[
			
			'id' => $q->idobat,
			'Nama' => $tes,
			'Satuan' => $q->obat->satuan->satuan,
			'Jumlah' => (int) $q->jml,
			
			]);
		}
		
		return $arrdip;
	}
	public function actionObatBulanan($bulan,$tahun,$jobat){
		$query = Trxresep::find()->select(['trxresep.*', 'SUM(jumlah) AS jml'])->joinWith(['obat as obt'])->where(['MONTH(tanggal)'=>$bulan])->andwhere(['YEAR(tanggal)'=>$tahun])->andwhere(['obt.idjenisobat'=>$jobat])->groupby('idobat')->orderBy(['jml'=>SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$obat = Obat::find()->where(['id'=>$q->idobat])->count();
			if($obat < 1){
				$tes =  $q->idobat;
			}else{
				$tes =  $q->obat->namaobat;
			}
			array_push($arrdip,[
			
			'Nama' => $tes,
			'Jumlah' => (int) $q->jml,
			
			]);
		}
		
		return $arrdip;
	}
	public function actionIcd10($bulan,$tahun){
		$query = Rawatjalan::find()->select(['rawatjalan.*', 'COUNT(kdiagnosa) AS jml'])->where(['<>','kdiagnosa','0'])->andwhere(['MONTH(tgldaftar)'=>$bulan])->andwhere(['YEAR(tgldaftar)'=>$tahun])->andwhere(['<>','idjenisrawat','2'])->andwhere(['jeniskasus'=> null])->groupBy('kdiagnosa')->orderBy(['jml' => SORT_DESC])->limit(10);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){

			array_push($arrdip,[
			'Diagnosa' => substr($q->kdiagnosa,0,5),
			'Nama' => $q->kdiagnosa,
			'Jumlah' => (int) $q->jml,
			
			]);
		}
		
		return $arrdip;
	}
	
public function actionTransaksi($awal,$akhir,$jbayar){
		$transaksi = Transaksi::find()->where(['between', 'tglbayar', $awal, $akhir])->andwhere(['idjenisrawat'=>1])->andwhere(['idbayar'=>$jbayar])->orderBy(['idjenisrawat'=>SORT_DESC])->all();
		$arrdip=array();
		foreach ($transaksi as $q){
		    $cottrx = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['trandetail.idrawat'=>$q->idrawat])->andwhere(['between', 'tanggal', $awal, $akhir])->count();
		    $counttrx = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['between', 'tanggal', $awal, $akhir])->count();
		    
		    $anj=0;
		    if($counttrx != $cottrx){
		        $anj = 'Anjing';
		    }else{
		        $anj = 10;
		    }
		    
		    if($q->kodedokter == null){
		        $dokter = $q->kodedokter;
		    }else{
		         $cekdok = Trandokter::findOne($q->kodedokter);
		            if($cekdok){
		                 $dokter = $q->dokter->namadokter;
		            }else{
		                   $dokter ='';
		            }
		    }
		    
		    $total_all = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['between', 'tanggal', $awal, $akhir])->sum('trandetail.total');
			if($q->idjenisrawat == 1){
				$rawat = 'Poliklinik';
			}else if($q->idjenisrawat == 2){
				$rawat = 'Rawat Inap';
			}else{
				$rawat = 'UGD';
			}
			$pasien = Pasien::find()->where(['no_rekmed'=>$q->no_rm])->one();
			if($pasien){
			    $nama_pasien = $pasien->nama_pasien;
			}else{
			    $nama_pasien = '';
			}
			array_push($arrdip,[			
    			'TrxId' => $q->idtrx,
    			'Nama' => $nama_pasien,
    			'JenisRawat' => $rawat,
    			'KodeDokter' => $q->kodedokter,
    			'Dokter' => $dokter,
    			'NoRM' => $q->no_rm,
    			'Total' => $q->total,
    			'Totall' => $total_all,
    			'Tgl' => date('Y/m/d',strtotime($q->tglbayar)),
    			'anj' => $anj ,
			]);
		}
		
		return $arrdip;
	}
	public function actionTransaksiUgd($awal,$akhir,$jbayar){
		$transaksi = Transaksi::find()->where(['between', 'tglbayar', $awal, $akhir])->andwhere(['idjenisrawat'=>3])->andwhere(['idbayar'=>$jbayar])->orderBy(['idjenisrawat'=>SORT_DESC])->all();
		$arrdip=array();
		foreach ($transaksi as $q){
		    $cottrx = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['trandetail.idrawat'=>$q->idrawat])->andwhere(['between', 'tanggal', $awal, $akhir])->count();
		    $counttrx = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['between', 'tanggal', $awal, $akhir])->count();
		    $pasien = Pasien::find()->where(['no_rekmed'=>$q->no_rm])->one();
		    $anj=0;
		    
		    if($counttrx != $cottrx){
		        $anj = 'dd';
		    }else{
		        $anj = 10;
		    }
		    if($pasien){
		        $nama = $pasien->nama_pasien;
		    }else{
		        $nama = '';
		    }
		    if($q->kodedokter == null){
		        $dokter = $q->kodedokter;
		    }else{
		        $trandok = Trandokter::find()->where(['id'=>$q->kodedokter])->count();
		        if($trandok > 0){
		            $cekdok = Trandokter::findOne($q->kodedokter);
		            if($cekdok){
		                 $dokter = $q->dokter->namadokter;
		            }else{
		                   $dokter ='';
		            }
		           
		        }else{
		            
		        $dokter ='';
		        }
		    }
		    
		    $total_all = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['between', 'tanggal', $awal, $akhir])->sum('trandetail.total');
			if($q->idjenisrawat == 1){
				$rawat = 'Poliklinik';
			}else if($q->idjenisrawat == 2){
				$rawat = 'Rawat Inap';
			}else{
				$rawat = 'UGD';
			}
			array_push($arrdip,[			
			'TrxId' => $q->idtrx,
			'Nama' => $nama,
			'JenisRawat' => $rawat,
			'Dokter' => $dokter,
			'NoRM' => $q->no_rm,
			'Total' => $q->total,
			'Totall' => $total_all,
			'anj' => $anj ,
			'Tgl' => date('Y/m/d',strtotime($q->tglbayar)),
			
			]);
		}
		
		return $arrdip;
	}
	public function actionTransaksiRanap($awal,$akhir,$jbayar){
		$transaksi = Transaksi::find()->joinWith(['rawat as r'])->where(['between', 'r.tglkeluar', $awal, $akhir])->andwhere(['transaksi.idjenisrawat'=>2])->andwhere(['transaksi.idbayar'=>$jbayar])->orderBy(['r.tglkeluar'=>SORT_ASC])->all();
		$arrdip=array();
		foreach ($transaksi as $q){
		     $cottrx = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['trandetail.idrawat'=>$q->idrawat])->andwhere(['between', 'tanggal', $awal, $akhir])->count();
		    $counttrx = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['between', 'tanggal', $awal, $akhir])->count();
		    
		    $anj=0;
		    if($counttrx != $cottrx){
		        $anj = 'Anjing';
		    }else{
		        $anj = 10;
		    }
		    
		    if($q->kodedokter == null){
		        $dokter = $q->kodedokter;
		    }else{
		        $trandok = Trandokter::find()->where(['id'=>$q->kodedokter])->count();
		        if($trandok > 0){
		            $cekdok = Trandokter::findOne($q->kodedokter);
		            if($cekdok){
		                 $dokter = $q->dokter->namadokter;
		            }else{
		                   $dokter ='';
		            }
		           
		        }else{
		            
		        $dokter ='';
		        }
		    }
		    
		    $total_all = Trandetail::find()->joinWith(['transaksi as tx'])->where(['tx.idbayar'=>$jbayar])->andwhere(['trandetail.idtrx'=>$q->idtrx])->andwhere(['between', 'tanggal', $awal, $akhir])->sum('trandetail.total');
			if($q->idjenisrawat == 1){
				$rawat = 'Poliklinik';
			}else if($q->idjenisrawat == 2){
				$rawat = 'Rawat Inap';
			}else{
				$rawat = 'UGD';
			}
			$pasien = Pasien::find()->where(['no_rekmed'=>$q->no_rm])->one();
			if($pasien){
			    $nama = $pasien->nama_pasien;
			}else{
			    $nama = 'Cari pasien';
			}
			if($q->total > 0){
			    array_push($arrdip,[			
			'TrxId' => $q->idtrx,
			'Nama' => $nama,
			'JenisRawat' => $rawat,
				'Dokter' => $dokter,
			'Totall' => $total_all,
			'NoRM' => $q->no_rm,
			'Total' => $q->total,
			'Tgl' => date('Y/m/d',strtotime($q->rawat->tglkeluar)),
				'anj' => $anj ,
			
			]);
			}
			    
			
		}
		
		return $arrdip;
	}
}