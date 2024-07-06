<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Pasien;
use common\models\Rekamedis;
use common\models\RekamedisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RekamedisController implements the CRUD actions for Rekamedis model.
 */
class RekamedisController extends Controller
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
     * Lists all Rekamedis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RekamedisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rekamedis model.
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
     * Creates a new Rekamedis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rekamedis();

        if ($model->load(Yii::$app->request->post())) {
			$rj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->orderby(['tgldaftar'=>SORT_DESC])->groupby(['no_rekmed'])->one();
			$ps = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
			$ps->rmedis =$model->id;
			$model->idrawat = $rj->idrawat;
			$model->bulan = date('m',(strtotime($rj->tgldaftar)));
			if($model->save(false)){
				$ps->save(false);
				 return $this->redirect(['index']);
			}else{
				 return $this->render('create', [
					'model' => $model,
				]);
				
			}
           
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rekamedis model.
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
     * Deletes an existing Rekamedis model.
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
     * Finds the Rekamedis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rekamedis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rekamedis::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
