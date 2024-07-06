<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\PemeriksaanUgdResep;
use common\models\PemeriksaanIgd;
use common\models\PemeriksaanIgdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PemeriksaanUgdController implements the CRUD actions for PemeriksaanIgd model.
 */
class PemeriksaanUgdController extends Controller
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
     * Lists all PemeriksaanIgd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PemeriksaanIgdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PemeriksaanIgd model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionResep($id){
		$model = $this->findModel($id);
		$resep = new PemeriksaanUgdResep();
	
		  if ($resep->load(Yii::$app->request->post())) {
			$resep->idrawat = $model->idrawat;
			$resep->idpemeriksaan = $model->id;
			$resep->idbayar = $model->rawat->idbayar;
			$resep->iduser = Yii::$app->user->identity->id ;
			$resep->tanggal = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			if($resep->save()){
				return $this->redirect(['resep', 'id' => $model->id]);
			}else{
				return $this->render('resep',['model'=>$model,'resep'=>$resep,]);
			}
            
        }
		return $this->render('resep',['model'=>$model,'resep'=>$resep,]);
	}
	public function actionDeleteResep($id)
    {
        $this->findResep($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$rajal = Rawatjalan::find()->where(['id'=>$model->idrawat])->one();
		$post = Yii::$app->request->post();
		  if($model->load(Yii::$app->request->post())){
				$postMo = $post['PemeriksaanIgd'];
				$postTindakan = $postMo['tindakan'];
				
				$postLab = $postMo['lab'];
				$postRadiologi = $postMo['radiologi'];
			
				if($model->tindakan == '""' ){
				$model->tindakan = '';
				
				}else if($model->lab == '""' ){
					$model->lab='';
				}else if($model->radiologi == '""' ){
					$model->radiologi='';
				}
				else{
				$model->tindakan = json_encode($postTindakan);
				
				$model->lab = json_encode($postLab);
				$model->radiologi = json_encode($postRadiologi);
				
				}
				$rajal->status = 7;
				$rajal->prosedur = $model->prosedur;
				
				if($model->save()){
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
     * Creates a new PemeriksaanIgd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
		
        $model = new PemeriksaanIgd();
		$rajal = $this->findRajal($id);
		if($rajal->total == 1){
			return $this->redirect(['index']);
		}
        if ($model->load(Yii::$app->request->post())) {
			$rajal->kdiagnosa = $model->diagnosa;
			$rajal->iddokter = $model->iddokter;
			$rajal->triage = $model->triase;
			$model->jampemeriksaan = date('Y-m-d h:i:s',strtotime('+6 hour',strtotime(date('Y-m-d h:i:s'))));
			$rajal->jampemeriksaan = date('Y-m-d h:i:s',strtotime('+6 hour',strtotime(date('Y-m-d h:i:s'))));
			$model->status = 1;
			$rajal->status = 2;
			$rajal->total = 1;
			$model->idrawat = $rajal->id;
			if($model->save()){
				$rajal->save();
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
     * Updates an existing PemeriksaanIgd model.
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
     * Deletes an existing PemeriksaanIgd model.
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
     * Finds the PemeriksaanIgd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemeriksaanIgd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemeriksaanIgd::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function findResep($id)
    {
        if (($model = PemeriksaanUgdResep::findOne($id)) !== null) {
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
