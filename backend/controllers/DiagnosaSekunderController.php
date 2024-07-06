<?php

namespace backend\controllers;

use Yii;
use common\models\PemeriksaanRajal;
use common\models\PemeriksaanIgd;
use common\models\PemeriksaanUgddiagsekunder;
use common\models\PemeriksaanUgddiagsekunderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DiagnosaSekunderController implements the CRUD actions for PemeriksaanUgddiagsekunder model.
 */
class DiagnosaSekunderController extends Controller
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
                    
                ],
            ],
        ];
    }

    /**
     * Lists all PemeriksaanUgddiagsekunder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PemeriksaanUgddiagsekunderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PemeriksaanUgddiagsekunder model.
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
     * Creates a new PemeriksaanUgddiagsekunder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
		$rawat = $this->findRawat($id);
        $model = new PemeriksaanUgddiagsekunder();

        if ($model->load(Yii::$app->request->post())) {
			$model->diagnosaprimer = $rawat->diagnosa;
			$model->idpemeriksaan = $rawat->id;
			$model->idrawat = $rawat->idrawat;
			
			if($model->save()){
				return $this->redirect(['create', 'id' => $rawat->id]);
			}else{
				return $this->render('create', [
					'model' => $model,
					'rawat' => $rawat,
				]);
			}
            
        }

        return $this->render('create', [
            'model' => $model,
            'rawat' => $rawat,
        ]);
    }
     public function actionCreateRajal($id)
    {
		$rawat = $this->findRawatJalan($id);
        $model = new PemeriksaanUgddiagsekunder();

        if ($model->load(Yii::$app->request->post())) {
			$model->diagnosaprimer = $rawat->diagnosa;
			$model->idpemeriksaan = $rawat->id;
			$model->idrawat = $rawat->idrawat;
			
			if($model->save()){
				return $this->redirect(['create', 'id' => $rawat->id]);
			}else{
				return $this->render('create-rajal', [
					'model' => $model,
					'rawat' => $rawat,
				]);
			}
            
        }

        return $this->render('create', [
            'model' => $model,
            'rawat' => $rawat,
        ]);
    }

    /**
     * Updates an existing PemeriksaanUgddiagsekunder model.
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
     * Deletes an existing PemeriksaanUgddiagsekunder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the PemeriksaanUgddiagsekunder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemeriksaanUgddiagsekunder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemeriksaanUgddiagsekunder::findOne($id)) !== null) {
            return $model;
        }


        throw new NotFoundHttpException('The requested page does not exist.');
    }
	    protected function findRawat($id)
    {
        if (($model = PemeriksaanIgd::findOne($id)) !== null) {
            return $model;
        }


        throw new NotFoundHttpException('The requested page does not exist.');
    }
       protected function findRawatJalan($id)
    {
        if (($model = PemeriksaanRajal::findOne($id)) !== null) {
            return $model;
        }


        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
