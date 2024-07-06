<?php
namespace frontend\controllers;
use Yii;
use common\models\Poli;
use common\models\ApotekStokopname;
use common\models\Pasienonline;
use common\models\Pasien;
use common\models\Obat;
use common\models\Hari;
use common\models\Jadwaldokter;
use common\models\Radiologidetail;
use common\models\Jadwaloprasi;
use common\models\Kelurahan;;
use common\models\JenisDiagnosa;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\CompositeAuth;
use yii\helpers\ArrayHelper;
use common\models\Transaksi;
use common\models\Trandetail;
use common\models\Pengeluaran;
use common\models\Trxmanualdetail;
use common\models\Trxmanual;
use common\models\Trxresep;
use common\models\Trxapotek;
use common\models\Rawatjalan;
use common\models\KategoriPenyakit;
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
         public function actionPenyakitRanap($tahun){
            $penyakit = KategoriPenyakit::find()->all();
		    $arrpe = array();
		    foreach($penyakit as $p){
		        $rawat1 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',0,1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['katpenyakit'=>$p->id])->andwhere(['idjenisrawat'=>2])->count();
		        $rawat4 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',1,4])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['katpenyakit'=>$p->id])->andwhere(['idjenisrawat'=>2])->count();
		        $rawat14 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',5,14])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['katpenyakit'=>$p->id])->andwhere(['idjenisrawat'=>2])->count();
		        $rawat44 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',15,44])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['katpenyakit'=>$p->id])->andwhere(['idjenisrawat'=>2])->count();
		        $rawat75 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',45,75])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['katpenyakit'=>$p->id])->andwhere(['idjenisrawat'=>2])->count();
		   array_push($arrpe,[
			'penyakit' => $p->kategori,
			'rawat1thn' => $rawat1,
			'rawat4thn' => $rawat4,
			'rawat14thn' => $rawat14,
			'rawat44thn' => $rawat44,
			'rawat75thn' => $rawat75,
			]);
		    }
		    return $arrpe;
		    
         }
        public function actionPenyakitRajal($tahun){
            
            $penyakit = JenisDiagnosa::find()->all();
		    $arrpe = array();
		    foreach($penyakit as $p){
		        $rawat1 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',0,1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['jenispenyakit'=>$p->id])->andwhere(['idjenisrawat'=>1])->count();
		        $rawat4 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',1,4])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['jenispenyakit'=>$p->id])->andwhere(['idjenisrawat'=>1])->count();
		        $rawat14 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',5,14])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['jenispenyakit'=>$p->id])->andwhere(['idjenisrawat'=>1])->count();
		        $rawat44 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',15,44])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['jenispenyakit'=>$p->id])->andwhere(['idjenisrawat'=>1])->count();
		        $rawat75 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['between','pasien.usia',45,75])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['jenispenyakit'=>$p->id])->andwhere(['idjenisrawat'=>1])->count();
		      array_push($arrpe,[
			'penyakit' => $p->jenisdiagnosa,
			'rawat1thn' => $rawat1,
			'rawat4thn' => $rawat4,
			'rawat14thn' => $rawat14,
			'rawat44thn' => $rawat44,
			'rawat75thn' => $rawat75,
			]);
		    }
		    return $arrpe;
        }
        public function actionPasienRanap($tahun){
            $model = Rawatjalan::find()->select(['rawatjalan.*','DATE_FORMAT(tglkeluar,"%m") AS bulan'])->andwhere(['DATE_FORMAT(tglkeluar,"%Y")'=>$tahun])->groupBy('bulan')->all();
            	$arrdip=array();
		foreach ($model as $q){
			$laki= Rawatjalan::find()->joinwith(['pasien as pasien'])->where(['DATE_FORMAT(tglkeluar,"%m")'=>date('m',strtotime($q->tglkeluar))])->andwhere(['rawatjalan.idjenisrawat'=>2])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['rawatjalan.idbayar'=>5])->andwhere(['pasien.jenis_kelamin'=>'L'])->count();
			$perempuan= Rawatjalan::find()->joinwith(['pasien as pasien'])->where(['DATE_FORMAT(tglkeluar,"%m")'=>date('m',strtotime($q->tglkeluar))])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['rawatjalan.idjenisrawat'=>2])->andwhere(['rawatjalan.idbayar'=>5])->andwhere(['pasien.jenis_kelamin'=>'P'])->count();
			array_push($arrdip,[
			'bulan' => date('F',strtotime($q->tglkeluar)),
			'laki' => $laki,
			'perempuan' => $perempuan,
			]);
		}
		return $arrdip;
        }
        public function actionPasienRajal($tahun){
            $model = Rawatjalan::find()->select(['rawatjalan.*','DATE_FORMAT(tgldaftar,"%m") AS bulan'])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->groupBy('bulan')->all();
            	$arrdip=array();
		foreach ($model as $q){
			$laki= Rawatjalan::find()->joinwith(['pasien as pasien'])->where(['DATE_FORMAT(tgldaftar,"%m")'=>date('m',strtotime($q->tgldaftar))])->andwhere(['<>','rawatjalan.idjenisrawat',2])->andwhere(['rawatjalan.batal'=>NULL])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['rawatjalan.idbayar'=>5])->andwhere(['pasien.jenis_kelamin'=>'L'])->count();
			$perempuan= Rawatjalan::find()->joinwith(['pasien as pasien'])->where(['DATE_FORMAT(tgldaftar,"%m")'=>date('m',strtotime($q->tgldaftar))])->andwhere(['DATE_FORMAT(tgldaftar,"%Y")'=>$tahun])->andwhere(['<>','rawatjalan.idjenisrawat',2])->andwhere(['rawatjalan.batal'=>NULL])->andwhere(['pasien.jenis_kelamin'=>'P'])->count();
			array_push($arrdip,[
			'bulan' => date('F',strtotime($q->tgldaftar)),
			'laki' => $laki,
			'perempuan' => $perempuan,
			]);
		}
		return $arrdip;
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
			'kode' => $q['kode'].'-'.$q['nama'],
			
			]);
		}
		return $arrdip;
	
				
	  
    }
    	public function actionListprosedur($q){		
       // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	 	$response = $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/referensi/procedure/'.$q.'');
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['response'];
		$dd= $diagnosa['procedure'];
		$arrdip=array();
		foreach ($dd as $q){
			array_push($arrdip,[
			'id' => $q['nama'],
			'nama' => $q['nama'],
			
			]);
		}
		return $arrdip;
	
				
	  
    }
		public function actionMasukKeluar($tahun=''){
		$stkopnm = ApotekStokopname::find()->select(['apotek_stokopname.*','DATE_FORMAT(tanggal,"%m") AS bulan'])->where(['DATE_FORMAT(tanggal,"%Y")'=>$tahun])->groupBy('bulan')->all();
		$arrdip=array();
		foreach ($stkopnm as $q){
			$masuk= ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($q->tanggal))])->sum('stokmasuk');
			$keluar= ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($q->tanggal))])->sum('stokkeluar');
			array_push($arrdip,[
			'bulan' => date('F',strtotime($q->tanggal)),
			'masuk' => $masuk,
			'keluar' => $keluar,
			]);
		}
		return $arrdip;
	}
	
