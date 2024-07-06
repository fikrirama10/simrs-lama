<?php

namespace frontend\controllers;

use Yii;
use common\models\Kelurahan;
use common\models\Kamar;
use common\models\Tableicd;
use common\models\Pasien;
use common\models\Pasienonline;
use common\models\Poli;
use common\models\Dokter;
use common\models\Articles;
use common\models\Rawatjalan;
use common\models\Tarif;
use common\models\Diagnosaranap;
use common\models\Klpcm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
ini_set('memory_limit',-1);

class ApiController extends Controller
{
	public $serializer = [
    'class' => 'yii\rest\Serializer',
    'collectionEnvelope' => 'items',
];

public static function allowedDomains()
{
    return [
       '*' ,  // star allows all domains
       'http://localhost:3000',
    ];
}  

public $enableCsrfValidation = false;

public function behaviors()
    {
        return array_merge(parent::behaviors(), [

            // For cross-domain AJAX request
            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin'=> static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['POST','GET','PUT','OPTIONS'],
                    'Access-Control-Allow-Credentials' => false,
                    'Access-Control-Max-Age'=> 260000,// Cache (seconds)
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Origin' => false,
					

                ],
				
            ],

        ]);
    }
	public function actionDpasien(){
		$query = Rawatjalan::find()->groupby(['kdiagnosa'])->all();
		$arrdip=array();
		foreach ($query as $q){
			
			array_push($arrdip,[
			'Diganosa' => $q->kdiagnosa,
			//'Agama' => $q->created_at,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}

	public function actionPulang($arrdip=''){
	   	$arr = json_decode(file_get_contents("php://input"));
		if (empty($arr)){ 
		exit("Data empty.");
		} else {
		    $kodekelas = $arr->kodekelas;
		    $koderuang = $arr->koderuang;
		    $ruangan = $arr->namaruang;
		    $kapasitas = $arr->kapasitas;
		    $tersedia = $arr->tersedia;
		    $tersediapriawanita = $arr->tersediapriawanita;
		    $arrdip= json_encode(array(	
    			"kodekelas"=>$kodekelas, 
    			"koderuang"=>$koderuang, 
    			"namaruang"=>$ruangan, 
    			"kapasitas"=> $kapasitas, 
    			"tersedia"=>$tersedia,
    			"tersediapria"=>"0", 
    			"tersediawanita"=>"0", 
    			"tersediapriawanita"=>$tersediapriawanita,
    		));
    		//	return \yii\helpers\Json::encode($arrdip);
    		$response= Yii::$app->kazo->kamar('https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/0171R001',$arrdip);
    		$response2= Yii::$app->kazo->kamar('https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/create/0171R001',$arrdip);
	    	$data_json=json_decode($response, true);
	    	$data_json2=json_decode($response2, true);
	    	
	    	return $data_json;
		}
	}
	public function actionListSulaiman(){
	    $response= Yii::$app->vclaim->get_ketersediaankamar();
	    $data_json=json_decode($response, true);
	    return $data_json;
	    
	}
	public function actionPulangsulaiman($arrdip=''){
	   	$arr = json_decode(file_get_contents("php://input"));
		if (empty($arr)){ 
		exit("Data empty.");
		} else {
		    $kodekelas = $arr->kodekelas;
		    $koderuang = $arr->koderuang;
		    $ruangan = $arr->namaruang;
		    $kapasitas = $arr->kapasitas;
		    $tersedia = $arr->tersedia;
		    $tersediapriawanita = $arr->tersediapriawanita;
		    $arrdip= json_encode(array(	
    			"kodekelas"=>$kodekelas, 
    			"koderuang"=>$koderuang, 
    			"namaruang"=>$ruangan, 
    			"kapasitas"=> $kapasitas, 
    			"tersedia"=>$tersedia,
    			"tersediapria"=>"0", 
    			"tersediawanita"=>"0", 
    			"tersediapriawanita"=>$tersediapriawanita,
    		));
    		//	return \yii\helpers\Json::encode($arrdip);
    		$response= Yii::$app->kazo->kamarsulaiman('https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/0120R012',$arrdip);
    // 		$response2= Yii::$app->kazo->kamarsulaiman('https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/create/0120R012',$arrdip);
	    	$data_json=json_decode($response, true);
	   // 	$data_json2=json_decode($response2, true);
	    	return $data_json;
		}
	}
	
	public function actionCek($kartu,$tgl){
    //	$response= Yii::$app->vclaim->get_peserta($kartu,$tgl);
	//	$model = $response['peserta'];
		$response= Yii::$app->kazo->bpjs_contentr('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Peserta/nokartu/'.$kartu.'/tglSEP/'.$tgl);
		$data_json=json_decode($response, true);
			$model = $data_json['response']['peserta'];
    	return \yii\helpers\Json::encode($model);
	}
	public function actionPasienagama(){
		$query = Pasien::find()->select(['pasien.*', 'COUNT(agama) AS jml'])->groupBy('agama')->orderBy(['jml' => SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			$ht = Pasien::find()->where(['agama'=>$q->agama])->count();
			array_push($arrdip,[
			'Pasien' => $q->agama,
			'Agama' => $ht,
			//'Agama' => $q->created_at,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionRawatjalan($id){
	    $model = Rawatjalan::find()->where(['no_rekmed'=>$id])->andwhere(['idjenisrawat'=>1])->andwhere(['<>','status',11])->orderBy(['tgldaftar'=>SORT_DESC])->all();
	    $arrdip = array();
	    foreach($model as $m){
	        array_push($arrdip,[
	                'id'=>$m->id,
	                'poli'=>$m->polii->namapoli,
	                'dokter'=>$m->dokter->namadokter,
	                'bayar'=>$m->carabayar->jenisbayar,
	                'tglberobat'=>$m->tgldaftar,
	                'dokumen'=>$m->dokumen,
	            ]);
	    }
	    return \yii\helpers\Json::encode($arrdip);
	    
	}
	public function actionRawatinap($id){
	    $model = Rawatjalan::find()->where(['no_rekmed'=>$id])->andwhere(['idjenisrawat'=>2])->andwhere(['<>','status',11])->orderBy(['tgldaftar'=>SORT_DESC])->all();
	    $arrdip = array();
	    foreach($model as $m){
	        array_push($arrdip,[
	                'id'=>$m->id,
	                'poli'=>$m->kamar->namaruangan,
	                'dokter'=>$m->dokter->namadokter,
	                'bayar'=>$m->carabayar->jenisbayar,
	                'tglberobat'=>$m->tgldaftar,
	                'tglpulang'=>$m->tglkeluar,
	                'dokumen'=>$m->dokumen,
	            ]);
	    }
	    return \yii\helpers\Json::encode($arrdip);
	    
	}
	public function actionRawatugd($id){
	    $model = Rawatjalan::find()->where(['no_rekmed'=>$id])->andwhere(['idjenisrawat'=>3])->andwhere(['<>','status',11])->orderBy(['tgldaftar'=>SORT_DESC])->all();
	    $arrdip = array();
	    foreach($model as $m){
	        array_push($arrdip,[
	                'id'=>$m->id,
	                'poli'=>'',
	                'dokter'=>'',
	                'bayar'=>$m->carabayar->jenisbayar,
	                'tglberobat'=>$m->tgldaftar,
	                //'tglpulang'=>$m->tglkeluar,
	                'dokumen'=>$m->dokumen,
	            ]);
	    }
	    return \yii\helpers\Json::encode($arrdip);
	    
	}
    public function actionPasien($id){
		$q = Pasien::find()->where(['no_rekmed'=>$id])->one();
		$arrdip=array(
		    	'no_rekmed' => $q->no_rekmed,
    			'nama' => $q->nama_pasien,
    			'usia' => $q->usia,
    			'jenis_kelamin' => $q->jenis_kelamin,
    			'alamat' => $q->alamat,
    			'bpjs' => $q->nobpjs,
    			'nik' => $q->no_identitas,
    			'tgl_lahir' => $q->tanggal_lahir,
    			'hp' => $q->nohp,
    			//'agama'=>$q->agama,
    			'suku'=>$q->suku,
    			'pendidikan'=>$q->pendidikan,
    			'tempat_lahir'=>$q->tempat_lahir,
    			'hambatan'=>$q->idhambatan,
    			'status'=>$q->id_status,
		    );
	    
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionTarifUmum($q){
		$query = Tarif::find()->where(['idjenis'=>4])->andFilterWhere(['like', 'nama', $q])->all();
		
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'id' => $q->id,
			'tindakan' => $q->nama,
			'tarif' => $q->tarif,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionTarifBpjs($q){
		$query = Tarif::find()->where(['idjenis'=>5])->andFilterWhere(['like', 'nama', $q])->all();
		
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'id' => $q->id,
			'tindakan' => $q->nama,
			'tarif' => $q->tarif,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionPasienagamaw($awal,$akhir){
		$query = Pasien::find()->select(['pasien.*', 'COUNT(agama) AS jml'])->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->groupBy('agama')->orderBy(['jml' => SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			$ht = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['agama'=>$q->agama])->count();
			array_push($arrdip,[
			'Pasien' => $q->agama,
			'Agama' => $ht,
			//'Agama' => $q->created_at,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	

	public function actionPasienalaw($awal,$akhir){
		$query = Pasien::find()->select(['pasien.*', 'COUNT(idkel) AS kel'])->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['>','idkel',1])->groupBy('idkel')->orderBy(['kel' => SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			$ht = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['idkel'=>$q->idkel])->count();
			array_push($arrdip,[
			'Kel' => $q->kel->nama,
			'Jumlah' => $ht,
			//'Agama' => $q->created_at,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionKlpcm(){
		$query = Klpcm::find()->all();
		$arrdip=array();
		foreach ($query as $q){
			  $arrdip[] = $q->jform;
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	
	public function actionPasienpeker($awal,$akhir){
		$query = Pasien::find()->select(['pasien.*', 'COUNT(idpekerjaan) AS kerja'])->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['>','idpekerjaan',1])->groupBy('idpekerjaan')->orderBy(['kerja' => SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			$ht = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['idpekerjaan'=>$q->idpekerjaan])->count();
			array_push($arrdip,[
			'Ker' => $q->pekerjaan->jenis,
			'Jumlah' => $ht,
			//'Agama' => $q->created_at,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionPasienulima($awal,$akhir){
		//$query = Pasien::find()->all();
		$arrdip=array();
		
			$ht = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['between','usia',0,5])->count();
			array_push($arrdip,[
			'Usia' => '0 - 5' ,
			'Jumlah' => $ht,
			//'Agama' => $q->created_at,
			
			]);
			
			$ht2 = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['between','usia',6,17])->count();
			array_push($arrdip,[
			'Usia' => '6 - 17' ,
			'Jumlah' => $ht2,
			//'Agama' => $q->created_at,
			
			]);
			
			$ht3 = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['between','usia',18,40])->count();
			array_push($arrdip,[
			'Usia' => '18 - 40' ,
			'Jumlah' => $ht3,
			//'Agama' => $q->created_at,
			
			]);
			
			$ht4 = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['>','usia',40])->count();
			array_push($arrdip,[
			'Usia' => '>= 40' ,
			'Jumlah' => $ht4,
			//'Agama' => $q->created_at,
			
			]);
		
		
		return \yii\helpers\Json::encode($arrdip);
	}
		public function actionPasienkelamin($awal,$akhir){
		//$query = Pasien::find()->all();
		$arrdip=array();
		
			$ht = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['jenis_kelamin'=> 'P'])->count();
			array_push($arrdip,[
			'Kelamin' => 'Perempuan' ,
			'Jumlah' => $ht,
			//'Agama' => $q->created_at,
			
			]);
			
			$ht2 = Pasien::find()->where(['between','DATE_FORMAT(created_at,"%Y-%m-%d")',$awal,$akhir])->andwhere(['jenis_kelamin'=> 'L'])->count();
			array_push($arrdip,[
			'Kelamin' => 'Laki - Laki' ,
			'Jumlah' => $ht2,
			//'Agama' => $q->created_at,
			
			]);
			

		
		
		return \yii\helpers\Json::encode($arrdip);
	}
	function kosong($tt,$jml){
		$jumlah = $tt - $jml ;
		if($jumlah < 0){
			return '0';
		}else{
			return $jumlah;
		}
	} 
	public function actionKamar(){
		$datadiag =  Kamar::find()->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Rawatjalan::find()->where(['idruangan'=>$q->id])->andwhere(['status'=>8])->andwhere(['idjenisrawat'=>2])->count();
			array_push($arrdip,[
			'Id' => $q->id,
			'Ruangan' => $q->namaruangan,
			'Tempattidur' => $q->tempattidur,
			'Kelas' => $q->idkelas,
			'Warna' => $q->warna,
			'Kosong' => $this->kosong($q->tempattidur,$ht),
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionAlamat($q){
		$query = Kelurahan::find()->andFilterWhere(['like', 'nama', $q])->all();
		
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'id' => $q->id_kel,
			'IdKel' => $q->id_kel,			
			'nama' => $q->nama,			
			'Kec' => $q->kecamatan->nama,
			'IdKec' => $q->kecamatan->id_kec,
			'Kab' => $q->kecamatan->kabupaten->nama,
			'IdKab' => $q->kecamatan->kabupaten->id_kab,
			'Prov' => $q->kecamatan->kabupaten->provinsi->nama,
			'IdProv' => $q->kecamatan->kabupaten->provinsi->id_prov,
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}

	public function actionIcd10(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->where(['sts'=>0])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->where(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionIcd10jd(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->where(['sts'=>0])->andwhere(['between','DATE_FORMAT(tgl,"%Y-%m-%d")','2019-01-01','2019-12-31'])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->where(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionIcd10anakjd(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',1,16])->andwhere(['between','DATE_FORMAT(tgl,"%Y-%m-%d")','2019-01-01','2019-12-31'])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',1,16])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
		public function actionIcd10ana01(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',0,1])->andwhere(['between','DATE_FORMAT(tgl,"%Y-%m-%d")','2019-01-01','2019-12-31'])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',0,1])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionIcd10ana41(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',1,4])->andwhere(['between','DATE_FORMAT(tgl,"%Y-%m-%d")','2019-01-01','2019-12-31'])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',1,4])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionIcd10ana514(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',5,14])->andwhere(['between','DATE_FORMAT(tgl,"%Y-%m-%d")','2019-01-01','2019-12-31'])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',5,14])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionIcd10ana1544(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',15,44])->andwhere(['between','DATE_FORMAT(tgl,"%Y-%m-%d")','2019-01-01','2019-12-31'])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',15,44])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
		public function actionIcd10ana4575(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',45,75])->andwhere(['between','DATE_FORMAT(tgl,"%Y-%m-%d")','2019-01-01','2019-12-31'])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal'])->where(['between','rajal.usia',45,75])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	
	public function actionIcd10bedahjd(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal','rawatja.dokter as dok'])->where(['dok.idpoli'=>3])->andwhere(['sts'=>0])->andwhere(['rajal.idjenisrawat'=>2])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal','rawatja.dokter as dok'])->where(['dok.idpoli'=>3])->andwhere(['rajal.idjenisrawat'=>2])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionIcd10anak(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal'])->where(['<','rajal.usia','16'])->andwhere(['sts'=>0])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal'])->where(['<','rajal.usia','16'])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionIcd10bedah(){
		$query = Diagnosaranap::find()->select(['diagnosaranap.*', 'COUNT(kadiagnosa) AS jml'])->joinWith(['rawatja as rajal','rawatja.dokter as dok'])->where(['dok.idpoli'=>3])->andwhere(['sts'=>0])->andwhere(['rajal.idjenisrawat'=>2])->andwhere(['<>','kadiagnosa','0'])->groupBy('kadiagnosa')->orderBy(['jml' => SORT_DESC]);
		$datadiag = $query->all();
		$arrdip=array();
		foreach ($datadiag as $q){
			$ht = Diagnosaranap::find()->joinWith(['rawatja as rajal','rawatja.dokter as dok'])->where(['dok.idpoli'=>3])->andwhere(['rajal.idjenisrawat'=>2])->andwhere(['kadiagnosa'=>$q->kadiagnosa])->count();
			array_push($arrdip,[
			'Diagnosa' => $q->kadiagnosa,
			'Jumlah' => $ht,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionArtikel()
    {
        
		$query = Articles::find()->all();
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'Id' => $q->Id,
			'Judul' => $q->Title,
			'Isi' => $q->Content,
			'Publikasi' => $q->IdPub,
			'Stat' => $q->IsStatic,
			'SEO' => $q->SEO,
			'Gambar' => $q->Picture,
			'Tanggal' => $q->Created,
			
			]);
		}
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionBerita()
    {
        
		$query = Articles::find()->where(['IdCat'=>1])->orderBy(['Created'=>SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'Id' => $q->Id,
			'Judul' => $q->Title,
			'Kategori' => $q->category->Category,
			'Isi' => $q->Content,
			'Publikasi' => $q->IdPub,
			'Stat' => $q->IsStatic,
			'SEO' => $q->SEO,
			'Gambar' => $q->Picture,
			'Tanggal' => $q->Created,
			
			]);
		}
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionIcd($id)
    {
        
		$query = Tableicd::find()->where(['like', 'Kode', $id . '%', false])->all();
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'Kode' => $q->Kode,
			'Icd' => $q->Inggris." (".$q->Indonesia." )",			
			]);
		}
		return \yii\helpers\Json::encode($arrdip);
	}
		public function actionTerbanyak()
    {
        
		$query = Articles::find()->orderby(['ReadCount'=>SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'Id' => $q->Id,
			'Judul' => $q->Title,
			'Isi' => $q->Content,
			'Publikasi' => $q->IdPub,
			'Stat' => $q->IsStatic,
			'SEO' => $q->SEO,
			'Gambar' => $q->Picture,
			'Tanggal' => $q->Created,
			
			]);
		}
		return \yii\helpers\Json::encode($arrdip);
	}
	
	
	
	
	
	
	
	public function actionDaftarOnline(){
		$dafon = new Pasienonline();
		$arr = json_decode(file_get_contents("php://input"));
		if (empty($arr)){ 
		exit("Data empty.");
		} else {
		$nomorkartu = $arr->nomorkartu;
		$nik = $arr->nik;
		$notelp = $arr->notelp;
		$tanggalperiksa = $arr->tanggalperiksa;
		$kodepoli = $arr->kodepoli;
		$nomorreferensi = $arr->nomorreferensi;
		$jenisreferensi = $arr->jenisreferensi;
		$jenisrequest = $arr->jenisrequest;
		$polieksekutif = $arr->polieksekutif;
		$pc = Pasien::find()->where(['nobpjs'=>$nomorkartu])->count();
		$pasien = Pasien::find()->where(['nobpjs'=>$nomorkartu])->one();
		if($pc < 1 ){
			return json_encode(array(
			"metadata"=>array(
				"code"=>"0",
				"massage"=>"error pasien belum terdaftar di rs",
			)
			
			));
		}else{
		
		$poli = Poli::find()->where(['kodepoli'=>$kodepoli])->one();
		
		$dafon->dilayani = round(microtime(true) * 1000);
		//$dafon->idpoli = $poli;
		$dafon->tglberobat = $tanggalperiksa;
		$dafon->idpoli = $poli->id;
		$dafon->no_rekmed = $pasien->no_rekmed;
		$dafon->kodepoli = $poli->icon;
		($dafon->antrian)? $dafon->antrian : $dafon->genAntri($dafon->kodepoli);
		$dafon->genKode();
		$dafon->nik = $nik;
		$dafon->tanggal = date('Y-m-d H:i:s');
		$dafon->dilayani = round(microtime(true) * 1000);
		$dafon->nokartu = $nomorkartu;
		$dafon->nohp = $notelp;
		$dafon->norujukan = $nomorreferensi;
		
		$dafon->jenisantrian = 2;
		$dafon->jenisreferensi = $jenisreferensi;
		$dafon->jenisrequest = $jenisrequest;
		$dafon->polieksekutif = $polieksekutif;
		
		if($dafon->save(false)){
			return json_encode(array(
			"response"=>array(
			"nomorantrean" => $dafon->antrian,
			"kodebooking" => $dafon->noregistrasi,
			"jenisantrean" => $dafon->jenisantrian,
			"estimasidilayani" => $dafon->dilayani,
			"namapoli" => $dafon->polii->namapoli,
			"namadokter" => "",
			),
			"metadata"=>array(				
				"massage"=>"OK",
				"code"=>"200",
			)
			
			));
		}else{
			return 'error';
		}
		}
		}
		
		
	}
	
	
	public function actionBaca($id)
    {
        
		$query = Articles::find()->where(['SEO'=>$id])->orderby(['Created'=>SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'Id' => $q->Id,
			'Kategori' => $q->category->Category,
			'Judul' => $q->Title,
			'Isi' => $q->Content,
			'Publikasi' => $q->IdPub,
			'Stat' => $q->IsStatic,
			'SEO' => $q->SEO,
			'Gambar' => $q->Picture,
			'Tanggal' => $q->Created,
			
			]);
		}
		return \yii\helpers\Json::encode($arrdip);
	}
	public function actionPoli()
    {
        
		$query = Poli::find()->all();
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'Id' => $q->id,
			'Poli' => $q->namapoli,
			'Icon' => $q->icon,
			'Desk' => $q->deskripsi,
			'Stat' => $q->stat,
			'Show' => $q->tampil,
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
    }
	public function actionDokter()
    {
        
		$query = Dokter::find()->where(['spesialis'=>2])->orderby(['id'=>SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			array_push($arrdip,[
			'Id' => $q->id,
			'Dokter' => $q->namadokter,
			'Spesial' => $q->poli->namapoli,
			'JK' => $q->jeniskelamin,
			
			
			]);
		}
		
		return \yii\helpers\Json::encode($arrdip);
    }
	public function actionSep()
    {
        
		$query = Pasien::find()->all();
		$arrdip=array(
			   
           "request" => array(
              "t_sep" => array(
                 "noKartu"=> "0000053066182",
                 "tglSep"=> "2018-11-02",
                 "ppkPelayanan"=> "0120R012",
                 "jnsPelayanan"=> "2",
                 "klsRawat"=> "",
                 "noMR"=> "069817",
                 "rujukan"=>array(
                    "asalRujukan"=> "1",
                    "tglRujukan"=> "2018-10-17",
                    "noRujukan"=> "103018",
                    "ppkRujukan"=> "0120B114"
                 ),
                 "catatan"=> "test",
                 "diagAwal"=> "A00.1",
                 "poli"=> array(
                    "tujuan"=> "INT",
                    "eksekutif"=> "0"
                 ),
                 "cob"=>array(
                    "cob"=> "0"
                 ),
                 "katarak"=> array(
                    "katarak"=> "0"
                 ),
                 "jaminan"=> array(
                 	"lakaLantas"=> "0",
                    "penjamin"=>array( 
                        "penjamin"=> "",
                        "tglKejadian"=> "",
                        "keterangan"=> "",
                        "suplesi"=>array( 
                            "suplesi"=> "0",
                            "noSepSuplesi"=> "0",
                            "lokasiLaka"=>array (
                                "kdPropinsi"=> "",
                                "kdKabupaten"=> "",
                                "kdKecamatan"=> ""
                                )
                        )
                    )
                 ),
                 "skdp"=>array(
                    "noSurat"=> "000002",
                    "kodeDPJP"=> "31661"
                 ),
                 "noTelp"=> "00898928992",
                 "user"=> "Fikri "
              )
           )
        );

		
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$data_string = \yii\helpers\Json::encode($arrdip);
		//$data_string = json_encode($arrdip, true);
		$data = "29250";
		$secretKey = "5lQ5E30F4C";
         // Computes the timestamp
        date_default_timezone_set("UTC");
        $tStamp = strval(time()-strtotime("1970-01-01 00:00:00"));
        // Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac("sha256", $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		//$header[] = "Content-Length: " . strlen($data_string) ." ";
    
		
		$ch = curl_init("https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/1.1/insert");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		echo $result;
         //return $this->redirect(['tes/'.$dd]);
		    }
		}


?>