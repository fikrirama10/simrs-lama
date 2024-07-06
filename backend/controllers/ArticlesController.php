<?php

namespace backend\controllers;

use Yii;
use common\models\Articles;
use common\models\ArticlesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Articles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionCreate()
    {
        $model = new Articles();

        if($model->load(Yii::$app->request->post())){
			
			$image=UploadedFile::getInstance($model,'Picture');
			
			if (!$image == null) {
				$model->Picture=$image->name;
				$path = Yii::$app->params['imagePath'] .'/articles/'.$model->Picture; 
				$image->saveAs($path);
			}
			else{
				$model->Picture = '';
			}
			
			$model->UserId=0;
			$model->LastUpdate=date('Y-m-d h:i:s');
			$model->SEO=Yii::$app->algo->genSEO($model->Title);
									
			if($model->save()){
				return $this->redirect(['index']);
            } else {
                return $this->render('create', ['model' => $model,]);
            }
		
		}
		else 
		{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

   
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
			
			$image=UploadedFile::getInstance($model,'Picture');
						
			if (!$image == null) {
				$model->Picture=$image->name;
				$path = Yii::$app->params['imageNewsPath'] .'/'.$model->Picture; 
				$image->saveAs($path);
			}
			else{
				$model->Picture = $model::findOne($model->Id)->Picture;
			}
						
			
			//$model->Picture = $model::findOne($model->Id)->Picture;
			$model->UserId=0;
			$model->LastUpdate=date('Y-m-d h:i:s');
			$model->SEO=Yii::$app->algo->genSEO($model->Title);
						
			if( $model->save()){
				
                return $this->redirect(['index']);
            } else {
                return $this->render('create', ['model' => $model,]);
            }
		
		}
		else 
		{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionUnpublish($id)
    {
        $model = $this->findModel($id);
		//$model->IdPub=1;
		$model->save();
		return $this->redirect(['index']);
    }
	
	public function actionPublish($id)
    {
        $model = $this->findModel($id);
		//$model->IdPub=2;
		$model->save();
		return $this->redirect(['index']);
    }
}
