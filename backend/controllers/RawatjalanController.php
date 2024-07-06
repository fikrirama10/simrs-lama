<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Lab;
use common\models\Prosedur;
use common\models\Orderlab;
use common\models\KuotaPasien;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Jenisbayar;
use common\models\RawatjalanBatal;
use common\models\Rekamedis;
use common\models\Tindakandokter;
use common\models\PemeriksaanIgd;
use common\models\PemeriksaanRajal;
use common\models\Rxfisik;
use common\models\Rxlabor;
use common\models\Diagnosa;
use common\models\Pekerjaan;
use common\models\Pasien;
use common\models\Kamar;
use kartik\mpdf\Pdf;
use common\models\RawatjalanSearch;
use common\models\PemriklabSearch;
use common\models\Doktertindakan;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class RawatjalanController extends Controller
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
     * Lists all Rawatjalan models.
     * @return mixed
     */
     
    	public function actionBatalberobat($id){
		$model = $this->findModel($id);
		$batal = new RawatjalanBatal();
		$date = date('Y-m-d',strtotime('+5 hour',strtotime(date('Y-m-d'))));
		$daftar = date('Y-m-d',strtotime($model->tgldaftar));
		
		$tglsatu = strtotime($date);
		$tgldua = strtotime($daftar);
		$kuota = KuotaPasien::find()->where(['tgl'=>$daftar])->andwhere(['idpoli'=>$model->idpoli])->andwhere(['iddokter'=>$model->iddokter])->one();
		 if($tgldua < $daftar){
			\Yii::$app->getSession()->setFlash('danger', 'Tgl Telah terlewat hubungi IT terkait jika ingin membatalkan');
			return $this->redirect(Yii::$app->request->referrer);
		}
		if ($batal->load(Yii::$app->request->post())) {
			$batal->idrawat = $model->id;
			$batal->no_rekmed = $model->no_rekmed;
			$batal->tgldaftar = $model->tgldaftar;
			$batal->tglcreate = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			$batal->iduser = Yii::$app->user->identity->id;
			$batal->idbayar =  $model->idbayar;
			if($batal->save(false)){
			    if($model->idjenisrawat == 1){
			        $kuota->sisa = $kuota->sisa + 1;
			       	$kuota->save(false);
			    }
			    $model->status = 11;
				$model->batal = 1;
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			}else{
				return $this->render('batalberobat',[
					'model'=>$model,
					'batal'=>$batal,
				]);
			}
		}
		return $this->render('batalberobat',[
			'model'=>$model,
			'batal'=>$batal,
		]);
	}
	public function actionListPasien(){
		return $this->render('list-pasien');
	}
	public function actionShow($id,$tgl){
		$model = Rawatjalan::find()->where(['tgldaftar'=>$tgl])->andWhere(['idpoli'=>$id])->andwhere(['anggota'=>1])->andwhere(['batal'=>null])->all();
		$umum = Rawatjalan::find()->where(['tgldaftar'=>$tgl])->andWhere(['idpoli'=>$id])->andwhere(['anggota'=>0])->andwhere(['batal'=>null])->all();
		$jadwal = KuotaPasien::find()->where(['tgl'=>$tgl])->andWhere(['idpoli'=>$id])->all();
		return $this->renderAjax('show',[
			'model'=>$model,
			'jadwal'=>$jadwal,
			'umum'=>$umum,
		]);
	}
	 public function actionTdokter($id)
    {
       
		$model = $this->findModel($id);
		$tindakandokter = new Tindakandokter();
		if ($tindakandokter->load(Yii::$app->request->post())) {
			$tindakandokter->tgl = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			$tindakandokter->idtkp = 2 ;
			$tindakandokter->no_rekmed = $model->no_rekmed;
			if($tindakandokter->save()){
				
				$model->save();
				if(!Yii::$app->request->isAjax){
					return $this->redirect(['tdokter', 'id' => $model->id]);
				}
			}
			else
			{	
				return $this->render('tdokter', ['tindakandokter' => $tindakandokter, 'model'=>$model,]);
			}
			
		   
		} else {
			return $this->render('tdokter', ['tindakandokter' => $tindakandokter, 'model'=>$model,]);
		
		}
		
        return $this->render('tdokter', [
			'model'=>$model,
            'tindakandokter' => $tindakandokter,
        ]);
    }
    public function actionIndex()
    {
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 public function actionLaporanrawat($start='', $end='',$cek='')
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
			$andWhere = ['between', 'status', 1, 8];
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['between', 'status', 1, 8];
			$title = 'Hari Ini';
		}

        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
		
        return $this->render('laporanrawat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'title'=>$title,
			
        ]);
    }
	 public function actionGetSearch($start='', $end='',$cek='',$search='',$search2='')
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
			$andWhere2 = ['idjenisrawat'=>$search];			
			$andWhere3 = ['idbayar'=>$search2];
			$andWhere4 = ['batal'=>null];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere2 = ['idjenisrawat'=>$search];
			$andWhere3 = ['idbayar'=>$search2];
			$andWhere4 = ['batal'=>null];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
			//$andWhere = ['<>','batal',  1];
		
		}
		$groupBy = 'no_rekmed';

        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere2,$andWhere3,$andWhere4,$groupBy);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,			
			'title'=>$title,
			
		
        ]);
    }
	
	public function actionReport($start='', $end='', $cek='', $search='')
	{
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			// else if($cek == 'custom'){ $title = 'Periode'; }
			else if($cek == 'custom'){ $title = '<br>'.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
		
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			//$andWhere = ['IdStat'=>4];
			$andWhere = ['between', 'idbayar', 1, 5];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$title = 'Hari Ini';
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['IdStat'=>4];
			$andWhere = ['between', 'idbayar', 1, 5];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
			
			
		}
		$umum = Rawatjalan::find()->where($where)->andwhere($andWhere)->andWhere($andFilterWhere)->andwhere(['idbayar'=>4])->groupby(['no_rekmed'])->count(); 
		$bpjs = Rawatjalan::find()->where($where)->andwhere($andWhere)->andWhere($andFilterWhere)->andwhere(['idbayar'=>5])->groupby(['no_rekmed'])->count(); 
		$dataProvider = Rawatjalan::find()->where($where)->andwhere($andWhere)->andWhere($andFilterWhere)->groupby(['no_rekmed'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report', ['dataProvider' => $dataProvider,  'title'=>$title, 'search'=>$search,'umum'=>$umum,'bpjs'=>$bpjs]);
		
		$footer = '
		<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top:3mm !important; margin-top:-50px !imporatnt">
		Page {PAGENO} of {nb}
		</div>';
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content, 
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@frontend/web/css/paper.css',
             // call mPDF methods on the fly
            'methods' => [
                // 'SetHeader'=>['THIS IS REPORT'],
                'SetFooter'=>[$footer],
            ]
        ]);
 
        // http response
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
 
        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    /**
     * Displays a single Rawatjalan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model =  $this->findModel($id);
        if($model->idjenisrawat == 1){
            $rawat = PemeriksaanRajal::find()->where(['idrawat'=>$model->id])->one() ;
            $rawatc = PemeriksaanRajal::find()->where(['idrawat'=>$model->id])->count() ;
            if($rawatc < 1){
                return $this->render('view', [
                    'model' => $model,
                     
                ]);
            }else{
               return $this->render('view', [
                    'model' => $model,
                     
                ]);
            }
            
        }else if($model->idjenisrawat == 3){
            $rawat = PemeriksaanIgd::find()->where(['idrawat'=>$model->id])->one() ;
            $rawatc = PemeriksaanIgd::find()->where(['idrawat'=>$model->id])->count() ;
             if($rawatc < 1){
               return $this->render('view', [
                    'model' => $model,
                     
                ]);
            }else{
               return $this->render('view', [
                    'model' => $model,
                     
                ]);
            }
            
            
        }
        
    }
	public function actionPeriksalab($id)
    {
    	$model=  $this->findModel($id);
        $searchModel = new PemriklabSearch();
        $where = ['idrawat'=> $model->idrawat] ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);

        return $this->render('periksalab', [
            'model' => $model,
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Rawatjalan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rawatjalan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rawatjalan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
	 public function actionPreviewpasien($id)
    {
		$model = $this->findModel($id);
		$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
		
        return $this->render('previewpasien',[
            'model' => $model,
            'pasien' => $pasien,
           
        ]);
    }
	 public function actionBuang($id)
    {
		  $model = $this->findTindakan($id);
	
		$model->delete();
		\Yii::$app->getSession()->setFlash('danger', 'Terhapus');
        return $this->redirect(['rawatjalan/tindakdokter/'.$id]);
    }
	public function actionTindakandokter($id)
    {
		$model = $this->findModel($id);
		
		$tindakandokter = new Tindakandokter();
		$prosedur = new Prosedur();
		if ($tindakandokter->load(Yii::$app->request->post())) {
			$model->status = 6;
			$tindakandokter->idtkp = $model->idjenisrawat;
			if($tindakandokter->save()){
				
				$model->save();
				 return $this->redirect(['rawatjalan/tindakdokter/'.$id]);
			}
			else
			{	
				return $this->render('tindakandokter', ['tindakandokter' => $tindakandokter,  'prosedur' => $prosedur,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('tindakandokter', ['tindakandokter' => $tindakandokter,  'prosedur' => $prosedur,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('tindakandokter', [
            'model' => $this->findModel($id),
            'prosedur' => $prosedur,
            'tindakandokter' => $tindakandokter,
        ]);
    }
	public function actionProsedur($id)
    {
		$model = $this->findModel($id);
		
		$prosedur = new Prosedur();
		if ($prosedur->load(Yii::$app->request->post())) {
			//$model->status = 6;
			$prosedur->idtkp = $model->idjenisrawat;
			if($prosedur->save()){
				
				//$model->save();
				 return $this->redirect(['rawatjalan/tindakdokter/'.$id]);
			}
			else
			{	
				return $this->render('tindakandokter', ['tindakandokter' => $tindakandokter,'prosedur' => $prosedur,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('tindakandokter', ['tindakandokter' => $tindakandokter,'prosedur' => $prosedur,'model' => $this->findModel($id),]);
		
		}
		
     return $this->render('tindakandokter', ['tindakandokter' => $tindakandokter,'prosedur' => $prosedur,'model' => $this->findModel($id),]);
    }

      public function actionTindakdokter($id)
    {

        $tind = new Doktertindakan;
        $model = $this->findModel($id);
        $tindakan = [new Tindakandokter];


        if ($tind->load(Yii::$app->request->post())) {


            $tindakan = Model::createMultiple(Tindakandokter::classname());

            Model::loadMultiple($tindakan, Yii::$app->request->post());


            // validate all models

            $valid = $tind->validate();

            $valid = Model::validateMultiple($tindakan) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
				$tind->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
				$tind->rm = $model->no_rekmed;
				$tind->idtkp = $model->idjenisrawat;

                try {

                    if ($flag = $tind->save(false)) {

                        foreach ($tindakan as $tindakan) {

                            $tindakan->no_rekmed = $tind->rm;
                            $tindakan->idtkp = $tind->idtkp;
                            $tindakan->tgl = $tind->tanggal;
                            $tindakan->idtin = $tind->id;
                            $tindakan->penindak = $tind->iddokter;
                            $tindakan->kode_rawat = $tind->idrawat;
                         
                          

                            if (! ($flag = $tindakan->save(false))) {

                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['terapi', 'id' => $model->id]);

                    }

                } catch (Exception $e) {

                    $transaction->rollBack();

                }

            }

        }


        return $this->render('tindakdokter', [

            'tind' => $tind,
            'model'=>$model,
            'tindakan' => (empty($tindakan)) ? [new Tindakandokter] : $tindakan 

        ]);

    }
    
	public function actionResepdokter($id)
    {
		$model = $this->findModel($id);
		
		$tindakandokter = new Tindakandokter();
		$resepdokter = new Resepdokter();
		
		if ($resepdokter->load(Yii::$app->request->post())) {
			
			if($resepdokter->save()){
			  
				 return $this->redirect(['rawatjalan/resepdokter/'.$id]);
			}
			else
			{	
				return $this->render('resepdokter', ['tindakandokter' => $tindakandokter,'model' => $this->findModel($id),'resepdokter'=>$resepdokter,]);
			}
			
		   
		} else {
			return $this->render('resepdokter', ['tindakandokter' => $tindakandokter,'model' => $this->findModel($id),'resepdokter'=>$resepdokter,]);
		
		}
		
        return $this->render('resepdokter', [
            'model' => $this->findModel($id),
            'tindakandokter' => $tindakandokter,
			'resepdokter'=>$resepdokter,
        ]);
    }
	
	public function actionLab($id)
    {

        $labid = new Orderlab;
        $model = $this->findModel($id);
        $pemriklab = [new Lab];


        if ($labid->load(Yii::$app->request->post())) {


            $pemriklab = Model::createMultiple(Lab::classname());

            Model::loadMultiple($pemriklab, Yii::$app->request->post());


            // validate all models

            $valid = $labid->validate();

            $valid = Model::validateMultiple($pemriklab) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();


                try {

                    if ($flag = $labid->save(false)) {

                        foreach ($pemriklab as $pemriklab) {
							$labid->tgl_order = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
							$pemriklab->tanggal_req = $labid->tgl_order;
							$pemriklab->kodelab = $labid->kodelab;
                            $labid->no_rekmed = $model->no_rekmed;
							
                            if (! ($flag = $pemriklab->save(false))) {

                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['terapi', 'id' => $model->id]);

                    }

                } catch (Exception $e) {

                    $transaction->rollBack();

                }

            }

        }


        return $this->render('lab', [

            'labid' => $labid,
            'model'=>$model,
            'pemriklab' => (empty($pemriklab)) ? [new Lab] : $pemriklab

        ]);

    }
	
	public function actionTerapi($id)
    {
		$model = $this->findModel($id);
		
		$tindakandokter = new Tindakandokter();
		$resepdokter = new Resepdokter();
		
		if ($resepdokter->load(Yii::$app->request->post())) {
			$resepdokter->idtkp = $model->idjenisrawat;
			$resepdokter->no_rekmed = $model->no_rekmed;
			if($resepdokter->save()){
			  
				 return $this->redirect(['rawatjalan/terapi/'.$id]);
			}
			else
			{	
				return $this->render('terapi', ['tindakandokter' => $tindakandokter,'model' => $this->findModel($id),'resepdokter'=>$resepdokter,]);
			}
			
		   
		} else {
			return $this->render('terapi', ['tindakandokter' => $tindakandokter,'model' => $this->findModel($id),'resepdokter'=>$resepdokter,]);
		
		}
		
        return $this->render('terapi', [
            'model' => $this->findModel($id),
            'tindakandokter' => $tindakandokter,
			'resepdokter'=>$resepdokter,
        ]);
    }
	
	public function actionSelesai($id)
    {
		$model = $this->findModel($id);
		$model->status = 7;
		$model->save();
		
		Yii::$app->session->setFlash('Pemeriksaan selesai', 'Sarahkan Pasien Ke bagian Pembayaran / Kasir');
		if($model->idjenisrawat == 3){
		return $this->redirect(['/rawatjalan/igd2']);	
		}else if($model->idjenisrawat == 1){
			if($model->idpoli == 1){
			return $this->redirect(['/poli/poligigi2']);	
			}else if($model->idpoli == 2){
			return $this->redirect(['/poli/polianak2']);
			}else if($model->idpoli == 3){
			return $this->redirect(['/poli/bedah2']);
			}else if($model->idpoli == 4){
			return $this->redirect(['/poli/polidalam2']);
			}else if($model->idpoli == 5){
			return $this->redirect(['/poli/polianak2']);
			}
			else {
				return $this->redirect(['/rawatjalan/igd2']);	
			}
		
		}else{
			return $this->redirect(['/']);	
		}
    }
	public function actionBeres($id){
		$model = $this->findModel($id);
		$model->status = 2;
		$model->jampemeriksaan = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
		$model->save();
		return $this->redirect(['rawatjalan/detailpasien/'.$id]);
	}
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
           return $this->redirect(['pasien/'.$pasien->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	 public function actionInsep($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('insep', [
                'model' => $model,
            ]);
        }
    }
		 public function actionDetailpasien($id)
    {
		$keluhan = new keluhan();
		$rxfisik = new Rxfisik();
		$rxlabor = new Rxlabor();
		$dmodel = new Rawatjalan();
		$model = $this->findModel($id);
		if ($keluhan->load(Yii::$app->request->post())
			&&$rxfisik->load(Yii::$app->request->post())
			&&$rxlabor->load(Yii::$app->request->post())
			&&$model->load(Yii::$app->request->post())
			)
			 {
			$model->status = 5;
			//$model->kodediagnosa = 	$model->kodediagnosa ;
			if($keluhan->save()){
				
				$model->save();
				$rxfisik->save();
				$rxlabor->save();
				
						  
				 return $this->redirect(['rawatjalan/tindakdokter/'.$id]);
			}
			else
			{	
				return $this->render('detailpasien', ['keluhah' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,'rxlabor'=>$rxlabor,]);
			}
			
		   
		} else {
			return $this->render('detailpasien', ['keluhan' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,'rxlabor'=>$rxlabor,]);
		
		}
		
        return $this->render('detailpasien', [
            'model' => $this->findModel($id),
            'keluhan' => $keluhan,
			'rxfisik'=>$rxfisik,
			'rxlabor'=>$rxlabor,
        ]);
	}
    /**
     * Deletes an existing Rawatjalan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$model =  $this->findModel($id);
		$rm = Rekamedis::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
		$rmc = Rekamedis::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
	if($rmc > 0){
		$rm->delete();
		$model->delete();
		return $this->redirect(Yii::$app->request->referrer);
	}else{
		$model->delete();
		return $this->redirect(Yii::$app->request->referrer);
	}
	
		
		

       
    }
	 	 public function actionIsikamar($id)
    {
        $model = $this->findModel($id);
		
		$model->tglmasuk = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
		//$kamar->masuk++ ;
		$model->status = 8;
		//$kamar->save();
		
		if($model->save()){
			$kamar = Kamar::find()->where(['id' => $model->idruangan])->one();
			$ht = Rawatjalan::find()->where(['idruangan'=>$kamar->id])->andwhere(['status'=>8])->andwhere(['idjenisrawat'=>2])->count();
			$tersedia = $kamar->tempattidur - $ht;
			if($kamar->gender == 2){
				$arrdip= json_encode(array(			  
					"kodekelas"=>$kamar->kodekelas, 
					"koderuang"=>$kamar->kodekamar, 
					"namaruang"=>"Ruang ". $kamar->namaruangan, 
					"kapasitas"=>$kamar->tempattidur, 
					"tersedia"=>$tersedia,
					"tersediapria"=>"0", 
					"tersediawanita"=>$tersedia, 
					"tersediapriawanita"=>"0"
				));
			}else if($kamar->gender == 3){
				
				$arrdip= json_encode(array(			  
					"kodekelas"=>$kamar->kodekelas, 
					"koderuang"=>$kamar->kodekamar, 
					"namaruang"=>"Ruang ". $kamar->namaruangan, 
					"kapasitas"=>$kamar->tempattidur, 
					"tersedia"=>$tersedia,
					"tersediapria"=>$tersedia, 
					"tersediawanita"=>"0", 
					"tersediapriawanita"=>"0"
				));
			}else{
				$arrdip= json_encode(array(			  
					"kodekelas"=>$kamar->kodekelas, 
					"koderuang"=>$kamar->kodekamar, 
					"namaruang"=>"Ruang ". $kamar->namaruangan, 
					"kapasitas"=>$kamar->tempattidur, 
					"tersedia"=>$tersedia,
					"tersediapria"=>"0", 
					"tersediawanita"=>"0", 
					"tersediapriawanita"=>$tersedia
				));
			}
		$data_string = \yii\helpers\Json::encode($arrdip);
		$data = "29855";
		$secretKey = "3rU307868B";
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
		$header[] = 'Content-Type: application/json;charset=utf-8';
		// $header[] = "Accept-Encoding: gzip, deflate";
		// $header[] = "Cache-Control: max-age=0";
		// $header[] = "Connection: keep-alive";
		// $header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		// $header[] = "Content-Length: " . strlen($data_string) ." ";
    
		
		$ch = curl_init("https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/0120R012");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $arrdip);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		$result=json_decode($result, true);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		//$data_string = json_encode($arrdip, true);
		echo print_r($result);
		echo print_r($arrdip);
		
		return $this->redirect(['rawatjalan/previewpasien/'.$model->id]);
		}
		
       
    }
	public function actionIgd()
    {
		$model = Rawatjalan::find()->where(['idjenisrawat'=>3])->andWhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d')])->andwhere(['status'=> 1])->all();
		$model2 = Rawatjalan::find()->where(['idjenisrawat'=>3])->andWhere('status > 1')->all();
	    return $this->render('igd', [
            'model' => $model,
            'model2' => $model2,
        ]);
    }
    public function actionIgd2()
    {
		
        $searchModel = new RawatjalanSearch();
		$where = ['idjenisrawat'=>3] ;
		$orderBy = ['tgldaftar'=>SORT_ASC] ;
		//$andWhere2 = ['status'=>1] ;
		//$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);

        return $this->render('igd2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	  public function actionReportranap()
    {
		$jp = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere(['status'=>7])->count();
		$jpawal = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere(['status'=>7])->andwhere(['between','DATE_FORMAT(tglkeluar,"%Y-%m-%d")','2020-01-01','2020-01-02'])->count();
		$jpakhir = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere(['status'=>7])->andwhere(['between','DATE_FORMAT(tglkeluar,"%Y-%m-%d")','2019-12-30','2019-12-31'])->count();
		$alos = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere(['between','DATE_FORMAT(tglkeluar,"%Y-%m-%d")','2019-01-01','2019-12-31'])->andwhere(['status'=>7])->sum('lamarawat');
		$total = $alos + $jp ;
		
       
        return $this->render('reportrawat', [
            'jp' => $jp,
            'jpawal' => $jpawal,
            'jpakhir' => $jpakhir,
            'total' => $total,
        ]);
    }
	
	  public function actionAsesmen($id)
    {
		$model = $this->findModel($id);
		$pemeriksaan = PemeriksaanIgd::find()->where(['idrawat'=>$id])->count();
		$pemeriksaana = PemeriksaanIgd::find()->where(['idrawat'=>$id])->one();
		if($pemeriksaan < 1){
			if($model->status == 7){
				return $this->redirect(['/rawatjalan/terapi/'.$model->id]);
			}else{
				return $this->redirect(['/pemeriksaan-ugd/create?id='.$model->id]);
			}
		}else{
			return $this->redirect(['/pemeriksaan-ugd/view?id='.$pemeriksaana->id]);
		}
		
    }
	 public function actionLabel($id) {
	  //tampilkan bukti proses
	  $rawatjalan = Rawatjalan::find()->where(['id' => $id])->one();
	  $model = Pasien::find()->where(['no_rekmed' =>$rawatjalan->no_rekmed ])->one();
	  $content = $this->renderPartial('printpasien',['model' => $model,'rawatjalan' => $rawatjalan,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => [60,36],
	   'marginTop' => '3',
	   'orientation' => Pdf::ORIENT_PORTRAIT, 
	   'marginLeft' => '4',
	   'marginRight' => '4',
	   'marginBottom' => '3',
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
	  public function actionLabel2() {
	  //tampilkan bukti proses
	
	  $content = $this->renderPartial('printlabel');
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => [70,34],
	   'marginTop' => '1',
	   'orientation' => Pdf::ORIENT_PORTRAIT, 
	   'marginLeft' => '10',
	   'marginRight' => '3',
	   'marginBottom' => '3',
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
	 
	public function actionFp($id) {
	  //tampilkan bukti proses
	  $rawatjalan = Rawatjalan::find()->where(['id' => $id])->one();
	  $model = Pasien::find()->where(['no_rekmed' =>$rawatjalan->no_rekmed ])->one();
	  $pekerjaan = Pekerjaan::find()->where(['idpasien' =>$rawatjalan->no_rekmed ])->one();
	  $content = $this->renderPartial('form-pasien2',['model' => $model,'rawatjalan' => $rawatjalan,'pekerjaan' => $pekerjaan,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/formpasien.css',
	   //'options' => ['title' => 'Bukti Permohonan Informasi'],

'methods' => [ 
            'SetFooter'=>['DRM. 01 - RJ'],
        ]	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	 public function actionTindakan($id)
	  {
		$models=Tindakandokter::find()->where(['idtindakan' => $id])->all();
		
		foreach($models as $k){
		  echo "<input value='".$k->tindakan->tarif."'></input>";
		}
	  }
	  public function actionHdiagnosa($id) {
	  //tampilkan bukti proses
	  $rawatjalan = Rawatjalan::find()->where(['id' => $id])->one();
	  $model = Pasien::find()->where(['no_rekmed' =>$rawatjalan->no_rekmed ])->one();
	  $content = $this->renderPartial('printdiagnosa',['model' => $model,'rawatjalan' => $rawatjalan,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => [148,210],
	   'marginTop' => '1 mm',
	   'orientation' => Pdf::ORIENT_PORTRAIT, 
	   'marginLeft' => '3mm',
	   'marginRight' => '3mm',
	   'marginBottom' => '3mm',
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

    /**
     * Finds the Rawatjalan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rawatjalan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findTindakan($id)
    {
        if (($model = Tindakandokter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
