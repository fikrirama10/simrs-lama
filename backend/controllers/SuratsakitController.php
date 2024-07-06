<?php

namespace backend\controllers;

use Yii;
use kartik\mpdf\Pdf;
use common\models\Suratsakit;
use common\models\Rawatjalan;
use common\models\Pasien;
use common\models\SuratsakitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuratsakitController implements the CRUD actions for Suratsakit model.
 */
class SuratsakitController extends Controller
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
     * Lists all Suratsakit models.
     * @return mixed
     */
	public function actionGetDataPasien()
    {
		$kode = Yii::$app->request->post('id');
		if($kode){
			$model = Pasien::find()->where(['no_rekmed'=>$kode])->one();

		}else{
			$model = "";
		}
		return \yii\helpers\Json::encode($model);
    }
	 public function actionGetsb($barang='')
    {
		
			$dataTemplate = Rawatjalan::find()->andWhere(['no_rekmed' => $barang])->all();
		
        
		return $this->renderAjax('_dataTemplate', [
            'dataTemplate' => $dataTemplate,
        ]);
    }
    public function actionIndex()
    {
        $searchModel = new SuratsakitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Suratsakit model.
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

    /**
     * Creates a new Suratsakit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   public function actionCreate()
    {
        $model = new Suratsakit();
		$lima = date('Y-m-d',strtotime('-5 day',strtotime(date('Y-m-d'))));
		$dataTemplate = Rawatjalan::find()->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $lima, date('Y-m-d')])->all();
        if ($model->load(Yii::$app->request->post())) {
			$pf = date('mY-',strtotime(($model->tanggal)));
			$model->genKode($pf);
			$bln = date('n',strtotime(($model->tanggal)));
			$model->bulan = $model->getRomawi($bln);
			if($model->save(false)){
            return $this->redirect('index');
			}else{
			return $this->render('create', [
            'model' => $model,
			'lima' => $lima,
			'dataTemplate'=> $dataTemplate,
        ]);	
			}
        }

        return $this->render('create', [
            'model' => $model,
            'lima' => $lima,
			'dataTemplate'=> $dataTemplate,
        ]);
    }
	 public function actionPrint($id) {
	  //tampilkan bukti proses
	  $model = Suratsakit::find()->where(['id' => $id])->one();
	  $content = $this->renderPartial('label',['model' => $model,]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => [70,34],
	   'marginTop' => '1',
	   'orientation' => Pdf::ORIENT_PORTRAIT, 
	   'marginLeft' => '3',
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

    /**
     * Updates an existing Suratsakit model.
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
     * Deletes an existing Suratsakit model.
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
     * Finds the Suratsakit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Suratsakit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Suratsakit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
