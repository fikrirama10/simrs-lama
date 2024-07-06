<?php

namespace backend\controllers;

use Yii;
use common\models\Pasien;
use common\models\Rawatjalan;
use common\models\Lograwat;
use common\models\Kunjungan;
use common\models\KuotaPasien;
use common\models\Jadwaldokter;
use common\models\Rekamedis;
use yii\base\Model;
use kartik\mpdf\Pdf;
use common\models\PasienSearch;
use common\models\Pekerjaan;
use common\models\Kabupaten;
use common\models\Kecamatan;
use common\models\Dokter;
use common\models\Kamar;
use common\models\Rawatan;
use common\models\Kelurahan;
use common\models\PekerjaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PasienController implements the CRUD actions for Pasisen model.
 */
class PasienController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pasisen models.
     * @return mixed
     */
	public function get_content($url, $post = '') {
		
		// $data = "29250";
		// $secretKey = "5lQ5E30F4C";
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
	
    public function actionIndex()
    {
        $searchModel = new PasienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		//$dataProvider->sort->sortParam = true;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionPass($start='', $end='',$cek='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			// else if($cek == 'custom'){ $title = 'Periode'; }
			else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', $start, $end];
			//$andWhere = ['IdStat'=>4];
		}else{
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['jenis_kelamin'=>'L'];
			$title = 'Hari Ini';
		}
		$pasien = Pasien::find()->where($where)->all();
		$laki = Pasien::find()->where($where)->andWhere(['jenis_kelamin'=>'L'])->count();
		$perempuan = Pasien::find()->where($where)->andWhere(['jenis_kelamin'=>'P'])->count();
		$balita = Pasien::find()->where($where)->andwhere(['between','usia',1,5])->count();
		$anak = Pasien::find()->where($where)->andwhere(['between','usia',5,16])->count();
		$dewasa = Pasien::find()->where($where)->andwhere(['between','usia',17,40])->count();
		$lansia = Pasien::find()->where($where)->andwhere(['between','usia',41,100])->count();
        $searchModel = new PasienSearch();
        $hitungrj = Rawatjalan::find()
       ->select(['rawatjalan.*', 'COUNT(kdiagnosa) AS hitung'])
	   ->groupBy('kdiagnosa')
       ->orderBy(['hitung' => SORT_DESC])
       ->limit(10);
		$datadiag = $hitungrj->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
		
        return $this->render('pass', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'title'=>$title,
			'perempuan'=>$perempuan,
			'pasien'=>$pasien,
			'laki'=>$laki,
			'anak'=>$anak,
			'lansia'=>$lansia,
			'dewasa'=>$dewasa,
			'balita'=>$balita,
			
        ]);
    }
	 public function actionGetSearch($start='', $end='',$cek='',$search='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			else if($cek == 'custom'){ $title = 'Periode'; }
			
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', $start, $end];
			$where2 = ['between', 'DATE_FORMAT(t_berobat,"%Y-%m-%d")', $start, $end];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$where2 = ['between', 'DATE_FORMAT(t_berobat,"%Y-%m-%d")', $start, $end];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}
		$pasien = Pasien::find()->where($where)->all();
		$laki = Pasien::find()->where($where)->andWhere(['jenis_kelamin'=>'L'])->count();
		$perempuan = Pasien::find()->where($where)->andWhere(['jenis_kelamin'=>'P'])->count();
		$balita = Pasien::find()->where($where)->andwhere(['between','usia',1,5])->count();
		$anak = Pasien::find()->where($where)->andwhere(['between','usia',6,16])->count();
		$dewasa = Pasien::find()->where($where)->andwhere(['between','usia',17,40])->count();
		$lansia = Pasien::find()->where($where)->andwhere(['between','usia',41,200])->count();
		$au = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->count();
		$ad = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->count();
		$al = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->count();
		$pns = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>2])->count();
		$umum = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->count();
		$bpjs = Rawatjalan::find()->joinWith(['carabayar as cb'])->where($andWhere)->andWhere(['cb.ket'=>'BPJS'])->count();
		$pu = Rawatjalan::find()->joinWith(['carabayar as cb'])->where($andWhere)->andWhere(['cb.ket'=>'UMUM'])->count();
		$baru = Pasien::find()->where($where2)->andwhere(['stpasien'=>'Baru'])->count();
		$lama = Pasien::find()->where($where2)->andwhere(['stpasien'=>'Old'])->count();
        $searchModel = new PasienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'perempuan'=>$perempuan,
			'pasien'=>$pasien,
			'laki'=>$laki,
			'anak'=>$anak,
			'lansia'=>$lansia,
			'dewasa'=>$dewasa,
			'title'=>$title,
			'balita'=>$balita,
			'au'=>$au,
			'ad'=>$ad,
			'al'=>$al,
			'pns'=>$pns,
			'umum'=>$umum,
			'bpjs'=>$bpjs,
			'pu'=>$pu,
			'baru'=>$baru,
			'lama'=>$lama,

        ]);
    }
	public function actionPeserta(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$time = date('Y-m-d');
		$nokartu ='0002753924714';
		$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$data_json=json_decode($response, true);
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		return $data_json;
	}

    /**
     * Displays a single Pasisen model.
     * @param integer $id
     * @return mixed
     */
   public function actionView($id)
    {	
		$rawatjalan = new Rawatjalan();
		$lograwat = new Lograwat();
		$kunjungan = new Kunjungan();
		$kuotadaftar = new KuotaPasien();
		$rm = new Rekamedis();
		$model = $this->findModel($id);
		$cekpa = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		$hrj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
	   
		if ($rawatjalan->load(Yii::$app->request->post()) 
			&& $lograwat->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$rawatjalan])) {
			$cari = Rawatjalan::find()->where(['no_rekmed'=>$rawatjalan->no_rekmed])->andwhere(['idpoli'=>$rawatjalan->idpoli])->andWhere(['tgldaftar'=>$rawatjalan->tgldaftar])->count();
			if($cari > 1){
				\Yii::$app->getSession()->setFlash('danger', 'Hanya Satu kali kunjungan dalam hari yang sama');
				return $this->refresh();
			}
			$tgldaftar = date('N',strtotime($rawatjalan->tgldaftar));
			$jadwal = Jadwaldokter::find()->where(['idhari'=>$tgldaftar])->andwhere(['iddokter'=>$rawatjalan->iddokter])->count();
			if($jadwal > 0){
				$kuota = KuotaPasien::find()->where(['idhari'])->where(['idhari'=>$tgldaftar])->andwhere(['iddokter'=>$rawatjalan->iddokter])->andwhere(['tgl'=>$rawatjalan->tgldaftar])->count();
				if($kuota > 0){
					$kp = KuotaPasien::find()->where(['idhari'])->where(['idhari'=>$tgldaftar])->andwhere(['iddokter'=>$rawatjalan->iddokter])->andwhere(['tgl'=>$rawatjalan->tgldaftar])->one();
					if($kp->sisa > 0){
						if($rawatjalan->anggota == 1){
							$anggota = Rawatjalan::find()->where(['anggota'=>1])->andwhere(['iddokter'=>$rawatjalan->iddokter])->andwhere(['tgldaftar'=>$rawatjalan->tgldaftar])->count();
							if($anggota > 10){
								\Yii::$app->getSession()->setFlash('warning', 'Kuota Anggota Penuh di tanggal ini silahkan pilih tgl lain');
								return $this->refresh();
							}else{
								$kp->sisa = $kp->sisa - 1;
								$kp->save();
							}
						}else{
							$kumum = $kp->sisa;
							if($kumum > 0){
								$kp->sisa = $kp->sisa - 1;
								$kp->save();
							}else{
								\Yii::$app->getSession()->setFlash('warning', 'Kuota Pccccccenuh di tanggal ini silahkan pilih tgl lain');
								return $this->refresh();
							}
						}
						
					}else{
						\Yii::$app->getSession()->setFlash('warning', 'Kuota Penuh di tanggal ini silahkan pilih tgl lain');
						return $this->refresh();
					}
				}else{
					$jadwal2 = Jadwaldokter::find()->where(['idhari'=>$tgldaftar])->andwhere(['iddokter'=>$rawatjalan->iddokter])->one();
					$kuotadaftar->tgl = $rawatjalan->tgldaftar;
					$kuotadaftar->idhari = $tgldaftar;
					$kuotadaftar->kuota = $jadwal2->kuota;
					$kuotadaftar->sisa = $jadwal2->kuota - 1;
					$kuotadaftar->idpoli = $jadwal2->idpoli;
					$kuotadaftar->iddokter = $jadwal2->iddokter;
					$kuotadaftar->save(false);
					
				}
			}else{
				\Yii::$app->getSession()->setFlash('danger', 'Tidak ada Jadwal Dokter di tgl yang dipilih');
				return $this->refresh();
			}
			$tkunjungan = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			if($tkunjungan == null ){
			$rawatjalan->kunjungan = 1;
			}else{
			$rawatjalan->kunjungan = $tkunjungan + 1 ;
			}
			$rawatjalan->genKode();
			$rawatjalan->idpekerjaan = $model->idpekerjaan;
			$rawatjalan->idverifed = Yii::$app->user->identity->id ;
			if($rawatjalan->tgldaftar == null){
				$rawatjalan->tgldaftar = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			}else{
				$rawatjalan->tgldaftar = $rawatjalan->tgldaftar;
			}		
			$daftar = date('Ymd',strtotime($rawatjalan->tgldaftar));
			($rawatjalan->antrian)? $rawatjalan->antrian : $rawatjalan->genAntri($rawatjalan->idpoli,$rawatjalan->iddokter,$rawatjalan->anggota,$daftar);
			$rawatjalan->status = 1 ;
			$rawatjalan->klpcm = 1 ;
			$rawatjalan->idjenisrawat = 1 ;
			$rawatjalan->usia = $model->usia ;
			$rm->no_rekmed = $model->no_rekmed;
			$rm->idrawat = $rawatjalan->idrawat;
			$model->rmedis = 1;
			$rm->peminjam = $rawatjalan->polii->namapoli;
			$rm->bulan =date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('m'))));
			$rm->tglpinjam = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$lograwat->idrawat = $rawatjalan->idrawat;
			$lograwat->jenis = $rawatjalan->polii->namapoli;
			$kunjungan->no_rekmed = $model->no_rekmed;
			$kunjungan->idrawat = $rawatjalan->idrawat;
			$kunjungan->idpekerjaan = $model->idpekerjaan;
			$kunjungan->sebagai = $model->subid;
			$kunjungan->created_at = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			$sekarang = date('Y-m-d');
			$diff =strtotime($sekarang)-strtotime($model->tanggal_lahir); 
			$hari = $diff/86400;
			$tahun = floor($hari / 365);
			
			if($hrj <= 2){
				$model->stpasien = 'Baru';
			}else if($hrj > 2){
				$model->stpasien = 'Old';
			}
			$lograwat->waktu = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->stat = 1 ;
			$model->t_berobat = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->usia = $tahun;
			if($cekpa > 0){
				$kunjungan->save(false); 
			}else{"";}
			if($rawatjalan->save(false)){
				
				$lograwat->save(false);
				$model->save(false);
				$rm->save(false);
				    return $this->redirect(['pasien/sbb/'.$model->id]);
			
			}
			else
			{	
				return $this->render('view3', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('view3', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),
			  
			]);
		
		}
	
        return $this->render('view3', [
            'model' => $this->findModel($id),
            'rawatjalan' => $rawatjalan,
			'lograwat'=>$lograwat,
        ]);
    }
    public function actionLihatCuy($id)
    {
        $model = $this->findModel($id);
        return $this->render('lihat-cuy',[
            'model'=>$model,
            ]);
    }
	
	 public function actionLihat($id)
    {	
		$rawatjalan = new Rawatjalan();
		$lograwat = new Lograwat();
		$kunjungan = new Kunjungan();
		$rm = new Rekamedis();
		$model = $this->findModel($id);
		$cekpa = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		$hrj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		
		if ($rawatjalan->load(Yii::$app->request->post()) 
			&& $lograwat->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$rawatjalan])) {
			$tkunjungan = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			if($tkunjungan < 1){
			$rawatjalan->kunjungan = 1;
			}else{
			$rawatjalan->kunjungan = $tkunjungan + 1 ;
			}
			$rawatjalan->genKode();
			$rawatjalan->idpekerjaan = $model->idpekerjaan;
			$rawatjalan->idverifed = Yii::$app->user->identity->id ;
			$rawatjalan->tgldaftar = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			($rawatjalan->antrian)? $rawatjalan->antrian : $rawatjalan->genAntri($rawatjalan->idpoli);
			$rawatjalan->status = 1 ;
			$rawatjalan->klpcm = 1 ;
			$rawatjalan->idjenisrawat = 1 ;
			$rawatjalan->usia = $model->usia ;
			$rawatjalan->idkb = 1;
			$rm->no_rekmed = $model->no_rekmed;
			$rm->idrawat = $rawatjalan->idrawat;
			$model->rmedis = 1;
			$rm->peminjam = $rawatjalan->polii->namapoli;
			$rm->bulan =date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('m'))));
			$rm->tglpinjam = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$lograwat->idrawat = $rawatjalan->idrawat;
			$lograwat->jenis = $rawatjalan->polii->namapoli;
			$kunjungan->no_rekmed = $model->no_rekmed;
			$kunjungan->idrawat = $rawatjalan->idrawat;
			$kunjungan->idpekerjaan = $model->idpekerjaan;
			$kunjungan->sebagai = $model->subid;
			$kunjungan->created_at = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			if($hrj <= 2){
				$model->stpasien = 'Baru';
			}else if($hrj > 2){
				$model->stpasien = 'Old';
			}
			$lograwat->waktu = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->stat = 1 ;
			$model->t_berobat = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			if($cekpa > 0){
				$kunjungan->save(false); 
			}else{"";}
			if($rawatjalan->save(false)){
				
				$lograwat->save(false);
				$model->save();
				$rm->save(false);
				  return $this->redirect(['rawatjalan/previewpasien/'.$rawatjalan->id]);
			}
			else
			{	
				return $this->render('view3', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('view2', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('view2', [
            'model' => $this->findModel($id),
            'rawatjalan' => $rawatjalan,
			'lograwat'=>$lograwat,
        ]);
    }
	 
	public function actionDetailigd()
    {
		
        return $this->render('detailigd');
    }
	public function actionDetailpoli()
    {
		
        return $this->render('detailpoli');
    }
	 public function actionDetail()
    {
		$model = Pasien::find()->all();
        return $this->render('detail', [
            'model' => $model,
        ]);
    }
	public function actionSbb($id){
		
		$model = $this->findModel($id);
		$kec = Kelurahan::find()->where(['id_kel'=>$model->idkel])->one();
		$kab = Kecamatan::find()->where(['id_kec'=>$kec->id_kec])->one();
		$prov = Kabupaten::find()->where(['id_kab'=>$kab->id_kab])->one();
		$model->idkec = $kec->id_kec;
		$model->idkab = $kab->id_kab;
		$model->idprov = $prov->id_prov;
			if($model->usia < 1 ){
				$model->sbb = 'By';
			}else if($model->usia > 0 && $model->usia < 17){
				$model->sbb = 'An';
			}else if($model->usia > 17 ){
				if($model->jenis_kelamin == 'L'){
					$model->sbb = 'Tn';
				}else if($model->jenis_kelamin == 'P'){
					if($model->id_status == 2){
						$model->sbb = 'Nn';
					}else{
						$model->sbb = 'Ny';
					}
				}
			}
			$model->save(false);
			return $this->redirect(['view', 'id' => $model->id]);
			
			
	}
		public function actionKontrol($id)
    {
		$rawatjalan = new Rawatjalan();
		$lograwat = new Lograwat();
		$kunjungan = new Kunjungan();
		$rm = new Rekamedis();
		$model = $this->findModel($id);
		$cekpa = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		$hrj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		
		if ($rawatjalan->load(Yii::$app->request->post()) 
			&& $lograwat->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$rawatjalan])) {
			$tkunjungan = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			if($tkunjungan < 1){
			$rawatjalan->kunjungan = 1;
			}else{
			$rawatjalan->kunjungan = $tkunjungan + 1 ;
			}
			$rawatjalan->genKode();
			$rawatjalan->idpekerjaan = $model->idpekerjaan;
			$rawatjalan->idverifed = Yii::$app->user->identity->id ;
			//$rawatjalan->tgldaftar = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			($rawatjalan->antrian)? $rawatjalan->antrian : $rawatjalan->genAntri($rawatjalan->idpoli);
			$rawatjalan->status = 1 ;
			$rawatjalan->idkb = 2;
			$rawatjalan->klpcm = 1;
			$rawatjalan->idjenisrawat = 1 ;
			$rm->no_rekmed = $model->no_rekmed;
			$rm->idrawat = $rawatjalan->idrawat;
			$rm->peminjam = $rawatjalan->polii->namapoli;
			$model->rmedis = 3;
			$rm->bulan =date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('m'))));
			$rm->tglpinjam = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$rawatjalan->usia = $model->usia ;
			$lograwat->idrawat = $rawatjalan->idrawat;
			$lograwat->jenis = $rawatjalan->polii->namapoli;
			$kunjungan->no_rekmed = $model->no_rekmed;
			$kunjungan->idrawat = $rawatjalan->idrawat;
			$kunjungan->idpekerjaan = $model->idpekerjaan;
			$kunjungan->sebagai = $model->subid;
			$kunjungan->created_at = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			$sekarang = date('Y-m-d');
			$diff =strtotime($sekarang)-strtotime($model->tanggal_lahir); 
			$hari = $diff/86400;
			$tahun = floor($hari / 365);
			
			if($hrj <= 2){
				$model->stpasien = 'Baru';
			}else if($hrj >= 3){
				$model->stpasien = 'Old';
			}
			$lograwat->waktu = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->stat = 1 ;
			$model->usia = $tahun;
			if($cekpa > 0){
				$kunjungan->save(false); 
			}else{"";}
			if($rawatjalan->save(false)){
				
				$lograwat->save(false);
				$model->save(false);
				$rm->save();
				 return $this->redirect(['pasien/sbb/'.$model->id]);
			
			}
			else
			{	
				return $this->render('kontrol', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('kontrol', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('kontrol', [
            'model' => $this->findModel($id),
            'rawatjalan' => $rawatjalan,
			'lograwat'=>$lograwat,
        ]);
    }
	public function actionKontroligd($id)
    {
		$igd = new Rawatjalan();
		$kunjungan = new Kunjungan();
		$rawat = new Rawatan();
		$rm = new Rekamedis();
		$lograwat = new Lograwat();
		$model = $this->findModel($id);
		$cekpa = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		$hrj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		
		if ($igd->load(Yii::$app->request->post())
			&& $lograwat->load(Yii::$app->request->post())			
			&& Model::validateMultiple([$igd])) {
			$igd->genKode();
			
			$igd->idverifed = Yii::$app->user->identity->id ;
			$igd->tgldaftar = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
			$igd->status = 1 ;
			$igd->usia = $model->usia ;
			$igd->idkb = 2;
			$igd->klpcm = 1;
			$igd->idjenisrawat = 3 ;
			$lograwat->idrawat = $igd->idrawat;
			$lograwat->rm = $igd->no_rekmed;
			$lograwat->jenis = "IGD";
			$lograwat->waktu = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
			$rawat->idrawat = $igd->idrawat;
			$rawat->no_rekmed = $igd->no_rekmed;
			$rawat->tgldaftar = $igd->tgldaftar;
			$rm->no_rekmed = $model->no_rekmed;
			$rm->idrawat = $igd->idrawat;
			$rm->peminjam = "IGD";
			$model->rmedis = 3;
			$sekarang = date('Y-m-d');
			$diff =strtotime($sekarang)-strtotime($model->tanggal_lahir); 
			$hari = $diff/86400;
			$tahun = floor($hari / 365);
			
			$rm->bulan =date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('m'))));
			$rm->tglpinjam = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$kunjungan->no_rekmed = $model->no_rekmed;
			$kunjungan->idrawat = $igd->idrawat;
			$kunjungan->idpekerjaan = $model->idpekerjaan;
			$kunjungan->sebagai = $model->subid;
			$kunjungan->created_at = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			if($hrj < 2){
				$model->stpasien = 'Baru';
			}else if($hrj >= 2){
				$model->stpasien = 'Old';
			}
			$model->stat = 1 ;
			$model->usia = $tahun;
			if($cekpa > 0){
				$kunjungan->save(false); 
			}else{"";}
			if($igd->save(false)){
			$lograwat->save(false);  
			$rawat->save();  
			$model->save(false);  
			$rm->save();  
				    return $this->redirect(['pasien/sbb/'.$model->id]);
			}
			else
			{	
				return $this->render('igd', ['lograwat'=>$lograwat,'igd' => $igd,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('kontroligd', ['lograwat'=>$lograwat,'igd' => $igd,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('kontroligd', [
            'model' => $this->findModel($id),
            'igd' => $igd,
			'lograwat'=>$lograwat,
        ]);
    }
	
	public function actionRawatjalan($id)
    {
		$rawatjalan = new Rawatjalan();
		$lograwat = new Lograwat();
		$kunjungan = new Kunjungan();
		$rm = new Rekamedis();
		$model = $this->findModel($id);
		$cekpa = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		$hrj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		
		if ($rawatjalan->load(Yii::$app->request->post()) 
			&& $lograwat->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$rawatjalan])) {
			$tkunjungan = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			if($tkunjungan < 1){
			$rawatjalan->kunjungan = 1;
			}else{
			$rawatjalan->kunjungan = $tkunjungan + 1 ;
			}
			$rawatjalan->genKode();
			$rawatjalan->idpekerjaan = $model->idpekerjaan;
			$rawatjalan->idverifed = Yii::$app->user->identity->id ;
			$rawatjalan->tgldaftar = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			($rawatjalan->antrian)? $rawatjalan->antrian : $rawatjalan->genAntri($rawatjalan->idpoli);
			$rawatjalan->status = 1;
			$rawatjalan->klpcm = 1;
			$rawatjalan->idjenisrawat = 1 ;
			$rawatjalan->usia = $model->usia ;
			$rawatjalan->idkb = 1;
			$rm->no_rekmed = $model->no_rekmed;
			$rm->idrawat = $rawatjalan->idrawat;
			$model->rmedis = 1;
			$rm->peminjam = $rawatjalan->polii->namapoli;
			$rm->bulan =date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('m'))));
			$rm->tglpinjam = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$lograwat->idrawat = $rawatjalan->idrawat;
			$lograwat->jenis = $rawatjalan->polii->namapoli;
			$kunjungan->no_rekmed = $model->no_rekmed;
			$kunjungan->idrawat = $rawatjalan->idrawat;
			$kunjungan->idpekerjaan = $model->idpekerjaan;
			$kunjungan->sebagai = $model->subid;
			$kunjungan->created_at = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			if($hrj <= 2){
				$model->stpasien = 'Baru';
			}else if($hrj > 2){
				$model->stpasien = 'Old';
			}
			$lograwat->waktu = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->stat = 1 ;
			$model->t_berobat = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			if($cekpa > 0){
				$kunjungan->save(false); 
			}else{"";}
			if($rawatjalan->save(false)){
				
				$lograwat->save(false);
				$model->save();
				$rm->save(false);
				  return $this->redirect(['pasien/'.$model->id]);
			}
			else
			{	
				return $this->render('rawatjalan', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('rawatjalan', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('rawatjalan', [
            'model' => $this->findModel($id),
            'rawatjalan' => $rawatjalan,
			'lograwat'=>$lograwat,
        ]);
    }
	
	public function actionRawatinap($id)
    {
		$rawatinap = new Rawatjalan();
		$rm = new Rekamedis();
		
		
		$model = $this->findModel($id);
		
		if ($rawatinap->load(Yii::$app->request->post()) 
			
			&& Model::validateMultiple([$rawatinap])) {
			$rawatinap->genKode();
			$rawatinap->idverifed = Yii::$app->user->identity->id ;
			$rawatinap->tgldaftar = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
			$rawatinap->usia = $model->usia ;
			$rawatinap->status = 1 ;
			$rawatinap->idjenisrawat = 2 ;
			$rawatinap->perawatan = "Rawat Inap" ;
			$model->stat = 1 ;
			$rm->no_rekmed = $model->no_rekmed;
			$rm->idrawat = $model->idrawat;
			$rm->peminjam = "Rawat Inap";
			$model->rmedis = 2;
			$rm->bulan =date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('m'))));
			$rm->tglpinjam = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			
			if($rawatinap->save()){
			$model->save();  
			$rm->save();  
		
				  return $this->redirect(['rawatjalan/isikamar/'.$rawatinap->id]);
			}
			else
			{	
				return $this->render('rawatinap', ['rawatinap' => $rawatinap,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('rawatinap', ['rawatinap' => $rawatinap,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('rawatinap', [
            'model' => $this->findModel($id),
            'rawatinap' => $rawatinap,
        ]);
    }
	public function actionIgd($id)
    {
		$igd = new Rawatjalan();
		$kunjungan = new Kunjungan();
		$rawat = new Rawatan();
		$rm = new Rekamedis();
		$lograwat = new Lograwat();
		$model = $this->findModel($id);
		$cekpa = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		$hrj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		
		if ($igd->load(Yii::$app->request->post())
			&& $lograwat->load(Yii::$app->request->post())			
			&& Model::validateMultiple([$igd])) {
			$tkunjungan = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			if($tkunjungan < 1){
			$igd->kunjungan = 1;
			$igd->klpcm = 1;
			}else{
			$igd->kunjungan = $tkunjungan + 1 ;
			}
			$igd->genKode();
			$igd->idpekerjaan = $model->idpekerjaan;
			$igd->idverifed = Yii::$app->user->identity->id ;
			$igd->tgldaftar = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
			$igd->status = 1 ;
			$igd->usia = $model->usia ;
			$igd->idkb = 1;
			$igd->idjenisrawat = 3 ;
			$igd->klpcm = 1 ;
			$lograwat->idrawat = $igd->idrawat;
			$lograwat->rm = $igd->no_rekmed;
			$lograwat->jenis = "IGD";
			$lograwat->waktu = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
			$rawat->idrawat = $igd->idrawat;
			$rawat->no_rekmed = $igd->no_rekmed;
			$rawat->tgldaftar = $igd->tgldaftar;
			$rm->no_rekmed = $model->no_rekmed;
			$rm->idrawat = $igd->idrawat;
			$rm->peminjam = "IGD";
			$model->rmedis = 3;
			$rm->bulan =date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('m'))));
			$rm->tglpinjam = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$kunjungan->no_rekmed = $model->no_rekmed;
			$kunjungan->idrawat = $igd->idrawat;
			$kunjungan->idpekerjaan = $model->idpekerjaan;
			$kunjungan->sebagai = $model->subid;
			$kunjungan->created_at = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			if($hrj < 2){
				$model->stpasien = 'Baru';
			}else if($hrj >= 2){
				$model->stpasien = 'Old';
			}
			$model->stat = 1 ;
			if($cekpa > 0){
				$kunjungan->save(false); 
			}else{"";}
			if($igd->save(false)){
			$lograwat->save(false);  
			$rawat->save();  
			$model->save();  
			$rm->save(false);  
				  return $this->redirect(['pasien/'.$model->id]);
			}
			else
			{	
				return $this->render('igd', ['lograwat'=>$lograwat,'igd' => $igd,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('igd', ['lograwat'=>$lograwat,'igd' => $igd,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('igd', [
            'model' => $this->findModel($id),
            'igd' => $igd,
			'lograwat'=>$lograwat,
        ]);
    }
	
	
    /**
     * Creates a new Pasisen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      
		$model = new Pasien();
		$pekerjaan = new Pekerjaan();
		$kelas = '';
		if ($model->load(Yii::$app->request->post()) 
			&& $pekerjaan->load(Yii::$app->request->post())
			&& Model::validateMultiple([$pekerjaan])) {
			$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
			if($pasien != null){
				$norm = (substr($model->no_rekmed,1));
			$anom = $norm + 1;
			$r = 0;
			$model->no_rekmed = $r.$anom;
			$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			$model->idverifed = Yii::$app->user->identity->id ;
			$model->tanggal_lahir = date('Y-m-d', strtotime($model->tanggal_lahir));
			$model->created_at = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$pekerjaan->idpasien = $model->no_rekmed ;
			$model->idpekerjaan = $pekerjaan->idjenis ;
			$model->stpasien = 'Baru';
			}else{
			$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			$model->idverifed = Yii::$app->user->identity->id ;
			$model->tanggal_lahir = date('Y-m-d', strtotime($model->tanggal_lahir));
			$model->created_at = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$pekerjaan->idpasien = $model->no_rekmed ;
			$model->idpekerjaan = $pekerjaan->idjenis ;
			$model->stpasien = 'Baru';
			}
			
			//if($model->usia < 2 ){
			//	$model->sbb = 'By';
			//}else if($model->usia > 2 || $model->usia < 15){
			//	$model->sbb = 'An';
			//}else if($model->usia > 16 ){
			//	if($model->jenis_kelamin == 'L'){
			//		$model->sbb = 'Tn';
			//	}else if($model->jenis_kelamin == 'P'){
			//		if($model->idstatus == 2){
			//			$model->sbb = 'Nn';
			//		}else{
			//			$model->sbb = 'Ny';
			//		}
			//	}
			//}
			if($model->save(false)){
				
			   $pekerjaan->save();
			   $kec = Kelurahan::find()->where(['id_kel'=>$model->idkel])->one();
				$kab = Kecamatan::find()->where(['id_kec'=>$kec->id_kec])->one();
				$prov = Kabupaten::find()->where(['id_kab'=>$kab->id_kab])->one();
				$model->idkec = $kec->id_kec;
				$model->idkab = $kab->id_kab;
				$model->idprov = $prov->id_prov;
			if($model->usia < 1 ){
				$model->sbb = 'By';
			}else if($model->usia >= 1 && $model->usia < 17){
				$model->sbb = 'An';
			}else if($model->usia > 17 ){
				if($model->jenis_kelamin == 'L'){
					$model->sbb = 'Tn';
				}else if($model->jenis_kelamin == 'P'){
					if($model->id_status == 2){
						$model->sbb = 'Nn';
					}else{
						$model->sbb = 'Ny';
					}
				}
			}
			$model->save(false);
				 return $this->redirect(['sbb', 'id' => $model->id]);
			}
			else
			{	
				return $this->render('create', ['model' => $model,'pekerjaan' => $pekerjaan,'kelas'=>$kelas]);
			}
			
		   
		} else {
			return $this->render('create', ['model' => $model,'pekerjaan' => $pekerjaan,'kelas'=>$kelas]);
		
		}
	
    }
	public function actionShowAll($id){
		$time = date('Y-m-d');
		$nokartu =$id;
		$url = 'https://new-simrs.rsausulaiman.com/auth/cek?kartu='.$nokartu.'&tgl='.$time;
	   //   $url = 'https://simrs.rsausulaiman.com/api/cek?kartu='.$noKartu.'&tgl='.$tglSep;
		$content = Yii::$app->kazo->fetchApiData($url);
		$data_json = json_decode($content, true);
	
		$model = new Pasien();
		$pekerjaan = new Pekerjaan();
		
		return $this->renderAjax('_showAll', [
            'kelas' => $data_json,
            'model' => $model,
            'pekerjaan' => $pekerjaan,
        ]);

	}
	public function actionPesertabpjs($id=''){
		$time = date('Y-m-d');
		$nokartu =$id;
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$data_json=json_decode($response, true);
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		
		$model = new Pasien();
		$pekerjaan = new Pekerjaan();
		if($data_json['response'] == null ){
		\Yii::$app->getSession()->setFlash('danger', 'Data Tidak Di Temukan');
        return $this->render("pesertabpjs",['kelas'=>$kelas,'model'=>$model]);
		}
		if ($model->load(Yii::$app->request->post())
			&& $pekerjaan->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$model])) {
			$model->idverifed = Yii::$app->user->identity->id ;
			$model->tanggal_lahir = date('Y-m-d', strtotime($model->tanggal_lahir));
			$model->created_at = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$pekerjaan->idpasien = $model->no_rekmed ;
			$lahir = date('Y-m-d',strtotime($kelas['tglLahir']));
			$sekarang = date('Y-m-d');
			$diff =strtotime($sekarang)-strtotime($lahir); 
			$hari = $diff/86400;
			$tahun = floor($hari / 365);
			// if($tahun < 2 ){
				// $model->sbb = 'By';
			// }else if($tahun > 2 && $tahun < 15){
				// $model->sbb = 'An';
			// }else if($tahun > 16 ){
				// if($model->jenis_kelamin == 'L'){
					// $model->sbb = 'Tn';
				// }else if($model->jenis_kelamin == 'P'){
					// if($model->id_status == 2){
						// $model->sbb = 'Nn';
					// }else{
						// $model->sbb = 'Ny';
					// }
				// }
			// }
			if($model->save(false)){
			     $pekerjaan->save();
				 return $this->redirect(['view', 'id' => $model->id]);
			}
			else
			{	
				return $this->render('pesertabpjs', ['model' => $model,'kelas'=>$kelas,'pekerjaan'=>$pekerjaan]);
			}
			
		   
		} else {
			return $this->render('pesertabpjs', ['model' => $model,'kelas'=>$kelas,'pekerjaan'=>$pekerjaan]);
		
		}
	}
	 public function actionCreatebpjs($id)
    {
		
		$time = date('Y-m-d');
		$nokartu =$id;
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$data_json=json_decode($response, true);
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		$model = new Pasien();
		$pekerjaan = new Pekerjaan();

		if ($model->load(Yii::$app->request->post()) 
			&& $pekerjaan->load(Yii::$app->request->post())
			&& Model::validateMultiple([$model,$pekerjaan])) {
			$model->idverifed = Yii::$app->user->identity->id ;
			$model->tanggal_lahir = date('Y-m-d', strtotime($model->tanggal_lahir));
			$model->created_at = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$pekerjaan->idpasien = $model->no_rekmed ;
			$model->idpekerjaan = $pekerjaan->idjenis ;
			if($model->save()){
			   $pekerjaan->save();
				 return $this->redirect(['view', 'id' => $model->id]);
			}
			else
			{	
				return $this->render('createbpjs', ['model' => $model,'pekerjaan' => $pekerjaan,'kelas'=>$kelas]);
			}
			
		   
		} else {
			return $this->render('createbpjs', ['model' => $model,'pekerjaan' => $pekerjaan,'kelas'=>$kelas]);
		
		}
	
    }
	 public function actionCreaterawatjalan()
    {
      
		$rawatjalan = new Rawatjalan();
		$model = new Pasien();


	
    }

    /**
     * Updates an existing Pasisen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post())){
			$model->idverifed = Yii::$app->user->identity->id ;
			$model->idkab = $model->idkab ;
			$model->idkec = $model->idkec;
			$model->idkel = $model->idkel;
			$model->tanggal_lahir = date('Y-m-d', strtotime($model->tanggal_lahir));
			$model->created_at = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			if($model->usia < 1 ){
				$model->sbb = 'By';
			}else if($model->usia >= 1 && $model->usia < 15){
				$model->sbb = 'An';
			}else if($model->usia > 16 ){
				if($model->jenis_kelamin == 'L'){
					$model->sbb = 'Tn';
				}else if($model->jenis_kelamin == 'P'){
					if($model->id_status == 2){
						$model->sbb = 'Nn';
					}else{
						$model->sbb = 'Ny';
					}
				}
			}
			if($model->save(false)){
				return $this->redirect(['view', 'id' => $model->id]);
			}
			else
			{	
				return $this->render('update', ['model' => $model]);
			}
			
		   
		} else {
			return $this->render('update', ['model' => $model]);
		
		}
    }

    /**
     * Deletes an existing Pasisen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {	
        $this->findModel($id)->delete();
		
        return $this->redirect(['index']);
    }
	public function actionKirim()
	{
		$mpdf = new mPDF;
		$mpdf->WriteHTML('simple');
		$mpdf->Output();
		exit;
	}
	 public function actionList($id)
	  {
		$models=Kabupaten::find()->where(['id_prov' => $id])->orderBy('nama')->all();
		echo"<option value='0'>- Pilih -</option>";
		foreach($models as $k){
		  echo "<option value='".$k->id_kab."'>".$k->nama."</option>";
		}
	  }

	  public function actionListkec($id)
	  {
		$models=Kecamatan::find()->where(['id_kab' => $id])->orderBy('nama')->all();
			echo"<option value='0'>- Pilih Kecamatan -</option>";
		foreach($models as $k){
		  echo "<option value='".$k->id_kec."'>".$k->nama."</option>";
		}
	  }
	  
	   public function actionListkel($id)
	  {
		$models=Kelurahan::find()->where(['id_kec' => $id])->orderBy('nama')->all();
			echo"<option value='0'>- Pilih Kecamatan -</option>";
		foreach($models as $k){
		  echo "<option value='".$k->id_kel."'>".$k->nama."</option>";
		}
	  }
	  	  public function actionLista($id)
	  {
		$models=Kamar::find()->where(['idkelas' => $id])->andwhere(['status'=>0])->orderBy('namaruangan')->all();
		
		foreach($models as $k){
			
		  echo "<option value='".$k->id."'>".$k->namaruangan."</option>";
			
		}
	  }
	   public function actionListdok($id)
	  {
		$models=Dokter::find()->where(['idpoli' => $id])->orderBy('namadokter')->all();
		
		foreach($models as $k){
		  echo "<option value='".$k->id."'>".$k->namadokter."</option>";
		}
	  }

	  public function actionBpi($id) {
	  //tampilkan bukti proses
	  $model = Pasien::find()->where(['id' => $id])->one();
	  $content = $this->renderPartial('printpasien',['model' => $model,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   //'format' => [80,50],
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/site.css',
	   'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
    /**
     * Finds the Pasisen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pasisen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pasien::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
