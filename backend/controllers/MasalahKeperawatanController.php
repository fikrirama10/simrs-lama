<?php

namespace backend\controllers;

use Yii;
use common\models\MasalahKeperawatan;
use common\models\MasalahKeperawatanRencanaasuhan;
use common\models\MasalahKeperawatanSub;
use common\models\MasalahKeperawatanDetail;
use common\models\MasalahKeperawatanDiagnosa;
use common\models\MasalahKeperawatanTindakan;
use common\models\Rawatjalan;
use common\models\MasalahKeperawatanSearch;
use yii\web\Controller;
use common\models\Rencanaasuhan;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasalahKeperawatanController implements the CRUD actions for MasalahKeperawatan model.
 */
class MasalahKeperawatanController extends Controller
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
     * Lists all MasalahKeperawatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MasalahKeperawatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionListSub($id)
	{
		$models=MasalahKeperawatanSub::find()->where(['idkategori' => $id])->all();
		echo"<option value='0'>- Pilih Sub Kategori -</option>";
		foreach($models as $k){
		echo "<option value='".$k->id."'>".$k->subkategori."</option>";
		}
	}
	public function actionListAsuhan($kode,$id)
	{
		$models=Rencanaasuhan::find()->where(['idintervensi'=>$kode])->andwhere(['idkategori' => $id])->all();
		echo"<option value='0'>- Pilih Rencanaasuhan -</option>";
		foreach($models as $k){
		echo "<option value='".$k->id."'>".$k->rencanaasuhan."</option>";
		}
	}
	public function actionListDiag($id)
	{
		$models=MasalahKeperawatanDiagnosa::find()->where(['idsubkat' => $id])->all();
		echo"<option value='0'>- Pilih Diagnosis -</option>";
		foreach($models as $k){
		echo "<option value='".$k->id."'>".$k->kode.' - '.$k->diagnosis."</option>";
		}
	}
	public function actionListTind($id)
	{
		$models=MasalahKeperawatanTindakan::find()->where(['iddiagnosis' => $id])->all();
		echo"<option value='0'>- Pilih Tindakan -</option>";
		foreach($models as $k){
		echo "<option value='".$k->id."'>".$k->tindakan."</option>";
		}
	}
    /**
     * Displays a single MasalahKeperawatan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$detail = new MasalahKeperawatanDetail();
		if ($detail->load(Yii::$app->request->post())) {
			$detail->idrawat = $model->idrawat;
			$detail->idmasalah = $model->id;
			$detail->idkategori = $model->idkategori;
			$detail->idsub = $model->idsub;
			$detail->iddiagnosis = $model->iddiagnosis;
			$detail->idsubdiagnosis = $model->idtindakan;
			$detail->subdiagnosis = $model->tindakan;
			$detail->status = 1;
			if($detail->save(false)){
				return $this->redirect(['view', 'id' => $model->id]);
			}else{
				return $this->render('view', [
					'model' => $model,
					'detail' => $detail,
				]);
			}
		}
        return $this->render('view', [
            'model' => $model,
            'detail' => $detail,
        ]);
    }
	public function actionItemRencana($id){
		$model = MasalahKeperawatanRencanaasuhan::findOne($id);
		$model->delete();
		return $this->redirect(Yii::$app->request->referrer);
	}
	public function actionRencanaSelesai($id){
		$model = $this->findDetail($id);
		$model->status = 2;
		$model->save();
		return $this->redirect(['view', 'id' => $model->idmasalah]);
		
	}
	public function actionAsuhanSelesai($id){
		$model = $this->findModel($id);
		$model->status = 2;
		$model->save();
		return $this->redirect(['rawatinap/'.$model->idrawat]);
		
	}
	public function actionRencanaAsuhan($id){
		$model = $this->findDetail($id);
		$masalah = MasalahKeperawatan::findOne($model->idmasalah);
		$asuhan = new MasalahKeperawatanRencanaasuhan();
		if ($asuhan->load(Yii::$app->request->post())) {
			$asuhan->idmasalah = $model->idmasalah;
			$asuhan->iddetail = $model->id;
			$asuhan->idintervensi = $model->idintervensi;
			$asuhan->idrawat = $model->idrawat;
			$asuhan->iduser = Yii::$app->user->identity->id ;
			if($asuhan->save()){
				return $this->redirect(['rencana-asuhan', 'id' => $model->id]);
			}else{
				return $this->render('rencana-asuhan', [
					'model' => $model,					
					'masalah'=>$masalah,
					'asuhan' => $asuhan,
				]);
			}
		}
		return $this->render('rencana-asuhan',[
			'model'=>$model,
			'masalah'=>$masalah,
			'asuhan'=>$asuhan,
		]);		
	}

    /**
     * Creates a new MasalahKeperawatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new MasalahKeperawatan();
		$rawat = $this->findRawat($id);
        if ($model->load(Yii::$app->request->post())) {
			if($model->tindakan == null){
				$tindakan = MasalahKeperawatanTindakan::find()->where(['id'=>$model->idtindakan])->one();
				$model->tindakan = $tindakan->tindakan;
			}
			$model->no_rekmed = $rawat->no_rekmed;
			$model->idrawat = $rawat->id;
			$model->tgl = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->user = Yii::$app->user->identity->id ;
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing MasalahKeperawatan model.
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
     * Deletes an existing MasalahKeperawatan model.
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
     * Finds the MasalahKeperawatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasalahKeperawatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasalahKeperawatan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	 protected function findRawat($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function findDetail($id)
    {
        if (($model = MasalahKeperawatanDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
