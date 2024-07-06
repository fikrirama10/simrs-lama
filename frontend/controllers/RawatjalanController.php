<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Lab;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Tindakandokter;
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
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['IdStat'=>4];
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
			//$andWhere = ['IdStat'=>4];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['IdStat'=>4];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}

        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andFilterWhere);
     

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
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$title = 'Hari Ini';
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['IdStat'=>4];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
			
			
		}
		
		$dataProvider = Rawatjalan::find()->where($where)->andWhere($andFilterWhere)->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report', ['dataProvider' => $dataProvider,  'title'=>$title, 'search'=>$search,]);
		
		$footer = '
		<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top:3mm !important; margin-top:-50px !imporatnt">
		Page {PAGENO} of {nb}
		</div>';
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
        return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
    }
	public function actionTindakandokter($id)
    {
		$model = $this->findModel($id);
		
		$tindakandokter = new Tindakandokter();
		if ($tindakandokter->load(Yii::$app->request->post())) {
			$model->status = 6;
			$tindakandokter->idtkp = $model->idjenisrawat;
			if($tindakandokter->save()){
				
				$model->save();
				 return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
			}
			else
			{	
				return $this->render('tindakandokter', ['tindakandokter' => $tindakandokter,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('tindakandokter', ['tindakandokter' => $tindakandokter,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('tindakandokter', [
            'model' => $this->findModel($id),
            'tindakandokter' => $tindakandokter,
        ]);
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


                try {

                    if ($flag = $tind->save(false)) {

                        foreach ($tindakan as $tindakan) {

                            $tindakan->idtin = $tind->id;
                         
                          

                            if (! ($flag = $tindakan->save(false))) {

                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['tindakdokter', 'id' => $model->id]);

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
		$model = $this->findModel($id);
		
		$labora = new Lab();
		$resepdokter = new Resepdokter();
		
		if ($labora->load(Yii::$app->request->post())) {
			$labora->tanggal_req =  date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$labora->idtkp = $model->idjenisrawat;
			if($labora->save()){
			  
				 return $this->redirect(['rawatjalan/lab/'.$id]);
			}
			else
			{	
				return $this->render('lab', ['labora' => $labora,'model' => $this->findModel($id),'resepdokter'=>$resepdokter,]);
			}
			
		   
		} else {
			return $this->render('lab', ['labora' => $labora,'model' => $this->findModel($id),'resepdokter'=>$resepdokter,]);
		
		}
		
        return $this->render('lab', [
            'model' => $this->findModel($id),
            'tindakandokter' => $tindakandokter,
			'labora'=>$labora,
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
		$model->status = 3;
		$model->save();
		
		Yii::$app->session->setFlash('Pemeriksaan selesai', 'Sarahkan Pasien Ke bagian Pembayaran / Kasir');
		if($model->idjenisrawat == 3){
		return $this->redirect(['/rawatjalan/igd']);	
		}else if($model->idjenisrawat == 1){
			if($model->idpoli == 1){
			return $this->redirect(['/poli/poligigi']);	
			}else if($model->idpoli == 2){
			return $this->redirect(['/poli/polianak']);
			}else {
				return $this->redirect(['/rawatjalan/igd']);	
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
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
				
						  
				 return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	 public function actionIsikamar($id)
    {
        $model = $this->findModel($id);
		$kamar = Kamar::find()->where(['id' => $model->idruangan])->one();
		$model->tglmasuk = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
		$kamar->masuk++ ;
		$model->status = 8;
		$kamar->save();
		$model->save();
		
        return $this->redirect(['rawatjalan/previewpasien/'.$model->id]);
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
		$andWhere = ['idjenisrawat'=>3] ;
		$andWhere2 = ['status'=>1] ;
		$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere,$andWhere2);

        return $this->render('igd2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
	   'format' => [70,34],
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
	 
	public function actionFp($id) {
	  //tampilkan bukti proses
	  $rawatjalan = Rawatjalan::find()->where(['id' => $id])->one();
	  $model = Pasien::find()->where(['no_rekmed' =>$rawatjalan->no_rekmed ])->one();
	  $pekerjaan = Pekerjaan::find()->where(['idpasien' =>$rawatjalan->no_rekmed ])->one();
	  $content = $this->renderPartial('formpasien',['model' => $model,'rawatjalan' => $rawatjalan,'pekerjaan' => $pekerjaan,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
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
