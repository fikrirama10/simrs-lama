<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\PemeriksaanRanap;
use common\models\PemeriksaanRanapSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PemeriksaanRanapController implements the CRUD actions for PemeriksaanRanap model.
 */
class PemeriksaanRanapController extends Controller
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
     * Lists all PemeriksaanRanap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PemeriksaanRanapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PemeriksaanRanap model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$rajal = Rawatjalan::find()->where(['id'=>$model->idrawat])->one();
		$post = Yii::$app->request->post();
		  if($model->load(Yii::$app->request->post())){
				$postMo = $post['PemeriksaanRanap'];
				$postTindakan = $postMo['tindakan'];
				$postObat = $postMo['obat'];
				$postLab = $postMo['lab'];
				$postRadiologi = $postMo['radiologi'];
			
				if($model->tindakan == '""' ){
				$model->tindakan = '';
				
				}else if($model->obat == '""' ){
				$model->obat = '';
				
				}else if($model->lab == '""' ){
					$model->lab='';
				}else if($model->radiologi == '""' ){
					$model->radiologi='';
				}
				else{
				$model->tindakan = json_encode($postTindakan);
				$model->obat = json_encode($postObat);
				$model->lab = json_encode($postLab);
				$model->radiologi = json_encode($postRadiologi);
				
				}
				//$rajal->status = 7;
				$model->status = 2;
				if($model->save(false)){
					$rajal->save(false);
					return $this->refresh();
				}
		  }
		
        return $this->render('view', [
            'model' => $model,
            'rajal' => $rajal,
        ]);
    }

    /**
     * Creates a new PemeriksaanRanap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new PemeriksaanRanap();
		$rajal = $this->findRajal($id);
        if ($model->load(Yii::$app->request->post())) {
			$model->idrawat = $rajal->id ;
			$model->tanggal = date('Y-m-d H:i:s',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))));
			if( $model->save(false)){
				 return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing PemeriksaanRanap model.
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
     * Deletes an existing PemeriksaanRanap model.
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
     * Finds the PemeriksaanRanap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemeriksaanRanap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemeriksaanRanap::findOne($id)) !== null) {
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
