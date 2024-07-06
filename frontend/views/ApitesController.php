<?php
namespace frontend\controllers;
use Yii;

use common\models\Poli;
use common\models\Pasienonline;
use common\models\Pasien;
use common\models\Hari;
use common\models\Obat;
use common\models\Jadwaldokter;
use common\models\Radiologidetail;
use common\models\Jadwaloprasi;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\CompositeAuth;
use yii\helpers\ArrayHelper;
use common\models\Transaksi;
use common\models\Trandetail;
use common\models\Pengeluaran;
use common\models\Trxmanualdetail;
use common\models\Trxmanual;

class ApitesController extends \yii\rest\Controller
{
	// public function behaviors()
    // {
        // return ArrayHelper::merge(parent::behaviors(), [
            // 'authenticator' => [
                // 'class' => CompositeAuth::class,
                // 'authMethods' => [
                    // ['class' => HttpBearerAuth::class],
                    // ['class' => QueryParamAuth::class],
                // ]
            // ],
            // 'corsFilter' => [
                // 'class' => Cors::class,
            // ]
        // ]);
    // }
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
    protected function verbs()
    {
       return [
           'index' => ['GET'],
           'daftar-online' => ['POST'],
       ];
    }
		public function actionListdiagnosa($q){		
       // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	 	$response = $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/referensi/diagnosa/'.$q.'');
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['response'];
		$dd= $diagnosa['diagnosa'];
		$arrdip=array();
		foreach ($dd as $q){
			array_push($arrdip,[
			'id' => $q['nama'],
			'nama' => $q['nama'],
			
			]);
		}
		return $arrdip;
	
				
	  
    }
	public function actionKasirYanmasDay(){
		
		$arrdip=array();
		$total = 0;
		$tp = 0;
		$totalmanual = 0;
		$day = date('Y-m-d');
			$pengluaran = Pengeluaran::find()->where(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->andwhere(['status'=>1])->all();
			$pengluaranc = Pengeluaran::find()->where(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->andwhere(['status'=>1])->count();
			$trandetail = Trandetail::find()->joinWith(['transaksi as trx'])->where(['trx.idbayar'=>4])->andwhere(['trx.tglbayar'=>$day])->andwhere(['trx.status'=>1])->all();
			$tranmanual = Trxmanualdetail::find()->joinWith(['transaksi as trx'])->where(['trx.status'=>1])->andwhere(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->all();
			$trx = Transaksi::find()->where(['tglbayar'=>$day])->count();
			$trxman = Trxmanual::find()->where(['between', 'DATE_FORMAT(tgl,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->count();
			foreach ($pengluaran as $pc){
				$tp += $pc->biaya;
				
			}
			foreach ($trandetail as $trxd){
				$total += $trxd->total;
				
			}
			foreach ($tranmanual as $trxm){
				$totalmanual += $trxm->total;
				
			}
			return[
			'response'=>array(
				'kasirYanmas'=>array(
					'total'=>$total + $totalmanual,
					'total_trx'=>$trx + $trxman,
				),
				'kasirDetail'=>array(
					'total'=> $total,
					'total_trx'=> $trx,
					'totalmanual'=> $totalmanual,
					'total_trxmanual'=> $trxman,
				),
				'pengeluaran'=>array(
					'total'=>$tp,
					'total_tp'=>$pengluaranc,
				),
				
				),
				"metadata"=>array(
					"message"=>"Ok",
					"code"=>200
				),
			];
		
		
	}
	public function actionListObat($q){
		$obat = Obat::find()->where(['<>','stok',0])->andFilterWhere(['like', 'namaobat', $q])->all();
		$arrdip=array();
		foreach ($obat as $p){
			array_push($arrdip,[
			'id' => $p->id,
			'nama' => $p->namaobat,
			'harga' => $p->harga,
			'satuan' => $p->satuan->satuan,
			'stok' => $p->stok,
			
			]);
		}
		return $arrdip;
	}
	//date_default_timezone_set("Asia/Jakarta");
//fungsi check tanggal merah
	function tanggalMerah($value) {
		$array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"),true);

		//check tanggal merah berdasarkan libur nasional
		if(isset($array[$value]))
	:		return $array[$value]["deskripsi"];

		//check tanggal merah berdasarkan hari minggu
		elseif(
	date("D",strtotime($value))==="Sun"):
		return "1";

		//bukan tanggal merah
		else:
			return "2";
		endif;
	}
	public function actionJumlahrad($start='',$end=''){
		
		$where = ['between', 'DATE_FORMAT(waktu,"%Y-%m-%d")', $start, $end];
		$query = Radiologidetail::find()->select(['radiologidetail.*', 'COUNT(idjenisrad) AS jml'])->where('idjenisrad > 1')->groupBy('idjenisrad')->orderBy(['jml' => SORT_DESC])->all();
		$arrdip=array();
		foreach ($query as $q){
			$ht = Radiologidetail::find()->where(['idjenisrad'=>$q->idjenisrad])->andWhere($where)->count();
			array_push($arrdip,[
			'Pemeriksaan' => $q->drad->jenispemeriksaan,
			'Jumlah' => $ht,
			//'Agama' => $q->created_at,
			
			]);
		}
		
		return $arrdip;
	}
	
	
	
	public function actionMerah(){
		
		$hari_ini = date("20200816");
		$hasil = $this->tanggalMerah($hari_ini);
		return $hasil;
		
		
	}
	
	public function actionGetbynorujukan($norujukan){
		
		$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/'.$norujukan);
		$data_json=json_decode($response, true);
		return[
			'data'=>$data_json,
		];
		
	}
	public function actionListPoli($q){		
       // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	 	$response = $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/referensi/poli/'.$q);
		$data_json = json_decode($response, true);
		$poli = $data_json['response'];
		$pp= $poli['poli'];
		$arrdip=array();
		foreach ($pp as $p){
			array_push($arrdip,[
			'id' => $p['nama'],
			'nama' => $p['nama'],
			
			]);
		}
		return $arrdip;
	
				
	  
    }
	
	public function actionListFaskes($q){		
       // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	 	$response = $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/referensi/faskes/'.$q.'/2');
		$data_json = json_decode($response, true);
		$faskes = $data_json['response'];
		$ff= $faskes['faskes'];
		$arrdip=array();
		foreach ($ff as $f){
			array_push($arrdip,[
			'id' => $f['nama'],
			'nama' => $f['nama'],
			
			]);
		}
		return $arrdip;
	
				
	  
    }
	public function actionGetbykartu($kartu){
		$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/Peserta/'.$kartu);
		$data_json=json_decode($response, true);
		return[
			'data'=>$data_json,
		];
		
	}
	public function actionGetbynokartum($kartu){
		$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/List/Peserta/'.$kartu);
		$data_json=json_decode($response, true);
		return[
			'data'=>$data_json,
		];
		
	}

    public function actionIndex(){
		
        $examples = Poli::find()->all();
        return [
            'data'=>$examples,
        ];
    }
	public function actionOperasi(){
		$arr = json_decode(file_get_contents("php://input"));
		if (empty($arr)){ 
		exit("Data empty.");
		} else {
			
			$tglawal = $arr->tanggalawal;
			$tglakhir = $arr->tanggalakhir;
			if(strtotime($tglakhir) < strtotime($tglawal)){
			return (array(
				"metadata"=>array(
					"code" => 0,
					"message" => "Tanggal awal tidak boleh lebih besar dari tanggal akhir"
				)
				
				));	
			}
			$arrdip=array()	;
			$jadwaloperasi = Jadwaloprasi::find()->where(['between', 'DATE_FORMAT(tglpelaksanaan,"%Y-%m-%d")', $tglawal, $tglakhir])->all();
			foreach ($jadwaloperasi as $q){
				array_push($arrdip,[
				'kodebooking' => $q->kodebooking,
				'tanggaloperasi' => $q->tglpelaksanaan,
				'jenistindakan' => $q->jenistindakan,
				'kodepoli' => $q->poli->kodepoli,
				'namapoli' => $q->poli->namapoli,
				'terlaksana' => $q->terlaksana,
				'nopeserta' => $q->nobpjs,
				'lastupdate' => round(microtime(true) * 1000),
				]);

			}
			return[
				'response'=>array(
				'list'=>$arrdip
				),
				"metadata"=>array(
					"message"=>"Ok",
					"code"=>200
				),
			];
		}	
		
	}
	
	public function actionGetbooking(){
		$arr = json_decode(file_get_contents("php://input"));
		if (empty($arr)){ 
		exit("Data empty.");
		} else {
			$nobpjs = $arr->nopeserta;
			$response= $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Peserta/nokartu/'.$nobpjs.'/tglSEP/'.date('Y-m-d').'');
			$data_json=json_decode($response, true);
			if($data_json['metaData']['code'] == "201"){
				return (array(
				"metadata"=>array(
					"code"=>$data_json['metaData']['code'],
					"message"=>$data_json['metaData']['message']
				)
				
				));
			}
			else{
			$jadwaloperasi = Jadwaloprasi::find()->where(['nobpjs'=>$nobpjs])->andWhere(['terlaksana'=>0])->one();
			$jadwaloperasic = Jadwaloprasi::find()->where(['nobpjs'=>$nobpjs])->andWhere(['terlaksana'=>0])->count();
			if($jadwaloperasic < 1){
				return (array(
				"metadata"=>array(
					"code" => 0,
					"message" => "Jadwal Pasien Tidak Ada"
				)
				
				));
			}else{
				return (array(
				"response"=>array(
					"kodebooking"=>$jadwaloperasi->kodebooking,
					"tanggaloperasi"=>$jadwaloperasi->tglpelaksanaan,
					"jenistindakan"=>$jadwaloperasi->jenistindakan,
					"kodepoli"=>$jadwaloperasi->poli->kodepoli,
					"namapoli"=>$jadwaloperasi->poli->namapoli,
					"terlaksana"=>$jadwaloperasi->terlaksana,
				),
				"metadata"=>array(
					"message"=>"OK",
					"code"=>200
				),
				
				));	
			}
			//$poli = Poli::find()->where(['idpoli'=>$jadwaloperasi->kode])

			}
			
			
		}
	}
	public function actionGetRekapAntri(){
		$arr = json_decode(file_get_contents("php://input"));
		if (empty($arr)){ 
		exit("Data empty.");
		} else {
			$tanggalperiksa = $arr->tanggalperiksa;
			$kodepoli = $arr->kodepoli;
			$polieksekutif = $arr->polieksekutif;
			$kpolic = Poli::find()->where(['kodepoli'=>$kodepoli])->count();
			if($kpolic == 0){
			return (array(
				"metadata"=>array(
				"code"=>0,
				"message"=>"Kode Poli salah atau tidak tersedia di sulaiman",
				)
			));
						
			}else{
			
			$kpoli = Poli::find()->where(['kodepoli'=>$kodepoli])->one();			
			$terlayani = Pasienonline::find()->where(['idpoli'=>$kpoli->id])->andwhere(['tglberobat'=>$tanggalperiksa])->andWhere(['verived'=>1])->count();
			$jumlah = Pasienonline::find()->where(['idpoli'=>$kpoli->id])->andwhere(['tglberobat'=>$tanggalperiksa])->count();
			return (array(
			"response"=>array(
				"namapoli"=>$kpoli->namapoli,
				"totalantrean"=>$jumlah,
				"jumlahterlayani"=>$terlayani,
				"lastupdate"=>round(microtime(true) * 1000)
			),
			"metadata"=>array(
				"message"=>"Ok",
				"code"=>200
			),
			
			));
			}
			
		}
	}
	function rujukan_habis($end,$norujukan){
		$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/'.$norujukan);
		$data_json=json_decode($response, true);
		$awalrujukan = $data_json['response']['rujukan']['tglKunjungan'];
		$rujukanend = strtotime($end) - strtotime($awalrujukan);
		$hitung = floor($rujukanend/86400)+1;
		return $hitung;
	}
	public function actionHitunghari(){
		$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/0120b1390920p000166');
		$data_json=json_decode($response, true);
		$awalrujukan = $data_json['response']['rujukan']['tglKunjungan'];
		 $day = date('2020-12-08');
		 $rujukan ="0120b1390920p000166";
		// $rujukanend = strtotime($day) - strtotime($awalrujukan);
		// $hitung = floor($rujukanend/86400)+1;
		return $this->rujukan_habis($day,$rujukan).' & '.$awalrujukan;
		
	}
	
	public function actionOnlineDaftar()
	{
		
		$dafon = new Pasienonline();
		$arr = json_decode(file_get_contents("php://input"));
		if (empty($arr)){ 
		exit("Data empty.");
		} else {
		$nomorkartu = $arr->nomorkartu;
		$nik = $arr->nik;
		$notelp = $arr->notelp;
		$tanggalperiksa = $arr->tanggalperiksa;
		$cl = date('Ymd',strtotime($arr->tanggalperiksa));
		$ceklibur = $this->tanggalMerah($cl);
		$kodepoli = $arr->kodepoli;
		$nomorreferensi = $arr->nomorreferensi;
		$jenisreferensi = $arr->jenisreferensi;
		$jenisrequest = $arr->jenisrequest;
		$polieksekutif = $arr->polieksekutif;
		$pc = Pasien::find()->where(['nobpjs'=>$nomorkartu])->count();
		$pasien = Pasien::find()->where(['nobpjs'=>$nomorkartu])->one();
		$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Peserta/nokartu/'.$nomorkartu.'/tglSEP/'.$tanggalperiksa.'');
		$data_json=json_decode($response, true);
	
		//jika nomor kartu kosong A1
		if($nomorkartu == null){
			return (array(
			"metadata"=>array(
				"code"=>201,
				"message"=>"Nomor Kartu Kosong"
			)
			
			));
		}else{

		// Validasi Kepesertaan A2
			if($data_json['metaData']['code'] == "201"){
				return (array(
				"metadata"=>array(
					"code"=>$data_json['metaData']['code'],
					"message"=>$data_json['metaData']['message']
				)
				
				));
			}else{
				if($tanggalperiksa == NULL){
					return (array(
						"metadata"=>array(
						"code"=> 0,
						"message"=>"Tanggal tidak boleh kosong",
						)

						));
					
				}else{
					//Validasi Tanggal tidak boleh kosong A4
					if($nik != $data_json['response']['peserta']['nik']){
						return (array(
						"metadata"=>array(
						"code"=>0,
						"message"=>"NIK TIDAK SESUAI / FORMAT TANGGAL SALAH",
						)

						));
					}else{
						$tglmulai = strtotime($tanggalperiksa);
						$tglakhir = strtotime(date("Y-m-d"));
						if($tglmulai < $tglakhir){
							return (array(
								"metadata"=>array(
								"code"=>0,
								"message"=>"Tanggal tidak boleh mundur",
								)
							));
						}else{
							if($ceklibur == 1){
							return (array(
							"metadata"=>array(
								"code"=>0,
								"message"=>"Hari minggu tidak ada poli",
							)
							
							));
							}
							else if($ceklibur == 2){
								if($this->rujukan_habis($tanggalperiksa,$nomorreferensi) > 90 ){
									return (array(
									"metadata"=>array(
										"code"=>0,
										"message"=>"Masa Berlaku Rujukan Habis",
									)
									
									));
								}else{
								$pso = Pasienonline::find()->where(['nokartu'=>$nomorkartu])->andWhere(['tglberobat'=>$tanggalperiksa])->count();
								$psoc = Pasienonline::find()->where(['nokartu'=>$nomorkartu])->andWhere(['tglberobat'=>$tanggalperiksa])->one();
								if($pso > 0){
									return (array(
									"metadata"=>array(
										"code"=>0,
										"message"=>"Pasien Sudah Mendapatkan Kode Booking ".$psoc->noregistrasi,
									)
									
									));
								}else{
								$hini = date("D",strtotime($tanggalperiksa));
								$poli = Poli::find()->where(['kodepoli'=>$kodepoli])->one();
								$polic = Poli::find()->where(['kodepoli'=>$kodepoli])->count();
								$hrd = Hari::find()->where(['ket'=>$hini])->one(); 
								
								if($polic == 0){
									return (array(
									"metadata"=>array(
										"code"=>0,
										"message"=>"Kode Poli Salah"
									)
									
									));
								}else{
								$jadwal = Jadwaldokter::find()->where(['idpoli'=>$poli->id])->andWhere(['idhari'=>$hrd->id])->count();
								$jadwallibur = Jadwaldokter::find()->where(['idpoli'=>$poli->id])->andWhere(['idhari'=>$hrd->id])->andwhere(['status'=>0])->count();
								if($jadwallibur > 0){
									return (array(
									"metadata"=>array(
										"code"=>0,
										"message"=>"Mohon Maaf Poliklinik Tidak Tersedia Di kerenakan Dokter Berhalangan Hadir"
									)
									
									));
								}else{
								if($jadwal < 1){
									return (array(
									"metadata"=>array(
										"code"=>0,
										"message"=>"Poliklinik Tidak Tersedia"
									)
									
									));
								}else{
								if($jenisreferensi > 2 && $jenisrequest >2 || $jenisreferensi < 1 && $jenisrequest < 1){
									return (array(
									"metadata"=>array(
										"code"=>0,
										"message"=>"Jenis Referensi & Jenis Request Tidak Sesuai"
									)
									
									));
								}else{
								$lahir = date('Y-m-d',strtotime($data_json['response']['peserta']['tglLahir']));
								$sekarang = date('Y-m-d');
								$diff =strtotime($sekarang)-strtotime($lahir); 
								$hari = $diff/86400;
								$tahun = floor($hari / 365);
								$dafon->dilayani = round(microtime(true) * 1000);
								//$dafon->idpoli = $poli;
								
								$dafon->tglberobat = $tanggalperiksa;
								$dafon->idpoli = $poli->id;
								//$dafon->no_rekmed = $data_json['response']['peserta']['mr']['noMR'];
								$dafon->kodepoli = $poli->icon;
								($dafon->antrian)? $dafon->antrian : $dafon->genAntri($dafon->kodepoli);
								$dafon->genKode();
								$dafon->nik = $data_json['response']['peserta']['nik'];
								$dafon->nama = $data_json['response']['peserta']['nama'];
								$dafon->usia = $tahun;
								$dafon->tgllahir = $data_json['response']['peserta']['tglLahir'];
								$dafon->jenis_kelamin = $data_json['response']['peserta']['sex'];
								$dafon->idbayar = 5;
								$dafon->tanggal = date('Y-m-d H:i:s');
								$dafon->dilayani = round(microtime(true) * 1000);
								$dafon->nokartu = $nomorkartu;
								$dafon->nohp = $notelp;
								$dafon->norujukan = $nomorreferensi;
								
								$dafon->jenisantrian = 2;
								$dafon->jenisreferensi = $jenisreferensi;
								$dafon->jenisrequest = $jenisrequest;
								$dafon->polieksekutif = $polieksekutif;
								if($data_json['response']['peserta']['mr']['noMR'] == NULL){
									$dafon->jenispasien = "Baru";
								}else{
									$dafon->jenispasien = "Lama";
								}
								//Jika Save A6
								if($dafon->save(false)){
									return(array(
										"response"=>array(
										"nomorantrean" => $dafon->antrian,
										"kodebooking" => $dafon->noregistrasi,
										"jenisantrean" => $dafon->jenisantrian,
										"estimasidilayani" => $dafon->dilayani,
										"namapoli" => $dafon->polii->namapoli,
										"namadokter" => "",
										),
										"metadata"=>array(				
											"massage"=>"Ok",
											"code"=>200,
										)							
									));
								}else{
									return 'error';
								}
								}
							
								}
								
								}
								
								}
							
								//end A6
								}
						
								}
								
							}
							else{
								return (array(
									"metadata"=>array(
									"code"=>0,
									"message"=>$ceklibur
							)
							
							));
							}
						//end A5
						}
						//Validasi Cek Tanggal Libur Nasional A5
						
					}
				}
					
					//end A4
					
				
				}
			//end A2
		}
		//end A1
		

		}
		
		
		
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
			$cl = date('Ymd',strtotime($arr->tanggalperiksa));
			$ceklibur = $this->tanggalMerah($cl);
			$kodepoli = $arr->kodepoli;
			$nomorreferensi = $arr->nomorreferensi;
			$jenisreferensi = $arr->jenisreferensi;
			$jenisrequest = $arr->jenisrequest;
			$polieksekutif = $arr->polieksekutif;
			$pc = Pasien::find()->where(['nobpjs'=>$nomorkartu])->count();
			$pasien = Pasien::find()->where(['nobpjs'=>$nomorkartu])->one();
			$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/'.$nomorreferensi);
			$data_json=json_decode($response, true);
			if($data_json['response'] == NULL ){
				return (array(
					"metadata"=>array(
					"code"=>0,
					"message"=>'Tidak ditemukan'
					)

					));
			}else{
				if($nomorkartu != $data_json['response']['rujukan']['peserta']['noKartu']){
					return (array(
					"metadata"=>array(
					"code"=>0,
					"message"=>'nomor kartu salah'
					)

					));
				}else{
					if($nik != $data_json['response']['rujukan']['peserta']['nik']){
						return (array(
						"metadata"=>array(
						"code"=>0,
						"message"=>'Nik Salah'
						)

						));	
					}else{
						$tglmulai = strtotime($tanggalperiksa);
						$tglakhir = strtotime(date("Y-m-d"));
						if($tglmulai < $tglakhir){
							return (array(
								"metadata"=>array(
								"code"=>0,
								"message"=>"Tanggal tidak boleh mundur",
								)
							));
						}else{
							$hini = date("D",strtotime($tanggalperiksa));
							$poli = Poli::find()->where(['kodepoli'=>$kodepoli])->one();
							$polic = Poli::find()->where(['kodepoli'=>$kodepoli])->count();
							$hrd = Hari::find()->where(['ket'=>$hini])->one(); 
							$jadwal = Jadwaldokter::find()->where(['idpoli'=>$poli->id])->andWhere(['idhari'=>$hrd->id])->count();
							$jadwallibur = Jadwaldokter::find()->where(['idpoli'=>$poli->id])->andWhere(['idhari'=>$hrd->id])->andwhere(['status'=>0])->count();
							if($jadwallibur < 0){
								return (array(
								"metadata"=>array(
									"code"=>0,
									"message"=>"Mohon Maaf Poliklinik Tidak Tersedia Di kerenakan Dokter Berhalangan Hadir"
								)
								
								));
							}else{
								$pso = Pasienonline::find()->where(['nokartu'=>$nomorkartu])->andWhere(['tglberobat'=>$tanggalperiksa])->count();
								$psoc = Pasienonline::find()->where(['nokartu'=>$nomorkartu])->andWhere(['tglberobat'=>$tanggalperiksa])->one();
								if($pso > 0){
									return (array(
									"metadata"=>array(
										"code"=>0,
										"message"=>"Pasien Sudah Mendapatkan Kode Booking ".$psoc->noregistrasi,
									)
									
									));
								}else{
									
								}
								$tgll = $data_json['response']['rujukan']['peserta']['tglLahir'];
								$lahir = date('Y-m-d',strtotime($tgll));
								$sekarang = date('Y-m-d');
								$diff =strtotime($sekarang)-strtotime($lahir); 
								$hari = $diff/86400;
								$tahun = floor($hari / 365);
								$dafon->dilayani = round(microtime(true) * 1000);
								//$dafon->idpoli = $poli;
								
								$dafon->tglberobat = $tanggalperiksa;
								$dafon->idpoli = $poli->id;
								//$dafon->no_rekmed = $data_json['response']['peserta']['mr']['noMR'];
								$dafon->kodepoli = $poli->icon;
								($dafon->antrian)? $dafon->antrian : $dafon->genAntri($dafon->kodepoli);
								$dafon->genKode();
								$dafon->nik = $data_json['response']['rujukan']['peserta']['nik'];
								$dafon->no_rekmed = $data_json['response']['rujukan']['peserta']['mr']['noMR'];
								$dafon->nama = $data_json['response']['rujukan']['peserta']['nama'];
								$dafon->usia = $tahun;
								$dafon->tgllahir = $lahir;
								$dafon->jenis_kelamin = $data_json['response']['rujukan']['peserta']['sex'];
								$dafon->idbayar = 5;
								$dafon->tanggal = date('Y-m-d H:i:s');
								$dafon->dilayani = round(microtime(true) * 1000);
								$dafon->nokartu = $nomorkartu;
								$dafon->nohp = $notelp;
								$dafon->norujukan = $nomorreferensi;
								
								$dafon->jenisantrian = 2;
								$dafon->jenisreferensi = $jenisreferensi;
								$dafon->jenisrequest = $jenisrequest;
								$dafon->polieksekutif = $polieksekutif;
								if($data_json['response']['rujukan']['peserta']['mr']['noMR'] == NULL){
									$dafon->jenispasien = "Baru";
								}else{
									$dafon->jenispasien = "Lama";
								}
								//Jika Save A6
								if($dafon->save(false)){
									return(array(
										"response"=>array(
										"nomorantrean" => $dafon->antrian,
										"kodebooking" => $dafon->noregistrasi,
										"jenisantrean" => $dafon->jenisantrian,
										"estimasidilayani" => $dafon->dilayani,
										"namapoli" => $dafon->polii->namapoli,
										"namadokter" => "",
										),
										"metadata"=>array(				
											"massage"=>"Ok",
											"code"=>200,
										)							
									));
								}else{
									return (array(
										"metadata"=>array(											
											"message"=>"Error",
											"code"=>0,
										)
								
									));
								}
							}
						}
					}
				}
			}
		}
	}
	public function actionPeserta(){
		$arr = json_decode(file_get_contents("php://input"));
		if (empty($arr)){ 
		exit("Data empty.");
		} else {
		$nokartu = $arr->nokartu;
		$time = $arr->tglberobat;
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$data_json=json_decode($response, true);
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		return $data_json;
		}
		
	}
	
	public function get_content($url, $post = '') {
		
		$data = "29855";
		$secretKey = "3rU307868B";
         // Computes the timestamp
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        // Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		$header[] = 'Content-Type: application/json;charset=utf-8';
		$header[] = "Accept-Encoding: gzip, deflate";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		// curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

		if ($post)
		{
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$rs = curl_exec($ch);
		
		if(empty($rs)){
			//var_dump($rs, curl_error($ch));
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return $rs;
	}

}