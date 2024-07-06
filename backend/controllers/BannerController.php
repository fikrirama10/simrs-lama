<?php

namespace backend\controllers;

use Yii;
use common\models\Banner;
use common\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
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
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       
        $model = new Banner();

        if($model->load(Yii::$app->request->post())){
			$image=UploadedFile::getInstance($model,'gambar');
			$model->gambar=$image->name;
			$path = Yii::$app->params['imagePath'].'/banner/'.$model->gambar;
			if( $image->saveAs($path)){
                $model->save();
               return $this->redirect(['index']);
            } else {
                return $this->render('create', ['model' => $model,]);
            }
		}
		else{
			return $this->render('create', ['model' => $model,]);
		}
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$imageold=Yii::$app->params['imagePath'] .'/banner/'.$model->gambar;
		
        if($model->load(Yii::$app->request->post())){
			
			$image=UploadedFile::getInstance($model,'gambar');
			
			if (!$image == null) {
				$model->gambar=$image->name;
				$path = Yii::$app->params['imagePath'] .'/banner/'.$model->gambar;
				$image->saveAs($path);
				unlink($imageold);
				}
			else{
				$model->gambar = $this->findModel($id)->gambar;
			}
									
			if( $model->save()){
                return $this->redirect(['index']);
            } else {
                return $this->render('create', ['model' => $model,]);
            }
		}
		else{
			return $this->render('create', ['model' => $model,]);
		}
    }

    /**
     * Deletes an existing Banner model.
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
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
