<?php

namespace backend\controllers;

use Yii;
use common\models\Orderlab;
use common\models\Lab;
use common\models\OrderlabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
/**
 * OrderlabController implements the CRUD actions for Orderlab model.
 */
class OrderlabController extends Controller
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
     * Lists all Orderlab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderlabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTambahPemeriksaan($id){
		$model = $this->findModel($id);
		$lab = new Lab();
		if ($lab->load(Yii::$app->request->post())) {
			$lab->kodelab = $model->kodelab ;
			$lab->tanggal_req = $model->tgl_order;
			$lab->status = 0;
			//$lab->idpemeriksa = 
			if($lab->save(false)){
				return $this->refresh();
			}else{
				return $this->render('add-pemeriksaan',[
					'model'=>$model,
					'lab'=>$lab,
				]);
			}
			
        }
		return $this->render('add-pemeriksaan',[
			'model'=>$model,
			'lab'=>$lab,
		]);
	}
    /**
     * Displays a single Orderlab model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Creates a new Orderlab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orderlab();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orderlab model.
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
    public function actionPrintlab2($id) {
         $pemriklab = Orderlab::find()->where(['id' => $id])->one();
	     return  $this->render('formlab',['pemriklab' => $pemriklab,]);
    }
	public function actionPrintlab($id) {
      //tampilkan bukti proses
      $pemriklab = Orderlab::find()->where(['id' => $id])->one();
	  $content = $this->renderPartial('formlab',['pemriklab' => $pemriklab,]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
       'format' => Pdf::FORMAT_LEGAL, 
       'content' => $content,  
       'cssFile' => '@frontend/web/css/paper.css',
	   'marginBottom' => '30',
       'methods' => [ 
          //  'SetFooter'=>['RSAU LANUD SULAIMAN ,'.$pemriklab->tgl_order],
        ]
       //'options' => ['title' => 'Bukti Permohonan Informasi'],
       ]);
         $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_RAW;
            $headers = Yii::$app->response->headers;
            $headers->add('Content-Type', 'application/pdf');
      
      // return the pdf output as per the destination setting
      return $pdf->render(); 
     }

	  public function actionKatalog(){
      //tampilkan bukti proses
	  $content = $this->renderPartial('katalog');
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
       'format' => Pdf::FORMAT_LEGAL, 
       'content' => $content,  
       'cssFile' => '@frontend/web/css/paper.css',
	   'marginBottom' => '30',
       'methods' => [ 
          //  'SetFooter'=>['RSAU LANUD SULAIMAN ,'.$pemriklab->tgl_order],
        ]
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
     * Deletes an existing Orderlab model.
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
	
	 public function actionHapus($id)
    {
        $this->findLab($id)->delete();

		return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Orderlab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orderlab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orderlab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	 protected function findLab($id)
    {
        if (($model = Lab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
