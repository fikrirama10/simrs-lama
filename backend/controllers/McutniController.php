<?php

namespace backend\controllers;

use Yii;
use common\models\Mcutni;
use common\models\Revmcu;
use kartik\mpdf\Pdf;
use common\models\McutniSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * McutniController implements the CRUD actions for Mcutni model.
 */
class McutniController extends Controller
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
     * Lists all Mcutni models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new McutniSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mcutni model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$revmcu = New Revmcu();
		$model = $this->findModel($id);
		 if ($revmcu->load(Yii::$app->request->post()) && $revmcu->save()) {
            return $this->redirect('index');
        }
        return $this->render('view', [
            'model' => $model,
            'revmcu' => $revmcu,
        ]);
    }

    /**
     * Creates a new Mcutni model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mcutni();

        if ($model->load(Yii::$app->request->post())) {
			$model->status = 1;
			if($model->save()){
			
            return $this->redirect('index');
			}else{
			  return $this->render('create', [
				'model' => $model,
				]);	
			}
        }
		 return $this->render('create', [
				'model' => $model,
				]);	

      
    }

    /**
     * Updates an existing Mcutni model.
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
	public function actionPrinttni() {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	 $model = Mcutni::find()->where(['status'=> 1])->all();
	  $content = $this->renderPartial('formtni', ['model'=>$model]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10',
		'marginRight' => '10',
		'marginLeft' => '10',
		'marginBottom' => '15',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/papertni.css',
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
     	public function actionPrinttniId($id) {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	 $model = Mcutni::find()->where(['id'=> $id])->all();
	  $content = $this->renderPartial('formtni', ['model'=>$model]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10',
		'marginRight' => '10',
		'marginLeft' => '10',
		'marginBottom' => '15',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/papertni.css',
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
	 public function actionPrinttni2() {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	  $content = $this->renderPartial('formtni2');
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10',
		'marginRight' => '10',
		'marginLeft' => '10',
		'marginBottom' => '15',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/papertni.css',
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
	 public function actionPrinttni3() {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	  $content = $this->renderPartial('formtni3');
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10 mm',
		'marginRight' => '10 mm',
		'marginLeft' => '10 mm',
		'marginBottom' => '15 mm',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/papertni.css',
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
	 public function actionPrinttni4() {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	  $content = $this->renderPartial('formtni4');
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10 mm',
		'marginRight' => '10 mm',
		'marginLeft' => '10 mm',
		'marginBottom' => '15 mm',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/papertni.css',
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
	 public function actionPrinttni5() {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	  $content = $this->renderPartial('formtni5');
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10 mm',
		'marginRight' => '10 mm',
		'marginLeft' => '10 mm',
		'marginBottom' => '15 mm',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/papertni.css',
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
	  public function actionPrinttni6() {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	  $content = $this->renderPartial('formtni6');
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		   'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
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
	 public function actionPrinttni7() {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	  $content = $this->renderPartial('form7');
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10 mm',
		'marginRight' => '10 mm',
		'marginLeft' => '10 mm',
		'marginBottom' => '15 mm',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/papertni.css',
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
     * Deletes an existing Mcutni model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mcutni model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mcutni the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mcutni::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
