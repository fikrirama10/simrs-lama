<?php

namespace backend\controllers;

use Yii;
use common\models\Rencanaok;
use common\models\Rawatjalan;
use common\models\RencanaokSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RencanaokController implements the CRUD actions for Rencanaok model.
 */
class RencanaokController extends Controller
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
     * Lists all Rencanaok models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RencanaokSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rencanaok model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
		  $model->status = 2;
		   if( $model->save(false)){return $this->redirect(['/ok/rencanaok']);} else {return $this->render('view', ['model' => $model,]);}
		}

		else {
			return $this->render('view', ['model' => $model,]);
		
		}
    }

    /**
     * Creates a new Rencanaok model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Rencanaok();
		$rawat = $this->findRawat($id);
       if ($model->load(Yii::$app->request->post())){
			$model->iddokrer = $rawat->iddokter;
			$model->no_rekmed = $rawat->no_rekmed;
			$model->idrawat = $rawat->idrawat;
			$model->status = 1;
			$model->tanggalperiksa =  date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			if($model->save()){
				 return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
			}
			else
			{	
				return $this->render('create', ['model' => $model]);
			}
			
		   
		} else {
			return $this->render('create', ['model' => $model]);
		
		}
		
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rencanaok model.
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
     * Deletes an existing Rencanaok model.
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
     * Finds the Rencanaok model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rencanaok the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rencanaok::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	  protected function findRawat($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }}
