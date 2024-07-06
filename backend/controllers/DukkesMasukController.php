<?php

namespace backend\controllers;

use Yii;
use common\models\DukkesObat;
use common\models\DukkesObatMutasi;
use common\models\DukkesMasuk;
use common\models\DukkerTemporary;
use common\models\DukkesMasukDetail;
use common\models\DukkesMasukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DukkesMasukController implements the CRUD actions for DukkesMasuk model.
 */
class DukkesMasukController extends Controller
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
     * Lists all DukkesMasuk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DukkesMasukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DukkesMasuk model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionView($id)
    {
		$model = $this->findModel($id);
		$tempo = new DukkerTemporary();
		$mutasi = new DukkesObatMutasi();
		if ($tempo->load(Yii::$app->request->post())) {
			$obat = DukkesObat::findOne($tempo->idobat);			
			
			$tc = DukkerTemporary::find()->where(['idobat'=>$tempo->idobat])->andwhere(['kodetrx'=>$model->kodetrx])->count();
			$tempoo = DukkerTemporary::find()->where(['idobat'=>$tempo->idobat])->andwhere(['kodetrx'=>$model->kodetrx])->one();
			if($tc > 0){		
				$tempoo->qty = $tempoo->qty + $tempo->qty;
				$tempoo->save();
			}else{
				
			$tempo->kodetrx = $model->kodetrx;
			$tempo->status = "Masuk";
			if($tempo->save()){
				return $this->refresh();
			}
			}
	}
	  return $this->render('view', [
            'model' => $model,
            'tempo' => $tempo,
        ]);
	}
    /**
     * Creates a new DukkesMasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DukkesMasuk();

        if ($model->load(Yii::$app->request->post())) {
			$model->genKode();
			$model->status = 1;
			$model->iduser=Yii::$app->user->identity->id;
			if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
	
	public function actionSelesai($id){
		$model = $this->findModel($id);
		
		$tempo = DukkerTemporary::find()->where(['kodetrx'=>$model->kodetrx])->all();
		$tempoc = DukkerTemporary::find()->where(['kodetrx'=>$model->kodetrx])->count();
		if($tempoc < 1){
			\Yii::$app->getSession()->setFlash('danger', 'Gagal menyimpan belum ada obat / alkes di pilih');
			return $this->redirect(['view', 'id' => $model->id]);
		}
		foreach($tempo as $tmp){
			$obat = DukkesObat::find()->where(['id'=>$tmp->idobat])->one();
			$obat->stok = $obat->stok + $tmp->qty;
			$mutasi = new DukkesObatMutasi();
			$detail = new DukkesMasukDetail();
			$detail->kodetrx = $tmp->kodetrx;
			$detail->idobat = $tmp->idobat;
			$detail->qty = $tmp->qty;
			$mutasi->idobat = $tmp->idobat;
			$mutasi->jenismutasi = 'Masuk';
			$mutasi->qty = $tmp->qty;
			$mutasi->tanggal = date('Y-m-d H:i:s');
			$mutasi->iduser = Yii::$app->user->identity->id;
			if($detail->save()){
				$obat->save();
				$mutasi->save();
			}
		}
		$model->status = 2;
		$model->save();
		$tee = DukkerTemporary::deleteAll(['kodetrx'=> $model->kodetrx]) ;

		return $this->redirect(['view', 'id' => $model->id]);
	}
    /**
     * Updates an existing DukkesMasuk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionHapusObat($id)
    {
        $model = DukkerTemporary::findOne($id);
		$model->delete();
       return $this->redirect(Yii::$app->request->referrer);
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
     * Deletes an existing DukkesMasuk model.
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
     * Finds the DukkesMasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DukkesMasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DukkesMasuk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
