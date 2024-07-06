<?php

namespace backend\controllers;

use Yii;
use common\models\Gagalfoto;
use common\models\GagalfotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GagalfotoController implements the CRUD actions for Gagalfoto model.
 */
class GagalfotoController extends Controller
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
     * Lists all Gagalfoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GagalfotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gagalfoto model.
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
     * Creates a new Gagalfoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gagalfoto();
		$post = Yii::$app->request->post();

        if($model->load(Yii::$app->request->post())){
			$postMo = $post['Gagalfoto'];
			$postJenis = $postMo['jenisfoto'];
		
			if($model->jenisfoto == '""' ){
			$model->jenisfoto = '';
			
			}else{
			$model->jenisfoto = json_encode($postJenis);
			
			}
			
				
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

    /**
     * Updates an existing Gagalfoto model.
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
     * Deletes an existing Gagalfoto model.
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
     * Finds the Gagalfoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gagalfoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gagalfoto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
