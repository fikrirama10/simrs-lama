<?php

namespace backend\controllers;

use Yii;
use common\models\Petugas;
use common\models\PetugasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PetugasController implements the CRUD actions for Petugas model.
 */
class PetugasController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Petugas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PetugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Petugas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Petugas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(Yii::$app->user->identity->idpriv > 2){
            throw new NotFoundHttpException('The requested page does not exist.');
		}
		
        $model = new User();
		$petugas = new Petugas();
		
        if ($model->load(Yii::$app->request->post()) 
			&& $petugas->load(Yii::$app->request->post())
			&& Model::validateMultiple([$petugas])) {
			
			// if ($model->validate()) {
								
				$petugas->genKode();
				$model->kode_petugas=$petugas->kode_petugas;
				$model->created=strtotime(date('Y-m-d h:i:s'));
				//$model->LastIP=$_SERVER['SERVER_ADDR'];
				$model->setPassword($model->password);
				$model->generateAuthKey();

				if($model->save(false)){
					$petugas->save(false);
					return $this->redirect(['index']);
				} else {
					return $this->render('create', ['model' => $model,'petugas' => $petugas,]);
				}
							
        } else {
			return $this->render('create', ['model' => $model,'petugas' => $petugas,]);
		}
    }

    /**
     * Updates an existing Petugas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Petugas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Petugas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Petugas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Petugas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
