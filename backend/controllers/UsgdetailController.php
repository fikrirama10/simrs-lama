<?php

namespace backend\controllers;

use Yii;
use kartik\mpdf\Pdf;
use common\models\Usgdetail;
use common\models\Usg;
use common\models\Temusg;
use common\models\UsgdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsgdetailController implements the CRUD actions for Usgdetail model.
 */
class UsgdetailController extends Controller
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
     * Lists all Usgdetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsgdetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usgdetail model.
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
     * Creates a new Usgdetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Usgdetail();
        $dataTemplate = Temusg::find()->all();
        $usg = Usg::find()->where(['id'=>$id])->one();

        if ($model->load(Yii::$app->request->post())) {
			$model->tgl = date('Y-m-d');
			$model->status= 1;
			if($model->save(false)){
            return $this->redirect(['usg/view', 'id' => $usg->id]);
			}else{
				 return $this->render('create', [
            'model' => $model,
            'usg' => $usg,
            'dataTemplate' => $dataTemplate,
        ]);
			}
        }

        return $this->render('create', [
            'model' => $model,
            'usg' => $usg,
            'dataTemplate' => $dataTemplate,
        ]);
    }
	public function actionGetDataTemplate()
    {
		$kode = Yii::$app->request->post('id');
		if($kode){
			$model = Temusg::find()->where(['id'=>$kode])->one();
		}else{
			$model = "";
		}
		return \yii\helpers\Json::encode($model);
    }
	public function actionFp($id) {
	  //tampilkan bukti proses
	  $rawatjalan = Usgdetail::find()->where(['id' => $id])->one();
	  $pemriklab = Usg::find()->where(['idusg'=>$rawatjalan->idusg])->one();
	 
	  $content = $this->renderPartial('coba',['rawatjalan' => $rawatjalan,'pemriklab' => $pemriklab]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_PORTRAIT, 
	  
	   'marginRight' => 5,
	   'marginLeft' => 6,
	   'marginBottom' => 3,
	   'marginTop' => 10,
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
     * Updates an existing Usgdetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       $dataTemplate = Temusg::find()->all();
        $usg = Usg::find()->where(['idusg'=>$model->idusg])->one();

        if ($model->load(Yii::$app->request->post())) {
			$model->tgl = date('Y-m-d');
			$model->status= 1;
			if($model->save(false)){
            return $this->redirect(['usg/view', 'id' => $usg->id]);
			}else{
				 return $this->render('update', [
            'model' => $model,
            'usg' => $usg,
            'dataTemplate' => $dataTemplate,
        ]);
			}
        }
		 return $this->render('update', [
            'model' => $model,
            'usg' => $usg,
            'dataTemplate' => $dataTemplate,
        ]);
    }

    /**
     * Deletes an existing Usgdetail model.
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
     * Finds the Usgdetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usgdetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usgdetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
