<?php

namespace backend\controllers;

use Yii;
use common\models\RikkesRadiologi;
use common\models\RikkesRadiologiSearch;
use common\models\RikkesRadiologiDetailSearch;
use common\models\RikkesRadiologiDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use yii\filters\VerbFilter;

/**
 * RikkesRadiologiController implements the CRUD actions for RikkesRadiologi model.
 */
class RikkesRadiologiController extends Controller
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
     * Lists all RikkesRadiologi models.
     * @return mixed
     */
	 public function actionHapus($id)
    {
        $this->findDetail($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionIndex()
    {
        $searchModel = new RikkesRadiologiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RikkesRadiologi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEdit($id){
		$model = $this->findDetail($id);
		 if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrikes]);
        }
		return $this->render('edit',[
			'model'=>$model,
		]);
	}
    public function actionView($id)
    {
		$searchModel = new RikkesRadiologiDetailSearch();
		$model = $this->findModel($id);
		$rikes = new RikkesRadiologiDetail();;
		$where = ['idrikes'=>$model->id];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
		if($rikes->load(Yii::$app->request->post())){
			if($rikes->save(false)){
				return $this->refresh();
			}else{
				 return $this->render('view', [
					'model' => $model,
					'searchModel' => $searchModel,
					'dataProvider' => $dataProvider,
					'rikes' => $rikes,
				]);
			}
		}
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'rikes' => $rikes,
        ]);
    }
	 public function actionLabel($id) {
	  //tampilkan bukti proses
	  $rik = RikkesRadiologi::find()->where(['id' => $id])->one();
	  $pemriklab = RikkesRadiologiDetail::find()->where(['idrikes' => $rik->id])->all();
	  $content = $this->renderPartial('label',['pemriklab' => $pemriklab,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => [70,36],
	   'marginTop' => '1',
	   'orientation' => Pdf::ORIENT_PORTRAIT, 
	   'marginLeft' => '10',
	   'marginRight' => '4',
	   'marginBottom' => '1',
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
    public function actionPrinttni($id) {
      //tampilkan bukti proses
     // $pemriklab = Radmcu::find()->all();
	 $model = RikkesRadiologi::find()->where(['id'=> $id])->one();
	 $rikes = RikkesRadiologiDetail::find()->where(['idrikes'=> $model->id])->orderBy(['kualifikasi'=>'SORT_ASC'])->all();
	  $content = $this->renderPartial('formtni', ['model'=>$model,'rikes'=>$rikes]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [148,210],
		'marginTop' => '10',
		'marginRight' => '10',
		'marginLeft' => '10',
		'marginBottom' => '5',
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
     * Creates a new RikkesRadiologi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RikkesRadiologi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RikkesRadiologi model.
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

    /**
     * Deletes an existing RikkesRadiologi model.
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
     * Finds the RikkesRadiologi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RikkesRadiologi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RikkesRadiologi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function findDetail($id)
    {
        if (($model = RikkesRadiologiDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

