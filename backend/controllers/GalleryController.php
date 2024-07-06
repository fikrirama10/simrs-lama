<?php

namespace backend\controllers;

use Yii;
use common\models\Gallery;
use common\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
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
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
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
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
 public function actionCreate()
    {
        $model = new Gallery();

        if($model->load(Yii::$app->request->post())){
            
            $image=UploadedFile::getInstance($model,'gambar');
            if (!$image == null) {
                $model->gambar=$image->name;
                $path = Yii::$app->params['imagePath'] .'/gallery/'.$model->gambar;
                
                //create thumbnail
                if($image->saveAs($path)){
                    Image::thumbnail($path, 300, 120)->save(Yii::getAlias(Yii::$app->params['imagePath'] .'/gallery/thumbnail/'.$model->gambar), ['quality' => 80]);
                }
            }
            else{
                $model->gambar='';
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
     * Updates an existing Galery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imgold=Yii::$app->params['imagePath'] .'/galery/'.$model->Image;
        $tbold=Yii::$app->params['imagePath'] .'/galery/thumbnail/'.$model->Image;
        

        if($model->load(Yii::$app->request->post())){
             
            $image=UploadedFile::getInstance($model,'Image');
            
            if (!$image == null) {
                $model->Image=$image->name;
                $path = Yii::$app->params['imagePath'] .'/galery/'.$model->Image;
                
                //create thumbnail
                if($image->saveAs($path)){
                    Image::thumbnail($path, 360, 180)->save(Yii::getAlias(Yii::$app->params['imagePath'] .'/galery/thumbnail/'.$model->Image), ['quality' => 80]);
                    unlink($imgold);
                    unlink($tbold);
                }
                
                }
            else{
                $model->Image=$model::findOne($model->Id)->Image;
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
     * Deletes an existing Gallery model.
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
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
