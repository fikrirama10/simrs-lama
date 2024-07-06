<?php
namespace common\components;
use yii\base\Component;
use common\models\RawatSpri;
use common\models\Ruangan;
use common\models\RuanganBed;
use Yii;

class VclaimFunction extends Component{
	//
	function updateKamar(){
		$model = Ruangan::find()->all();
		foreach($model as $model){
		$bed = RuanganBed::find()->where(['idruangan'=>$model->id])->andwhere(['terisi'=>0])->andwhere(['status'=>1])->count();
		$arrdip= json_encode(array(	
			"kodekelas"=>$model->kode_kelas, 
			"koderuang"=>$model->kode_ruangan, 
			"namaruang"=>"Ruang ". $model->nama_ruangan, 
			"kapasitas"=>$model->kapasitas, 
			"tersedia"=>$bed,
			"tersediapria"=>"0", 
			"tersediawanita"=>"0", 
			"tersediapriawanita"=>$bed,
		));
		//return $arrdip;
		$response= Yii::$app->kazo->bpjs_contentr('https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/0171R001',$arrdip);
		$data_json=json_decode($response, true);
		}
	}
	//SEP
	function post_sep($idsep){
		$resepSep = RawatSep::findOne($idsep);
		
	}
	//Rencana Kontrol 
	function post_spri($idspri){
		$spri = RawatSpri::findOne($idspri);
			$arrdip= json_encode(array(
           "request" => array(
					"noKartu"=>$spri->pasien->no_bpjs,
                    "kodeDokter"=>$spri->kode_dokter,
                    "poliKontrol"=>$spri->poli->kode,
                    "tglRencanaKontrol"=>$spri->tgl_rawat,
                    "user"=>"sss"
		   )));
			$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'RencanaKontrol/InsertSPRI',$arrdip);
			$data_json=json_decode($response, true);
			$spri->no_spri = $data_json['response']['noSPRI'];
			$spri->save(false);
	}
	function get_rencanakontrol($nokontrol){
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'RencanaKontrol/noSuratKontrol/'.$nokontrol);
		$data_json=json_decode($response, true);
		return $data_json;
	}
	//monitoring kunjungan
	function get_monitoring($nokartu,$awal,$akhir){
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'monitoring/HistoriPelayanan/NoKartu/'.$nokartu.'/tglAwal/'.$awal.'/tglAkhir/'.$akhir);
		$data_json=json_decode($response, true);
		return $data_json;
	}
	//rujukan by no rujukan
	function get_rujukan($noRujukan){		
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'Rujukan/'.$noRujukan);	
		$data_json=json_decode($response, true);
		return $data_json;
	}
	function get_rujukanrs($noRujukan){		
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'Rujukan/RS/'.$noRujukan);	
		$data_json=json_decode($response, true);
		return $data_json;
	}
	//rujukan by no kartu
	function get_rujukan_noka($noKartu){		
		$response= Yii::$app->kazo->bpjs_contentv2(Yii::$app->params['baseUrlBpjs'].'Rujukan/List/Peserta/'.$noKartu);	
		$data_json=json_decode($response, true);
		return $data_json;
	}
	function get_rujukan_nokars($noKartu){		
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'Rujukan/RS/List/Peserta/'.$noKartu);	
		$data_json=json_decode($response, true);
		return $data_json;
	}
	//icd 10
	function get_icd10($kode){		
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'referensi/diagnosa/'.$kode);	
		$data_json=json_decode($response, true);
		return $data_json;
	}
	//icd 9
	function get_icd9($kode){		
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'referensi/procedure/'.$kode);	
		$data_json=json_decode($response, true);
		return $data_json;
	}	
	//list kunjungan
	function get_kunjungan_list($noKartu){		
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'monitoring/HistoriPelayanan/NoKartu/0000053066182/tglMulai/2018-10-01/tglAkhir/2018-11-07');	
		$data_json=json_decode($response, true);
		return $data_json;
	}	
	//peserta by no kartu
	function get_peserta($noKartu,$tglSep){		
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'Peserta/nokartu/'.$noKartu.'/tglSEP/'.$tglSep.'');		
		$data_json=json_decode($response, true);
		return $data_json;
	}
	//peserta by no nik
	function get_peserta_nik($nik,$tglSep){		
		$response= Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'Peserta/nik/'.$nik.'/tglSEP/'.$tglSep.'');		
		$data_json=json_decode($response, true);
		return $data_json;
	}
	//poliklinik
	function get_poli($id){
		$response = Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'referensi/poli/'.$id);
		$data_json = json_decode($response, true);		
		return $data_json;
	}
	//faskes
	function get_faskes($id,$jenis){
		$response = Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'referensi/faskes/'.$id.'/'.$jenis);
		$data_json = json_decode($response, true);		
		return $data_json;
	}
	function get_dpjp($pelayanan,$spesialis,$tgl){
		$response = Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'referensi/dokter/pelayanan/'.$pelayanan.'/tglPelayanan/'.$tgl.'/Spesialis/'.$spesialis);
		$data_json = json_decode($response, true);		
		return $data_json;
	}
	function get_dokter($dpjp){
		$response = Yii::$app->kazo->bpjs_content(Yii::$app->params['baseUrlBpjs'].'referensi/dokter/'.$dpjp);
		$data_json = json_decode($response, true);		
		return $data_json;
	}
	
	//ruangan
	function get_ketersediaankamar(){
		$response = Yii::$app->kazo->bpjs_contentr('https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/read/0120R012/1/10');
		$data_json = json_decode($response, true);		
		return $data_json;
	}
	//sep
		
	
}

?>