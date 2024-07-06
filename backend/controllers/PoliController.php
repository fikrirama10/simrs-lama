<?php

namespace backend\controllers;

use Yii;
use common\models\Poli;
use common\models\PemeriksaanRajal;
use common\models\Rawatjalan;
use common\models\RawatjalanSearch;
use common\models\PoliSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use yii\filters\VerbFilter;

/**
 * PoliController implements the CRUD actions for Poli model.
 */
class PoliController extends Controller
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
	function angkaNol($nilai){
		if($nilai == '-'){
			return '0';
		}else{
			return $nilai;
		}
	}
		 public function actionAsesmen($id)
    {
		$model = $this->findRawat($id);
		$pemeriksaan = PemeriksaanRajal::find()->where(['idrawat'=>$id])->count();
		$pemeriksaana = PemeriksaanRajal::find()->where(['idrawat'=>$id])->one();
		if($pemeriksaan < 1){
			if($model->status == 7){
				return $this->redirect(['/rawatjalan/terapi/'.$model->id]);
			}else{
				return $this->redirect(['/pemeriksaan-rajal/create?id='.$model->id]);
			}
		}else{
			return $this->redirect(['/pemeriksaan-rajal/view?id='.$pemeriksaana->id]);
		}
    }

    /**
     * Lists all Poli models.
     * @return mixed
     */
    public function actionPdf() {
         
        $content = $this->renderPartial('index');
        
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, 
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Laporan Harian']
             
        ]);
        return $pdf->render();
    }
    public function actionIndex()
    {
        $searchModel = new PoliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPoligigi()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>1])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('poligigi', [
            'model' => $model,
        ]);
    }
	 public function actionPoligigi2()
    {
		
        $searchModel = new RawatjalanSearch();
		 
		$andWhere = ['idpoli'=>1] ;
		//$orderBy = ['tgldaftar'=>SORT_ASC] ;
		//$andWhere2 = ['status'=>1] ;
		$where = ['idjenisrawat'=>1] ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere);

        return $this->render('poligigi2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	//Poli Bedah
    public function actionPolibedah()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>3])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('polibedah', [
            'model' => $model,
        ]);
    }
	 public function actionPolibedah2()
    {
		
        $searchModel = new RawatjalanSearch();
		$andWhere = ['idjenisrawat'=>1] ;
		$andWhere2 = ['idpoli'=>3] ;
		//$orderBy = ['tgldaftar'=>SORT_ASC] ;
		//$andWhere2 = ['status'=>1] ;
		$where = ['idjenisrawat'=>1];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere2);

        return $this->render('polibedah2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	//poli anak
    public function actionPolianak()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>2])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('polianak', [
            'model' => $model,
        ]);
    }
	 public function actionPolianak2()
    {
		
      $searchModel = new RawatjalanSearch();
		$andWhere = ['idjenisrawat'=>1] ;
		$andWhere2 = ['idpoli'=>2] ;
		//$orderBy = ['tgldaftar'=>SORT_ASC] ;
		//$andWhere2 = ['status'=>1] ;
		$where = ['idjenisrawat'=>1];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere2);

        return $this->render('polianak2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionLaporan($awal,$akhir,$poli) {
	  //tampilkan bukti proses
		$url = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbulpolibyid?awal='.$awal.'&akhir='.$akhir.'&poli='.$poli;
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$content = $this->renderPartial('lapbul',['json' => $json]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	 
	 public function actionLaporanKunjungan($awal,$akhir) {
	  //tampilkan bukti proses
		$url = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbul-all?awal='.$awal.'&akhir='.$akhir;
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$content = $this->renderPartial('lapbul-all',['json' => $json]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	
	 public function actionLaporanAll($awal,$akhir) {
	  //tampilkan bukti proses
		$urlgigi = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbulpolibyid?awal='.$awal.'&akhir='.$akhir.'&poli=1';
		$contentgigi = file_get_contents($urlgigi);
		$gigi = json_decode($contentgigi, true);
		
		$urlanak = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbulpolibyid?awal='.$awal.'&akhir='.$akhir.'&poli=2';
		$contentanak = file_get_contents($urlanak);
		$anak = json_decode($contentanak, true);
		
		$urlbedah = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbulpolibyid?awal='.$awal.'&akhir='.$akhir.'&poli=3';
		$contentbedah = file_get_contents($urlbedah);
		$bedah = json_decode($contentbedah, true);
		
		$urlkandungan = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbulpolibyid?awal='.$awal.'&akhir='.$akhir.'&poli=5';
		$contentkandungan = file_get_contents($urlkandungan);
		$kandungan = json_decode($contentkandungan, true);
		
		$urldalam = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbulpolibyid?awal='.$awal.'&akhir='.$akhir.'&poli=4';
		$contentdalam = file_get_contents($urldalam);
		$dalam = json_decode($contentdalam, true);
		
		
		
		$milbaru = $this->angkaNol($gigi['tniau']['Mil']['PengunjungMilBaru']) + $this->angkaNol($dalam['tniau']['Mil']['PengunjungMilBaru']) + $this->angkaNol($kandungan['tniau']['Mil']['PengunjungMilBaru']) + $this->angkaNol($anak['tniau']['Mil']['PengunjungMilBaru']) + $this->angkaNol($bedah['tniau']['Mil']['PengunjungMilBaru']) ;
		
		$millama = $this->angkaNol($gigi['tniau']['Mil']['PengunjungMilLama']) + $this->angkaNol($dalam['tniau']['Mil']['PengunjungMilLama']) + $this->angkaNol($kandungan['tniau']['Mil']['PengunjungMilLama']) + $this->angkaNol($anak['tniau']['Mil']['PengunjungMilLama']) + $this->angkaNol($bedah['tniau']['Mil']['PengunjungMilLama']) ;
		
		$sipbaru = $this->angkaNol($gigi['tniau']['Sip']['PengunjungSipBaru']) + $this->angkaNol($dalam['tniau']['Sip']['PengunjungSipBaru']) + $this->angkaNol($kandungan['tniau']['Sip']['PengunjungSipBaru']) + $this->angkaNol($anak['tniau']['Sip']['PengunjungSipBaru']) + $this->angkaNol($bedah['tniau']['Sip']['PengunjungSipBaru']) ;
		
		$siplama = $this->angkaNol($gigi['tniau']['Sip']['PengunjungSipLama']) + $this->angkaNol($dalam['tniau']['Sip']['PengunjungSipLama']) + $this->angkaNol($kandungan['tniau']['Sip']['PengunjungSipLama']) + $this->angkaNol($anak['tniau']['Sip']['PengunjungSipLama']) + $this->angkaNol($bedah['tniau']['Sip']['PengunjungSipLama']) ;
		
		$kelbaru = $this->angkaNol($gigi['tniau']['Kel']['PengunjungKelBaru']) + $this->angkaNol($dalam['tniau']['Kel']['PengunjungKelBaru']) + $this->angkaNol($kandungan['tniau']['Kel']['PengunjungKelBaru']) + $this->angkaNol($anak['tniau']['Kel']['PengunjungKelBaru']) + $this->angkaNol($bedah['tniau']['Kel']['PengunjungKelBaru']) ;
		
		$kellama = $this->angkaNol($gigi['tniau']['Kel']['PengunjungKelLama']) + $this->angkaNol($dalam['tniau']['Kel']['PengunjungKelLama']) + $this->angkaNol($kandungan['tniau']['Kel']['PengunjungKelLama']) + $this->angkaNol($anak['tniau']['Kel']['PengunjungKelLama']) + $this->angkaNol($bedah['tniau']['Kel']['PengunjungKelLama']) ;
		
		
		$bpjslama = $this->angkaNol($gigi['Bpjs']['BpjsLama']) + $this->angkaNol($dalam['Bpjs']['BpjsLama']) + $this->angkaNol($kandungan['Bpjs']['BpjsLama']) + $this->angkaNol($anak['Bpjs']['BpjsLama']) + $this->angkaNol($bedah['Bpjs']['BpjsLama']) ;
		$bpjsbaru = $this->angkaNol($gigi['Bpjs']['BpjsBaru']) + $this->angkaNol($dalam['Bpjs']['BpjsBaru']) + $this->angkaNol($kandungan['Bpjs']['BpjsBaru']) + $this->angkaNol($anak['Bpjs']['BpjsBaru']) + $this->angkaNol($bedah['Bpjs']['BpjsBaru']) ;
		
		$yanmaslama = $this->angkaNol($gigi['Yanmas']['YanmasLama']) + $this->angkaNol($dalam['Yanmas']['YanmasLama']) + $this->angkaNol($kandungan['Yanmas']['YanmasLama']) + $this->angkaNol($anak['Yanmas']['YanmasLama']) + $this->angkaNol($bedah['Yanmas']['YanmasLama']) ;
		$yanmasbaru = $this->angkaNol($gigi['Yanmas']['YanmasBaru']) + $this->angkaNol($dalam['Yanmas']['YanmasBaru']) + $this->angkaNol($kandungan['Yanmas']['YanmasBaru']) + $this->angkaNol($anak['Yanmas']['YanmasBaru']) + $this->angkaNol($bedah['Yanmas']['YanmasBaru']) ;
		
		
		$jumlahlama = $this->angkaNol($gigi['Jumlah']['JumlahLama'])+ $this->angkaNol($dalam['Jumlah']['JumlahLama']) + $this->angkaNol($kandungan['Jumlah']['JumlahLama']) + $this->angkaNol($anak['Jumlah']['JumlahLama']) + $this->angkaNol($bedah['Jumlah']['JumlahLama']) ;
		$jumlahbaru = $this->angkaNol($gigi['Jumlah']['JumlahBaru'])+ $this->angkaNol($dalam['Jumlah']['JumlahBaru']) + $this->angkaNol($kandungan['Jumlah']['JumlahBaru']) + $this->angkaNol($anak['Jumlah']['JumlahBaru']) + $this->angkaNol($bedah['Jumlah']['JumlahBaru']) ;		
		
		$semua = $this->angkaNol($dalam['Jumlah']['JumlahSemua']) + $this->angkaNol($gigi['Jumlah']['JumlahSemua']) + $this->angkaNol($kandungan['Jumlah']['JumlahSemua']) +$this->angkaNol($bedah['Jumlah']['JumlahSemua']) + $this->angkaNol($anak['Jumlah']['JumlahSemua']);
		
		$content = $this->renderPartial('lapall',
		[
			'jumlahbaru' => $jumlahbaru,
			'jumlahlama' => $jumlahlama,
			'milbaru' => $milbaru,
			'millama' => $millama,
			'siplama' => $siplama,
			'sipbaru' => $sipbaru,
			'kellama' => $kellama,
			'kelbaru' => $kelbaru,
			'bpjsbaru' => $bpjsbaru,
			'bpjslama' => $bpjslama,
			'yanmaslama' => $yanmaslama, 
			'yanmasbaru' => $yanmasbaru,  
			'gigi' => $gigi,
			'anak' => $anak,
			'kandungan' => $kandungan,
			'bedah' => $bedah,
			'dalam' => $dalam,
			'semua' => $semua,
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	//penyakit dalam
    public function actionPolipenyakitdalam()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>4])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('polipenyakitdalam', [
            'model' => $model,
        ]);
    }
    public function actionLapbul(){
		return $this->render('lappbul');
	}
	public function actionPolidalam2()
    {
		
        $searchModel = new RawatjalanSearch();
		$andWhere = ['idjenisrawat'=>1] ;
		$andWhere2 = ['idpoli'=>4] ;
		//$orderBy = ['tgldaftar'=>SORT_ASC] ;
		//$andWhere2 = ['status'=>1] ;
		$where = ['idjenisrawat'=>1];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere2);

        return $this->render('polidalam2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	//kandungan
	public function actionPolikandungan2()
    {
		
        $searchModel = new RawatjalanSearch();
		$andWhere = ['idjenisrawat'=>1] ;
		$andWhere2 = ['idpoli'=>5] ;
		//$orderBy = ['tgldaftar'=>SORT_ASC] ;
		//$andWhere2 = ['status'=>1] ;
		$where = ['idjenisrawat'=>1];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere2);

        return $this->render('polikandungan2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPolikandungan()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>5])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('polikandungan', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Poli model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Poli model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Poli();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Poli model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
     public function actionDemopoli($start='', $end='',$cek='')
    {
        if($start !== '' && $end !== '' && $cek !== ''){
            if($cek == 'today'){ $title = 'Hari ini'; }
            else if($cek == 'this_month'){ $title = 'Bulan ini'; }
            else if($cek == 'this_year'){ $title = 'Tahun ini'; }
            // else if($cek == 'custom'){ $title = 'Periode'; }
            else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
            
            $start = date('Y-m-d', strtotime($start));
            $end = date('Y-m-d', strtotime($end));
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            //$andWhere = ['IdStat'=>4];
        }else{
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
            //$andWhere = ['jenis_kelamin'=>'L'];
            $title = 'Hari Ini';
        }
      $igd = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>3])->groupby(['idrawat'])->count();
        $polik = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->groupby(['idrawat'])->count();
        $inap = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>2])->groupby(['idrawat'])->count();
        $polibedah = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>3])->groupby(['idrawat'])->count();
        $polikandungan = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>5])->groupby(['idrawat'])->count();
        $polianak = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>2])->groupby(['idrawat'])->count();
        $polidalam = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>4])->groupby(['idrawat'])->count();
        $poligigi = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>1])->count();
        $politukang = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>6])->groupby(['idrawat'])->count();
        $rrj = Rawatjalan::find()->all();
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
        
        return $this->render('demopoli', [
           'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'poligigi' => $poligigi,
            'igd' => $igd,
            'polik' => $polik,
            'inap' => $inap,
            'polibedah' => $polibedah,
            'polianak' => $polianak,
            'polidalam' => $polidalam,
            'polikandungan' => $polikandungan,
            'politukang' => $politukang,
            'rrj' => $rrj,
            
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
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            $andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            $andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
        }else{
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
            $andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            $andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
        
        
        }
      
        $igd = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>3])->groupby(['idrawat'])->count();
        $polik = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->groupby(['idrawat'])->count();
        $inap = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>2])->groupby(['idrawat'])->count();
        $polibedah = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>3])->groupby(['idrawat'])->count();
        $polikandungan = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>5])->groupby(['idrawat'])->count();
        $polianak = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>2])->groupby(['idrawat'])->count();
        $polidalam = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>4])->groupby(['idrawat'])->count();
        $poligigi = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>1])->count();
        $politukang = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>6])->groupby(['idrawat'])->count();
        $rrj = Rawatjalan::find()->all();
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
        
        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'poligigi' => $poligigi,
            'igd' => $igd,
            'polik' => $polik,
            'inap' => $inap,
            'polibedah' => $polibedah,
            'polianak' => $polianak,
            'polidalam' => $polidalam,
            'polikandungan' => $polikandungan,
            'politukang' => $politukang,
            'rrj' => $rrj,
            
        ]);
    }

    /**
     * Deletes an existing Poli model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Poli model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Poli the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Poli::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findRawat($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
