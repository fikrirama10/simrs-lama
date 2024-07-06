<?php

namespace frontend\controllers;

use Yii;
use common\models\Pengaduan;
use yii\web\UploadedFile;
use common\models\PengaduanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PengaduanController implements the CRUD actions for Pengaduan model.
 */
class PengaduanController extends Controller
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
     * Lists all Pengaduan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PengaduanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model = new Pengaduan();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Pengaduan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
  
    public function actionCreate()
    {
        $model = new Pengaduan();

        if ($model->load(Yii::$app->request->post())) {
			$image=UploadedFile::getInstance($model,'foto');
			
			if (!$image == null) {
				$model->foto=$image->name;
				$path = Yii::$app->params['imagePath'] .'/pengaduan/'.$model->foto; 
				$image->saveAs($path);
			}
			else{
				$model->foto = '';
			}
			$model->tgl=date('Y-m-d h:i:s');
			$model->genKode();
									
			if($model->save()){
				return $this->redirect(['index']);
            } else {
                return $this->render('create', ['model' => $model,]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

       else 
		{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pengaduan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
  
    /**
     * Deletes an existing Pengaduan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id)
    // {
        // $this->findModel($id)->delete();

        // return $this->redirect(['index']);
    // }

    /**
     * Finds the Pengaduan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengaduan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengaduan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
