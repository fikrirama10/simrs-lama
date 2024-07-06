<?php

namespace backend\controllers;

use Yii;
use common\models\DukkesObat;
use common\models\DukkesObatMutasi;
use common\models\DukkesKeluar;
use common\models\DukkesKeluarDetail;
use common\models\DukkesKeluarSearch;
use common\models\DukkerTemporary;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * DukkesKeluarController implements the CRUD actions for DukkesKeluar model.
 */
class DukkesKeluarController extends Controller
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
     * Lists all DukkesKeluar models.
     * @return mixed
     */
     public function actionLaporanKeluar($id) {
	  //tampilkan bukti proses
	  $model = $this->findModel($id);
	  $detail = DukkesKeluarDetail::find()->where(['kodetrx'=>$model->kodetrx])->all();
	  $content = $this->renderPartial('keluar',['model' => $model,'detail'=>$detail]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
	   //'options' => ['title' => 'Bukti Permohonan Informasi'],

		'methods' => [ 
            'SetFooter'=>['DRM. 01 - RJ'],
        ]	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
    public function actionIndex()
    {
        $searchModel = new DukkesKeluarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DukkesKeluar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$detail = new DukkesKeluarDetail();
		$tempo = new DukkerTemporary();
		$mutasi = new DukkesObatMutasi();
		if ($tempo->load(Yii::$app->request->post())) {
			$obat = DukkesObat::findOne($tempo->idobat);
			
			
			$tc = DukkerTemporary::find()->where(['idobat'=>$tempo->idobat])->andwhere(['kodetrx'=>$model->kodetrx])->count();
			$tempoo = DukkerTemporary::find()->where(['idobat'=>$tempo->idobat])->andwhere(['kodetrx'=>$model->kodetrx])->one();
			if($tc > 0){
				$rempe = $tempoo->qty + $tempo->qty;
				if($obat->stok < $rempe){
				\Yii::$app->getSession()->setFlash('danger', 'Gagal ditambah Stok Obat Kurang');
				return $this->refresh();
				}
				$tempoo->qty = $tempoo->qty + $tempo->qty;
				$tempoo->save();
			}else{
				if($obat->stok < $tempo->qty){
				\Yii::$app->getSession()->setFlash('danger', 'Gagal ditambah Stok Obat Kurang');
				return $this->refresh();
				}
			$tempo->kodetrx = $model->kodetrx;
			$tempo->status = "Keluar";
			if($tempo->save()){
				return $this->refresh();
			}
			}
		}
		 // if ($detail->load(Yii::$app->request->post())) {
			
			// $obat = DukkesObat::findOne($detail->idobat);
			
			// if($obat->stok < $detail->qty){
				// \Yii::$app->getSession()->setFlash('danger', 'Gagal ditambah Stok Obat Kurang');
				// return $this->refresh();
			// }
			// $dc = DukkesKeluarDetail::find()->where(['idobat'=>$detail->idobat])->andWhere(['kodetrx'=>$model->kodetrx])->count();		
			// $detailc = DukkesKeluarDetail::find()->where(['idobat'=>$detail->idobat])->andWhere(['kodetrx'=>$model->kodetrx])->one();
			// if($dc > 0){
				// $detailc->qty = $detailc->qty  + $detail->qty;
				// $mutasi->idobat = $obat->id;
				// $mutasi->jenismutasi = 'Keluar';
				// $mutasi->tanggal = date('Y-m-d H:i:s');
				// $mutasi->iduser = Yii::$app->user->identity->id;
				// $mutasi->qty = $detail->qty;
				// $obat->stok = $obat->stok - $detail->qty;
				// $detailc->save();
				// $obat->save();
				// $mutasi->save();
				// return $this->refresh();
			// }else{
				// $mutasi->idobat = $obat->id;
				// $mutasi->jenismutasi = 'Keluar';
				// $mutasi->tanggal = date('Y-m-d H:i:s');
				// $mutasi->iduser = Yii::$app->user->identity->id;
				// $mutasi->qty = $detail->qty;
				// $obat->stok = $obat->stok - $detail->qty;
				// $detail->kodetrx = $model->kodetrx;
				// if($detail->save()){
					// $mutasi->save();				
					// $obat->save();				
					 // return $this->render('view', [
						// 'model' => $model,
						// 'detail' => $detail,
					// ]);
				// }
			// }
			
        // }
        return $this->render('view', [
            'model' => $model,
            'tempo' => $tempo,
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
			$obat->stok = $obat->stok - $tmp->qty;
			$mutasi = new DukkesObatMutasi();
			$detail = new DukkesKeluarDetail();
			$detail->kodetrx = $tmp->kodetrx;
			$detail->idobat = $tmp->idobat;
			$detail->qty = $tmp->qty;
			$mutasi->idobat = $tmp->idobat;
			$mutasi->jenismutasi = 'Keluar';
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
     * Creates a new DukkesKeluar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DukkesKeluar();

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

    /**
     * Updates an existing DukkesKeluar model.
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
     * Deletes an existing DukkesKeluar model.
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
	 public function actionHapusObat($id)
    {
        $model = DukkerTemporary::findOne($id);
		$model->delete();
       return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the DukkesKeluar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DukkesKeluar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DukkesKeluar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
