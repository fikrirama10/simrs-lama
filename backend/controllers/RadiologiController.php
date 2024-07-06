<?php

namespace backend\controllers;
use kartik\mpdf\Pdf;
use Yii;
use common\models\Radiologi;
use common\models\RadmcuSearch;
use common\models\Radmcu;
use common\models\Rawatjalan;
use common\models\Radtemplate;
use common\models\Pasien;
use common\models\Radiologidetail;
use common\models\RadiologiSearch;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RadiologiController implements the CRUD actions for Radiologi model.
 */
class RadiologiController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Radiologi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RadiologiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
  public function actionIndexmcu()
    {
        $searchModel = new RadmcuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexmcu', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionLabel($id) {
	  //tampilkan bukti proses
	  $pemriklab = Radiologidetail::find()->where(['id' => $id])->one();
	  $content = $this->renderPartial('label',['pemriklab' => $pemriklab,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => [70,36],
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
	 public function actionLabelMcu($id) {
	  //tampilkan bukti proses
	  $pemriklab = Radmcu::find()->where(['id' => $id])->one();
	  $content = $this->renderPartial('label-mcu',['pemriklab' => $pemriklab,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => [70,36],
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
    /**
     * Displays a single Radiologi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	 public function actionListrad()
    {

        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listrad', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionShowAll($id){
		
		$norm =$id;
		 $radid = new Radiologi;
		   $raddetail = [new Radiologidetail];
		$pasien = Pasien::find()->where(['no_rekmed'=>$norm])->one();
		$pasienc = Pasien::find()->where(['no_rekmed'=>$norm])->count();
		if($pasien == null ){
		\Yii::$app->getSession()->setFlash('danger', 'Data Tidak Di Temukan');
		   return $this->renderAjax('_showAll', [
				'pasien'=>$pasien,
				'pasienc'=>$pasienc,
				 'radid'=>$radid,
				 'raddetail'=>$raddetail,
			]);
		}
		\Yii::$app->getSession()->setFlash('success', 'Data  Di Temukan');
		return $this->renderAjax('_showAll', [
            'pasien'=>$pasien,
			'pasienc'=>$pasienc,
            'radid'=>$radid,
            'raddetail'=>$raddetail,
        ]);
		
		

	}
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	  public function actionLaphar()
    {
        return $this->render('laphar');
    }
	public function actionViewmcu($id)
    {
        return $this->render('viewmcu', [
            'model' => $this->findMcu($id),
        ]);
    }

    /**
     * Creates a new Radiologi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
     {

        $radid = new Radiologi;
        $raddetail = [new Radiologidetail];


        if ($radid->load(Yii::$app->request->post())) {


            $raddetail = Model::createMultiple(Radiologidetail::classname());

            Model::loadMultiple($raddetail, Yii::$app->request->post());


            // validate all models

            $valid = $radid->validate();

            $valid = Model::validateMultiple($raddetail) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
				//$radid->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));

                try {

                    if ($flag = $radid->save(false)) {

                        foreach ($raddetail as $raddetail) {
							$raddetail->idrad = $radid->idrad;
							$raddetail->waktu = $radid->tanggal;
                            if (! ($flag = $raddetail->save(false))) {

                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['/radiologi']);

                    }

                } catch (Exception $e) {

                    $transaction->rollBack();

                }

            }

        }
		 return $this->render('create', [

            'radid' => $radid,
            'raddetail'=>$raddetail,
            'raddetail' => (empty($raddetail)) ? [new Radiologidetail] : $raddetail

        ]);

    }
	 public function actionOrder($id)
     {

        $radid = new Radiologi;
        $raddetail = [new Radiologidetail];
		$model = $this->findRj($id);

        if ($radid->load(Yii::$app->request->post())) {


            $raddetail = Model::createMultiple(Radiologidetail::classname());

            Model::loadMultiple($raddetail, Yii::$app->request->post());


            // validate all models

            $valid = $radid->validate();

            $valid = Model::validateMultiple($raddetail) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
				//$radid->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));

                try {

                    if ($flag = $radid->save(false)) {

                        foreach ($raddetail as $raddetail) {
							$raddetail->idrad = $radid->idrad;
							$raddetail->waktu = $radid->tanggal;
                            if (! ($flag = $raddetail->save(false))) {

                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['/radiologi']);

                    }

                } catch (Exception $e) {

                    $transaction->rollBack();

                }

            }

        }
		 return $this->render('order', [

            'radid' => $radid,
            'model' => $model,
            'raddetail'=>$raddetail,
            'raddetail' => (empty($raddetail)) ? [new Radiologidetail] : $raddetail

        ]);

    }


    /**
     * Updates an existing Radiologi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	public function actionPerikrad($id)
    {
        $model = $this->findDetail($id);
        $template = new Radtemplate;
		$radio = Radiologi::find()->where(['idrad'=>$model->idrad])->one();
		$dataBarang = Radiologidetail::find()->all();
		$dataTemplate = Radtemplate::find()->all();
		if ($model->load(Yii::$app->request->post())) {
			$model->idpemeriksa = $radio->idpemeriksa;
			$model->status = 1;
			$waktu =  date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			if($model->save(false)){
					if($model->tem == 1){
					$template->kesan = $model->kesan;	
					$template->klinis = $model->klinis;	
					$template->hasil = $model->hasil;
					$template->save(false);
					}
					return $this->redirect(['view', 'id' => $radio->id]);
				}
			
			else
			{	
				return $this->render('perikrad', ['model' => $model,'dataBarang'=>$dataBarang,'dataTemplate'=>$dataTemplate]);
			}
			
		   
		} else {
			return $this->render('perikrad', [ 'model'=>$model,'dataBarang'=>$dataBarang,'dataTemplate'=>$dataTemplate]);
		
	}
	}
	public function actionPerikradmcu()
    {
        $model = new Radmcu;
        $template = new Radtemplate;
		$dataBarang = Radiologidetail::find()->all();
		$dataTemplate = Radtemplate::find()->all();
		if ($model->load(Yii::$app->request->post())) {
			$model->status = 0;
			if($model->save(false)){
					return $this->redirect(['viewmcu', 'id' => $model->id]);
				}
			
			else
			{	
				return $this->render('perikradmcu', ['model' => $model,'dataBarang'=>$dataBarang,'dataTemplate'=>$dataTemplate]);
			}
			
		   
		} else {
			return $this->render('perikradmcu', [ 'model'=>$model,'dataBarang'=>$dataBarang,'dataTemplate'=>$dataTemplate]);
		
	}
	}
	public function actionPerikraupdate($id)
    {
        $model = Radmcu::find()->where(['id'=>$id])->one();
        $template = new Radtemplate;
		$dataBarang = Radiologidetail::find()->all();
		$dataTemplate = Radtemplate::find()->all();
		if ($model->load(Yii::$app->request->post())) {
			$model->status = 1;
			if($model->save(false)){
					return $this->redirect(['viewmcu', 'id' => $model->id]);
				}
			
			else
			{	
				return $this->render('perikradmcuupdate', ['model' => $model,'dataBarang'=>$dataBarang,'dataTemplate'=>$dataTemplate]);
			}
			
		   
		} else {
			return $this->render('perikradmcuupdate', [ 'model'=>$model,'dataBarang'=>$dataBarang,'dataTemplate'=>$dataTemplate]);
		
	}
	}
	    public function actionGetDataBarang()
    {
		$kode = Yii::$app->request->post('id');
		if($kode){
			$model = Radiologidetail::find()->where(['id'=>$kode])->one();
		}else{
			$model = "";
		}
		return \yii\helpers\Json::encode($model);
    }
	  public function actionGetDataTemplate()
    {
		$kode = Yii::$app->request->post('id');
		if($kode){
			$model = Radtemplate::find()->where(['id'=>$kode])->one();
		}else{
			$model = "";
		}
		return \yii\helpers\Json::encode($model);
    }

	public function actionPrintrad($id) {
      //tampilkan bukti proses
      $pemriklab = Radiologidetail::find()->where(['id' => $id])->one();
	  $content = $this->renderPartial('formrad',['pemriklab' => $pemriklab,]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10',
		'marginRight' => '2',
		'marginLeft' => '10',
		'marginBottom' => '5',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/paper.css',
       // 'methods' => [ 
            // 'SetFooter'=>['RSAU dr. NORMAN T.LUBIS ,'],
        // ]
       //'options' => ['title' => 'Bukti Permohonan Informasi'],
       ]);
         $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_RAW;
            $headers = Yii::$app->response->headers;
            $headers->add('Content-Type', 'application/pdf');
      
      // return the pdf output as per the destination setting
      return $pdf->render(); 
     }
	 public function actionPrintrad2($id) {
      //tampilkan bukti proses
	  $model = Radiologi::find()->where(['id'=>$id])->one();
      $periklab = Radiologidetail::find()->where(['idrad' => $model->idrad])->all();
	  $content = $this->renderPartial('formrad2',['periklab' => $periklab,'model'=>$model]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => Pdf::FORMAT_A4,
		'marginTop' => '7',
		'marginRight' => '5',
		'marginLeft' => '5',
		'marginBottom' => '5',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/paper.css',
       // 'methods' => [ 
            // 'SetFooter'=>['RSAU dr. NORMAN T.LUBIS ,'],
        // ]
       //'options' => ['title' => 'Bukti Permohonan Informasi'],
       ]);
         $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_RAW;
            $headers = Yii::$app->response->headers;
            $headers->add('Content-Type', 'application/pdf');
      
      // return the pdf output as per the destination setting
      return $pdf->render(); 
     }
	
	public function actionPrintmcu($id) {
      //tampilkan bukti proses
      $pemriklab = Radmcu::find()->where(['id' => $id])->one();
	  $content = $this->renderPartial('formmcu',['pemriklab' => $pemriklab,]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '7',
		'marginRight' => '2',
		'marginLeft' => '10',
		'marginBottom' => '5',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/paper.css',
       // 'methods' => [ 
            // 'SetFooter'=>['RSAU dr. NORMAN T.LUBIS ,'],
        // ]
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
     * Deletes an existing Radiologi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id); 

		$model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Radiologi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Radiologi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Radiologi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	 protected function findRj($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	 protected function findDetail($id)
    {
        if (($model = Radiologidetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function findMcu($id)
    {
        if (($model = Radmcu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