public function actionStok($bulan='',$bayar='',$tahun=''){
    	$obat = ApotekStokopname::find()->joinwith(['obat as obat'])->Where(['obat.idjenisobat'=>$bayar])->andwhere(['MONTH(tanggal)'=>$bulan])->andwhere(['YEAR(tanggal)'=>$tahun])->groupBy(['idobat'])->orderBy(['obat.namaobat'=>SORT_ASC])->all();
		$arrdip=array();
		foreach ($obat as $q){
		    $obat = Obat::findOne($q->idobat);
		    if($obat){
		        $stokawal= ApotekStokopname::find()->where(['idobat'=>$q->idobat])->andWhere(['statusstok'=>1])->andwhere(['MONTH(tanggal)'=>$bulan])->andwhere(['YEAR(tanggal)'=>$tahun])->one();			
    			$stokakhirc= ApotekStokopname::find()->where(['idobat'=>$q->idobat])->andWhere(['statusstok'=>2])->andwhere(['MONTH(tanggal)'=>$bulan])->andwhere(['YEAR(tanggal)'=>$tahun])->count();
    			if($stokakhirc < 1){
    				$stokakhir= ApotekStokopname::find()->where(['idobat'=>$q->idobat])->andWhere(['statusstok'=>1])->andwhere(['MONTH(tanggal)'=>$bulan])->andwhere(['YEAR(tanggal)'=>$tahun])->one();
    			}else{
    				$stokakhir= ApotekStokopname::find()->where(['idobat'=>$q->idobat])->andWhere(['statusstok'=>2])->andwhere(['MONTH(tanggal)'=>$bulan])->andwhere(['YEAR(tanggal)'=>$tahun])->one();
    			}
    			$masuk= ApotekStokopname::find()->where(['idobat'=>$q->idobat])->andwhere(['MONTH(tanggal)'=>$bulan])->andwhere(['YEAR(tanggal)'=>$tahun])->sum('stokmasuk');
    			$keluar= ApotekStokopname::find()->where(['idobat'=>$q->idobat])->andwhere(['MONTH(tanggal)'=>$bulan])->andwhere(['YEAR(tanggal)'=>$tahun])->sum('stokkeluar');
    		    if($stokawal){
    		        $awalstok = $stokawal->stokawal;
    		    }else{
    		        $awalstok = 0;
    		    }
    			array_push($arrdip,[
    			'id' => $q->idobat,
    			'namaobat' => $q->obat->namaobat,
    			'harga' => $q->obat->harga,
    			'jenis' => $q->obat->jenis->jenisbayar,
    			'masuk' => $masuk,
    			'keluar' => $keluar,		
    			'awal' => $awalstok,
    			'akhir' => $stokakhir->stokakhir,
    			
    			]);
		    }
			
			
		}
		return $arrdip;
		
	}
	public function actionKasirYanmasDay(){
		$total = 0;
		$totalbpjs = 0;
		$total = 0;
		$totalbpjs = 0;
		$totalrji = 0;
		$totaligdi = 0;
		$totalrii = 0;
		
		$totalbrji = 0;
		$totalbigdi = 0;
		$totalbrii = 0;
		$day =	date('m',strtotime('+6 hour',strtotime(date('Y-m-d  H:i:s'))));
		$year =	date('Y',strtotime('+6 hour',strtotime(date('Y-m-d  H:i:s'))));
		$jmltrxyanmas = Transaksi::find()->where(['MONTH(tglbayar)'=>$day])->andWhere(['YEAR(tglbayar)'=>$year])->andwhere(['idbayar'=>4])->count();	
		$jmltrxbpjs = Transaksi::find()->where(['MONTH(tglbayar)'=>$day])->andWhere(['YEAR(tglbayar)'=>$year])->andwhere(['idbayar'=>5])->count();	
		$trxyanmas = Trandetail::find()->joinWith(['transaksi as trx'])->where(['trx.idbayar'=>4])->andwhere(['trx.tglbayar'=>$day])->andwhere(['trx.status'=>1])->all();
		$trxbpjs = Trandetail::find()->joinWith(['transaksi as trx'])->where(['trx.idbayar'=>5])->andwhere(['trx.tglbayar'=>$day])->andwhere(['trx.status'=>1])->all();
		$rajalumumi = Transaksi::find()->where(['MONTH(tglbayar)'=>$day])->andWhere(['YEAR(tglbayar)'=>$year])->andwhere(['idjenisrawat'=>1])->andwhere(['idbayar'=>4])->all();	
		$igdumumi = Transaksi::find()->where(['MONTH(tglbayar)'=> $day])->andWhere(['YEAR(tglbayar)'=>$year])->andwhere(['idjenisrawat'=>3])->andwhere(['idbayar'=>4])->all();	
		$ranapumumi = Transaksi::find()->where(['MONTH(tglbayar)'=>$day])->andWhere(['YEAR(tglbayar)'=>$year])->andwhere(['idjenisrawat'=>2])->andwhere(['idbayar'=>4])->all();	
	    
	    $rajalbpjsi = Transaksi::find()->where(['MONTH(tglbayar)'=>$day])->andWhere(['YEAR(tglbayar)'=>$year])->andwhere(['idjenisrawat'=>1])->andwhere(['idbayar'=>5])->all();	
		$igdbpjsi = Transaksi::find()->where(['MONTH(tglbayar)'=> $day])->andWhere(['YEAR(tglbayar)'=>$year])->andwhere(['idjenisrawat'=>3])->andwhere(['idbayar'=>5])->all();	
		$ranapbpjsi = Transaksi::find()->where(['MONTH(tglbayar)'=>$day])->andWhere(['YEAR(tglbayar)'=>$year])->andwhere(['idjenisrawat'=>2])->andwhere(['idbayar'=>5])->all();	
		
		foreach ($igdumumi as $igdi){
			$totaligdi += $igdi->total;
		}
		foreach ($ranapumumi as $rii){
			$totalrii += $rii->total;
		}
		foreach ($rajalumumi as $rji){
			$totalrji += $rji->total;
		}
		
		foreach ($igdbpjsi as $igdbpjsi){
			$totalbigdi += $igdbpjsi->total;
		}
		foreach ($ranapbpjsi as $ranapbpjsi){
			$totalbrii += $ranapbpjsi->total;
		}
		foreach ($rajalbpjsi as $rajalbpjsi){
			$totalbrji += $rajalbpjsi->total;
		}
		 $totalall = $totaligdi + $totalrii + $totalrji;
	    $totalball = $totalbigdi + $totalbrii + $totalbrji;
		$arrdip=array();
		return[
			'response'=>array(
				'day'=>$day,
				'kasirYanmas'=>array(
					'trx'=>$jmltrxyanmas,					
					'income'=>$totalall,					
				),	
				'kasirBpjs'=>array(
					'trx'=>$jmltrxbpjs,		
					'income'=>$totalball,		
				),	
			),		
				
			"metadata"=>array(
				"message"=>"Ok",
				"code"=>200
			),
			
			];
		
	}
	public function actionKasirYanmasM($awal,$akhir){
		$total = 0;
		$totalbpjs = 0;
		$totalrji = 0;
		$totaligdi = 0;
		$totalrii = 0;
		$totalbrji = 0;
		$totalresepy = 0;
		$totalresepb = 0;
		$totalbigdi = 0;
		$totalbrii = 0;
		$day =	date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d  H:i:s'))));
		$jmltrxyanmas = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idbayar'=>4])->count();	
		$jmltrxbpjs = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idbayar'=>5])->count();			
		$trxresepy = Trxapotek::find()->where(['idbayar'=>4])->andwhere(['between', 'tgl', $awal,$akhir])->andwhere(['status'=>1])->all();
		$trxresepb = Trxapotek::find()->where(['idbayar'=>5])->andwhere(['between', 'tgl', $awal,$akhir])->andwhere(['status'=>1])->all();
		
		$trxyanmas = Trandetail::find()->joinWith(['transaksi as trx'])->where(['trx.idbayar'=>4])->andwhere(['between', 'trx.tglbayar', $awal,$akhir])->andwhere(['trx.status'=>1])->all();
		$trxbpjs = Trandetail::find()->joinWith(['transaksi as trx'])->where(['trx.idbayar'=>5])->andwhere(['between', 'trx.tglbayar', $awal,$akhir])->andwhere(['trx.status'=>1])->all();
		$rajalbpjs = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>1])->andwhere(['idbayar'=>5])->count();	
		$igdbpjs = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>3])->andwhere(['idbayar'=>5])->count();	
		$ranapbpjs = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>2])->andwhere(['idbayar'=>5])->count();	
		
		$rajalumum = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>1])->andwhere(['idbayar'=>4])->count();	
		$igdumum = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>3])->andwhere(['idbayar'=>4])->count();	
		$ranapumum = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>2])->andwhere(['idbayar'=>4])->count();	
		
		$rajalumumi = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>1])->andwhere(['idbayar'=>4])->all();	
		$igdumumi = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>3])->andwhere(['idbayar'=>4])->all();	
		$ranapumumi = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>2])->andwhere(['idbayar'=>4])->all();	
	    
	    $rajalbpjsi = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>1])->andwhere(['idbayar'=>5])->all();	
		$igdbpjsi = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>3])->andwhere(['idbayar'=>5])->all();	
		$ranapbpjsi = Transaksi::find()->where(['between', 'tglbayar', $awal,$akhir])->andwhere(['idjenisrawat'=>2])->andwhere(['idbayar'=>5])->all();	
		
		foreach ($igdumumi as $igdi){
			$totaligdi += $igdi->total;
		}
		foreach ($ranapumumi as $rii){
			$totalrii += $rii->total;
		}
		foreach ($rajalumumi as $rji){
			$totalrji += $rji->total;
		}
		
	
		foreach ($igdbpjsi as $igdbpjsi){
			$totalbigdi += $igdbpjsi->total;
		}
		foreach ($ranapbpjsi as $ranapbpjsi){
			$totalbrii += $ranapbpjsi->total;
		}
		foreach ($rajalbpjsi as $rajalbpjsi){
			$totalbrji += $rajalbpjsi->total;
		}
		foreach ($trxresepy as $tri){
			$totalresepy += $tri->total;
		}
		foreach ($trxresepb as $trbi){
			$totalresepb += $trbi->total;
		}
	    $totalball = $totalbigdi + $totalbrii + $totalbrji;
		$total = $totaligdi + $totalrii + $totalrji;
		$arrdip=array();
		return[
			'response'=>array(
				'day'=>$day,
				'kasirYanmas'=>array(
					'igd'=>$igdumum,					
					'rajal'=>$rajalumum,					
					'rajalincome'=>$totalrji,					
					'ugdincome'=>$totaligdi,					
					'ranapincome'=>$totalrii,					
					'ranap'=>$ranapumum,					
					'trx'=>$jmltrxyanmas,					
					'income'=>$total,
					'incomresep'=>$totalresepy,					
				),	
				'kasirBpjs'=>array(
					'igd'=>$igdbpjs,					
					'rajal'=>$rajalbpjs,					
					'ranap'=>$ranapbpjs,
					'rajalincome'=>$totalbrji,					
					'ugdincome'=>$totalbigdi,					
					'ranapincome'=>$totalbrii,	
					'trx'=>$jmltrxbpjs,		
					'income'=>$totalball,	
					'incomresep'=>$totalresepb,					
				),	
			),		
				
			"metadata"=>array(
				"message"=>"Ok",
				"code"=>200
			),
			
			];
		
	}
	public function actionApotekDay2(){
		$total = 0;
		$arrdip=array();
		$resep = Trxresep::find()->joinWith(['trx as trx'])->where(['between', 'DATE_FORMAT(trx.tglresep,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->andwhere(['trx.idbayar'=>4])->all();
		$resepc = Trxapotek::find()->where(['between', 'DATE_FORMAT(tglresep,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->andwhere(['idbayar'=>4])->count();
		foreach ($resep as $rp){
				$total += $rp->total;
				
			}
		return[
			'response'=>array(
				'ApotekYanmas'=>array(
					'total'=>$total, 
					'total_trx'=>$resepc,
				),),
		];
		
		
	}
	public function actionAlamatId($q){
		$query = Kelurahan::find()->where(['id_kel'=>$q])->one();
    		return[
    			'response'=>array(
    			     'id' => $query->id_kel,
        			'IdKel' => $query->id_kel,			
        			'nama' => $query->nama,			
        			'Kec' => $query->kecamatan->nama,
        			'IdKec' => $query->kecamatan->id_kec,
        			'Kab' => $query->kecamatan->kabupaten->nama,
        			'IdKab' => $query->kecamatan->kabupaten->id_kab,
        			'Prov' => $query->kecamatan->kabupaten->provinsi->nama,
        			'IdProv' => $query->kecamatan->kabupaten->provinsi->id_prov,
    			),
    		];
	}
	public function actionKasirYanmasDay3(){
		
		$arrdip=array();
		$total = 0;
		$totalrs = 0;
		$tp = 0;
		$totalmanual = 0;
		$day = date('Y-m-d');
			$pengluaran = Pengeluaran::find()->where(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->andwhere(['status'=>1])->all();
			$pengluaranc = Pengeluaran::find()->where(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->andwhere(['status'=>1])->count();
			$trandetail = Trandetail::find()->joinWith(['transaksi as trx'])->where(['trx.idbayar'=>4])->andwhere(['trx.tglbayar'=>$day])->andwhere(['trx.status'=>1])->all();
			$tranmanual = Trxmanualdetail::find()->joinWith(['transaksi as trx'])->where(['trx.status'=>1])->andwhere(['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->all();
			$trx = Transaksi::find()->where(['tglbayar'=>$day])->count();
			$trxman = Trxmanual::find()->where(['between', 'DATE_FORMAT(tgl,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->count();
			$resep = Trxresep::find()->joinWith(['trx as trx'])->where(['between', 'DATE_FORMAT(trx.tglresep,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->andwhere(['trx.idbayar'=>4])->all();
			$resepc = Trxapotek::find()->where(['between', 'DATE_FORMAT(tglresep,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->andwhere(['idbayar'=>4])->count();
			foreach ($resep as $rp){
					$totalrs += $rp->total;
					
				}
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
				'apotekYanmas'=>array(
					'total'=>$totalrs,
					'total_tp'=>$resepc,
				),
				
				),
				"metadata"=>array(
					"message"=>"Ok",
					"code"=>200
				),
			];
		
		
	}
    public function actionListObatBpjs($q){
		$obat = Obat::find()->where(['idjenisobat'=>5])->andFilterWhere(['like', 'namaobat', $q])->all();
		$arrdip=array();
		foreach ($obat as $p){
			array_push($arrdip,[
			'id' => $p->id,
			'nama' => $p->namaobat,
			'jenisobat' => $p->idjenisobat,
			'satuan' => $p->satuan->satuan,
			'stok' => $p->stok,
			
			]);
		}
		return $arrdip;
	}
	public function actionListObatUmum($q){
		$obat = Obat::find()->where(['idjenisobat'=>4])->andFilterWhere(['like', 'namaobat', $q])->all();
		$arrdip=array();
		foreach ($obat as $p){
			array_push($arrdip,[
			'id' => $p->id,
			'nama' => $p->namaobat,
			'jenisobat' => $p->idjenisobat,
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
			'kode' => $p['kode'],
			'nama' => $p['nama'],
			
			]);
		}
		return $arrdip;
	
				
	  
    }
    	public function actionListPoliKode($q){		
       // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	 	$response = $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/referensi/poli/'.$q);
		$data_json = json_decode($response, true);
		$poli = $data_json['response'];
		$pp= $poli['poli'];
		$arrdip=array();
		foreach ($pp as $p){
			array_push($arrdip,[
			'id' => $p['kode'],
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