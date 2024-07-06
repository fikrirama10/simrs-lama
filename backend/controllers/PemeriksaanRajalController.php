<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\PemeriksaanRajal;
use common\models\Tindakan;
use common\models\PemeriksaanRajalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PemeriksaanRajalController implements the CRUD actions for PemeriksaanRajal model.
 */
class PemeriksaanRajalController extends Controller
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
     * Lists all PemeriksaanRajal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PemeriksaanRajalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PemeriksaanRajal model.
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
				$postMo = $post['PemeriksaanRajal'];
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
				$rajal->status = 7;
				
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
     * Creates a new PemeriksaanRajal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionListPengobatan($id)
	  {
		$models=Tindakan::find()->where(['golongan' => $id])->orderBy('namatindakan')->all();
		
		foreach($models as $k){
		  echo "<option value='".$k->id."'>".$k->namatindakan."</option>";
		}
	  }
    public function actionCreate($id)
    {
        $model = new PemeriksaanRajal();
		$rajal = $this->findRajal($id);
		if($rajal->total == 1){
			return $this->redirect(['index']);
		}
        if ($model->load(Yii::$app->request->post())) {
			$rajal->kdiagnosa = $model->diagnosa;
			$model->iddokter = $rajal->iddokter;
			$model->idpoli = $rajal->idpoli;
			$rajal->katgigi = $model->katgigi;
			$rajal->katpenyakitmulut = $model->katpenyakitmulut;
			$rajal->macampenyakitmulut = $model->macampenyakitmulut;
			$model->tanggal = date('Y-m-d h:i:s',strtotime('+6 hour',strtotime(date('Y-m-d h:i:s'))));
			$rajal->jampemeriksaan = date('Y-m-d h:i:s',strtotime('+6 hour',strtotime(date('Y-m-d h:i:s'))));
			$model->status = 1;
			$rajal->status = 2;
			$rajal->total = 1;
			$model->idrawat = $rajal->id;
			if($model->save(false)){
				$rajal->save(false);
				return $this->redirect(['view', 'id' => $model->id]);
			}else{
				return $this->refresh();
			}
           // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'rajal' => $rajal,
        ]);
    }

    /**
     * Updates an existing PemeriksaanRajal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $rajal = Rawatjalan::find()->where(['id'=>$model->idrawat])->one();
        if ($model->load(Yii::$app->request->post())) {
            $rajal->iddokter = $model->iddokter;
            $rajal->katgigi = $model->katgigi;
			$rajal->katpenyakitmulut = $model->katpenyakitmulut;
			$rajal->macampenyakitmulut = $model->macampenyakitmulut;
			$rajal->kdiagnosa = $model->diagnosa;
			$rajal->save(false);
			if($model->save(false)){
            return $this->redirect(['view', 'id' => $model->id]);
		
			    
			}
        }

        return $this->render('update', [
            'model' => $model,
            'rajal' => $rajal,
        ]);
    }

    /**
     * Deletes an existing PemeriksaanRajal model.
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
     * Finds the PemeriksaanRajal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemeriksaanRajal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemeriksaanRajal::findOne($id)) !== null) {
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
