<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\PemeriksaanawalRanap;
use common\models\PemeriksaanawalRanapSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AwalRanapController implements the CRUD actions for PemeriksaanawalRanap model.
 */
class AwalRanapController extends Controller
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
     * Lists all PemeriksaanawalRanap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PemeriksaanawalRanapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PemeriksaanawalRanap model.
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
     * Creates a new PemeriksaanawalRanap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {      
        $model = new PemeriksaanawalRanap();
		$rajal = $this->findRajal($id);
        if ($model->load(Yii::$app->request->post())) {
			$model->idrawat = $rajal->id ;
			$model->dokterpengirim = $rajal->iddokter ;
			//$model->tanggal = date('Y-m-d H:i:s',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))));
			if( $model->save(false)){
				 return $this->redirect(['rawatinap/view/'.$rajal->id]);
			}else{
				return $this->render('create', [
					'model' => $model,
					'rajal' => $rajal,
				]);	
			}
            
        }

        return $this->render('create', [
            'model' => $model,
            'rajal' => $rajal,
        ]);
    }
    

    /**
     * Updates an existing PemeriksaanawalRanap model.
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
     * Deletes an existing PemeriksaanawalRanap model.
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
     * Finds the PemeriksaanawalRanap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemeriksaanawalRanap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemeriksaanawalRanap::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function findRajal($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
