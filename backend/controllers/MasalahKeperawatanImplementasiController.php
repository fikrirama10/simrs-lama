<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Rencanaasuhan;
use common\models\MasalahKeperawatanImplementasi;
use common\models\MasalahKeperawatanImplementasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasalahKeperawatanImplementasiController implements the CRUD actions for MasalahKeperawatanImplementasi model.
 */
class MasalahKeperawatanImplementasiController extends Controller
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
     * Lists all MasalahKeperawatanImplementasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MasalahKeperawatanImplementasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MasalahKeperawatanImplementasi model.
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
     * Creates a new MasalahKeperawatanImplementasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
		$rawat = Rawatjalan::findOne($id);
        $model = new MasalahKeperawatanImplementasi();

        if ($model->load(Yii::$app->request->post())) {
			$model->idrawat = $rawat->id;
			$model->tanggal = date('Y-m-d',strtotime('+5 hour',strtotime(date('Y-m-d'))));
			//$model->jam = date('H:i:s',strtotime('+5 hour',strtotime(date('H:i:s'))));
			$model->iduser = Yii::$app->user->identity->id;
			if($model->idintervensi > 0){
				$masalah = Rencanaasuhan::findOne($model->idintervensi);
				$model->implementasi = $masalah->rencanaasuhan;
			}
			if($model->save(false)){
				 return $this->redirect(['create', 'id' => $rawat->id]);
			}
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'rawat' => $rawat,
        ]);
    }

    /**
     * Updates an existing MasalahKeperawatanImplementasi model.
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
     * Deletes an existing MasalahKeperawatanImplementasi model.
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
     * Finds the MasalahKeperawatanImplementasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasalahKeperawatanImplementasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasalahKeperawatanImplementasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
