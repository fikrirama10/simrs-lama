<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TindakandokterController implements the CRUD actions for Tindakandokter model.
 */
class KeperawatanController extends Controller
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
     * Lists all Tindakandokter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RawatjalanSearch();
		$where = ['status'=>8] ;
		$andwhere = ['idjenisrawat'=>2] ;
		//$orderBy = ['idruangan'=>SORT_ASC];
		//$groupBy = ['idrawat'] ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andwhere);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionRiwayat()
    {
        $searchModel = new RawatjalanSearch();
		$where = ['status'=>7] ;
		$andwhere = ['idjenisrawat'=>2] ;
		//$orderBy = ['idruangan'=>SORT_ASC];
		//$groupBy = ['idrawat'] ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andwhere);

        return $this->render('riwayat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 public function actionDiagnosa()
    {
       
        return $this->render('diagnosa');
    }

    /**
     * Displays a single Tindakandokter model.
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
     * Creates a new Tindakandokter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tindakandokter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tindakandokter model.
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
     * Deletes an existing Tindakandokter model.
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
     * Finds the Tindakandokter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tindakandokter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
