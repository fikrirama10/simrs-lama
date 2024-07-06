<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Rujukan;
use common\models\Pasien;
use common\models\RujukanSearch;
use yii\web\Controller;
use kartik\mpdf\Pdf;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RujukanController implements the CRUD actions for Rujukan model.
 */
class RujukanController extends Controller
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
    /**
     * Lists all Rujukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RujukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
    /**
     * Displays a single Rujukan model.
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
     * Creates a new Rujukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rujukan();
		$dataTemplate = Rawatjalan::find()->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')])->all();
        if ($model->load(Yii::$app->request->post())) {
			$pf = date('mY-',strtotime(($model->tanggal)));
			$model->genKode($pf);
			$bln = date('n',strtotime(($model->tanggal)));
			$model->bln = $model->getRomawi($bln);
			if($model->save(false)){
            return $this->redirect('index');
			}else{
			return $this->render('create', [
            'model' => $model,
			'dataTemplate'=> $dataTemplate,
        ]);	
			}
        }

        return $this->render('create', [
            'model' => $model,
			'dataTemplate'=> $dataTemplate,
        ]);
    }
		 public function actionPrint($id) {
	  //tampilkan bukti proses
	  $model = Rujukan::find()->where(['id' => $id])->one();
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
     * Updates an existing Rujukan model.
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
     * Deletes an existing Rujukan model.
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
     * Finds the Rujukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rujukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rujukan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
