<?php

namespace backend\controllers;

use Yii;
use common\models\Pagu;
use common\models\Jenispenerimaan;
use common\models\JenispenerimaanDetail;
use common\models\TargetPenerimaanRincian;
use common\models\TargetPenerimaan;
use common\models\TargetPenerimaanDetail;
use common\models\PaguSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaguController implements the CRUD actions for Pagu model.
 */
class PaguController extends Controller
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
     * Lists all Pagu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaguSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pagu model.
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
	public function actionTarget($id)
    {
		$model = new TargetPenerimaan();
		$pagu = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('target', [
            'pagu' => $pagu,
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Pagu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pagu();
		
        if ($model->load(Yii::$app->request->post())) {
			$model->genKode();
			$model->iduser = Yii::$app->user->identity->id;
			if($model->save()){
				for($a=1; $a < 13; $a++){
					$pagu = $model->nilaipagu/12; 
					$persentase = ($pagu / $model->nilaipagu ) * 100;
					$target[$a] = new TargetPenerimaan();
					$target[$a]->bulan = $a;
					$target[$a]->kodepagu = $model->kodepagu;
					$target[$a]->tahun = $model->tahun;
					$target[$a]->kodetarget = $model->tahun.$a;
					$target[$a]->nilaipagu = $pagu;
					$target[$a]->persentase = $persentase;
					$target[$a]->save();
				}
            return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pagu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionDetailTarget($id){
		$model = $this->findTarget($id);
		//$order = Orderlab::find()->where(['kodelab'=>$model->kodelab])->one();
        $aNilai=[];
		foreach (Jenispenerimaan::find()->all() as $siswa) {
				$nilai = new TargetPenerimaanDetail([
					'idpenerimaan'=>$siswa->id,
					'penerimaan'=>$siswa->jenispenerimaan,
				]);
				$aNilai[$siswa->id] = $nilai;
			}
		
        

        if(Jenispenerimaan::loadMultiple($aNilai,  Yii::$app->request->post()) && Jenispenerimaan::validateMultiple($aNilai)){
            $jml = 0;
			foreach ($aNilai as $nilai) {				
				$nilai->kodetarget = $model->id;				
			    $nilai->save(false);
            }
			$model->status = 1;
			$model->save();
			
            return $this->redirect(['detail-target?id='.$model->id]);
        }
        return $this->render('detail',[
            'aNilai'=>$aNilai,
            'model'=>$model,
		]);
	}
	
	public function actionRincianTarget($id){
	//	$model = $this->findTarget($id);
		$detail = $this->findDetail($id);
		//$order = Orderlab::find()->where(['kodelab'=>$model->kodelab])->one();
        $aNilai=[];
		foreach (JenispenerimaanDetail::find()->where(['idpenerimaan'=>$detail->idpenerimaan])->all() as $siswa) {
				$nilai = new TargetPenerimaanRincian([
					'iddetail'=>$siswa->id,
					'penerimaan'=>$siswa->namapenerimaan,
				]);
				$aNilai[$siswa->id] = $nilai;
			}
		
        

        if(JenispenerimaanDetail::loadMultiple($aNilai,  Yii::$app->request->post()) && JenispenerimaanDetail::validateMultiple($aNilai)){
            $jml = 0;
			foreach ($aNilai as $nilai) {				
				$nilai->kodetarget = $detail->id;				
			    $nilai->save(false);
            }
			$detail->status = 1;
			$detail->save();
			
            return $this->redirect(['rincian-target?id='.$detail->id]);
        }
        return $this->render('rincian-target',[
            'aNilai'=>$aNilai,
            'detail'=>$detail,
		]);
	}
	
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
     * Deletes an existing Pagu model.
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
     * Finds the Pagu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pagu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pagu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function findTarget($id)
    {
        if (($model = TargetPenerimaan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function findDetail($id)
    {
        if (($model = TargetPenerimaanDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
