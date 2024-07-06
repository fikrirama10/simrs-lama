<?php

namespace backend\controllers;

use Yii;
use common\models\PermintaanBarangDetail;
use common\models\PermintaanBarangDetailSearch;
use common\models\Obat;
use common\models\PermintaanBarang;
use common\models\PermintaanBarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PermintaanBarangController implements the CRUD actions for PermintaanBarang model.
 */
class PermintaanBarangController extends Controller
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
    public function actionSegarkan(){
		$obat = Obat::find()->all();
		foreach($obat as $obat){
			if($obat->stok < $obat->mstok){
				$obat->status = 1;
				$obat->save(false);
			}else{
				$obat->status = 0;
				$obat->save(false);
			}
		}
		return $this->redirect(Yii::$app->request->referrer);
	}
    /**
     * Lists all PermintaanBarang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermintaanBarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReport($id)
	{
		$model = $this->findModel($id);
		
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report', ['model' => $model, ]);
		
		$footer = '
		<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top:3mm !important; margin-top:-50px !imporatnt">
		Page {PAGENO} of {nb}
		</div>';
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
				'marginTop' => '5',
			   'orientation' => Pdf::ORIENT_PORTRAIT, 
			   'marginLeft' => '5',
			   'marginRight' => '5',
			   'marginBottom' => '1',
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content, 
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@frontend/web/css/paper.css',
             // call mPDF methods on the fly
            'methods' => [
                // 'SetHeader'=>['THIS IS REPORT'],
               // 'SetFooter'=>[$footer],
            ]
        ]);
 
        // http response
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
 
        // return the pdf output as per the destination setting
        return $pdf->render();
    }
    /**
     * Displays a single PermintaanBarang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		 $searchModel = new PermintaanBarangDetailSearch();
		 $where = ['idpermintaan'=>$model->idpermintaan];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
		//$order = Orderlab::find()->where(['kodelab'=>$model->kodelab])->one();
        $aNilai=[];
		if($model->jenis == 4){
			
			 foreach (Obat::find()->where(['status' => 1 ])->andwhere(['idjenisobat'=>4])->all() as $siswa) {
				$nilai = new PermintaanBarangDetail([
					'idobat'=>$siswa->id,
					'namaobat'=>$siswa->namaobat,
					'idsatuan'=>$siswa->mstok,
					'sisastok'=>$siswa->stok,
					'harga'=>$siswa->hargabeli,
				]);
				$aNilai[$siswa->id] = $nilai;
			}
		}else{
			 foreach (Obat::find()->where(['status' =>1])->andwhere(['idjenisobat'=>5])->all() as $siswa) {
            $nilai = new PermintaanBarangDetail([
                'idobat'=>$siswa->id,
                'namaobat'=>$siswa->namaobat,
                'idsatuan'=>$siswa->mstok,
                'sisastok'=>$siswa->stok,
                'harga'=>$siswa->hargabeli,
            ]);
            $aNilai[$siswa->id] = $nilai;
        }
		}
        

        if(PermintaanBarangDetail::loadMultiple($aNilai,  Yii::$app->request->post()) && PermintaanBarangDetail::validateMultiple($aNilai)){
            $jml = 0;
			foreach ($aNilai as $nilai) {
				if($nilai->qty < 1){
					$nilai->total = 0;
				}else{
					$obat = Obat::find()->where(['id'=>$nilai->idobat])->one();
					$obat->status = 2;
					$nilai->total = $nilai->harga * $nilai->qty;
					$nilai->idpermintaan = $model->idpermintaan;
					$nilai->idtrx = $model->id;
					$nilai->tanggal = date('Y-m-d');
					$nilai->iduser = Yii::$app->user->identity->id;
					$nilai->status = 1;
					$jml += $nilai->total;
					$nilai->save();
					$obat->save();
				}
            }
			$model->total = $jml;
			$model->status = 2;
			$model->save();
            return $this->redirect(['view?id='.$model->id]);
        }
        return $this->render('view',[
            'aNilai'=>$aNilai,
            'model'=>$model,
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
                   ]);
    }
    /**
     * Creates a new PermintaanBarang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionTambahItem($id){
		$model = $this->findModel($id);
		$detail = new PermintaanBarangDetail;
		if ($detail->load(Yii::$app->request->post())) {
			$obat = Obat::find()->where(['id'=>$detail->idobat])->one();
			$cek = PermintaanBarangDetail::find()->where(['idobat'=>$detail->idobat])->andwhere(['idpermintaan'=>$model->idpermintaan])->count();
			if($cek > 0){
				\Yii::$app->getSession()->setFlash('danger', 'Barang Sudah masuk dalam list pengajuan silahkan edit jika ingin menambah jumlah barang');
				return $this->refresh();
			}
			$detail->idpermintaan = $model->idpermintaan;
			$detail->idtrx = $model->id;
			$detail->status = 12;
			$detail->harga = $obat->hargabeli;
			$detail->namaobat = $obat->namaobat;
			$detail->idsatuan = $obat->idsatuan;
			$detail->iduser = Yii::$app->user->identity->id;
			$detail->tanggal = date('Y-m-d');
			$detail->sisastok = $obat->stok;
			$detail->total = $obat->hargabeli * $detail->qty;
			if($detail->save()){
				$detail2 = PermintaanBarangDetail::find()->where(['idpermintaan'=>$model->idpermintaan])->all();
				$jml = 0;
				foreach ($detail2 as $dd) {		
					$jml += $dd->total;
				}
				$model->total = $jml;
				$model->save();
				return $this->redirect(['tambah-item?id='.$model->id]);
			}else{
				return $this->render('tambah-item',[
					'model'=>$model,
					'detail'=>$detail,
				]);		
			}
		}
		return $this->render('tambah-item',[
			'model'=>$model,
			'detail'=>$detail,
		]);		
	}
	public function actionEditItem($id){
		$model = $this->findItem($id);
		$pengajuan = PermintaanBarang::find()->where(['id'=>$model->idtrx])->one();
		
		 
		if ($model->load(Yii::$app->request->post())) {
			$model->status = 11;
			$model->iduser = Yii::$app->user->identity->id;
			$model->total = $model->harga * $model->qty;		
			if($model->save(false)){
				if($model->qty == 0){
					$model->delete();
					return $this->redirect(['view?id='.$pengajuan->id]);
				}else{
					$detail = PermintaanBarangDetail::find()->where(['idpermintaan'=>$pengajuan->idpermintaan])->all();
					$jml = 0;
					foreach ($detail as $detail) {		
						$jml += $detail->total;
					}
					$pengajuan->total = $jml;
					$pengajuan->save();
					return $this->redirect(['view?id='.$pengajuan->id]);
				}
				
			}else{
				return $this->render('edit-item',[
					'model'=>$model,
					'pengajuan'=>$pengajuan,
				]);
			}
		}
		return $this->render('edit-item',[
			'model'=>$model,
			'pengajuan'=>$pengajuan,
		]);
	}
    public function actionCreate()
    {
        $model = new PermintaanBarang();

        if ($model->load(Yii::$app->request->post())) {
			$model->genKode();
			$model->iduser = Yii::$app->user->identity->id;
			$model->tglcreate = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->status = 1;
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
     * Updates an existing PermintaanBarang model.
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
     * Deletes an existing PermintaanBarang model.
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
	public function actionDeleteItem($id)
    {
        $model = $this->findItem($id);
		$pengajuan = PermintaanBarang::find()->where(['id'=>$model->idtrx])->one();
		
		if($model->delete()){
			$jml = 0;
			$pengajuand = PermintaanBarangDetail::find()->where(['idpermintaan'=>$model->idpermintaan])->all();
			foreach ($pengajuand as $detail) {		
				$jml += $detail->total;
			}
			$pengajuan->total = $jml;
			$pengajuan->save();
			\Yii::$app->getSession()->setFlash('warning', 'Item Di hapus');
			return $this->redirect(['tambah-item?id='.$pengajuan->id]);
		}
        
    }
	public function actionKirim($id){
		$model = $this->findModel($id);
		$model->status = 3;
		$model->save();
		return $this->redirect(['/permintaan-barang']);
	}
    /**
     * Finds the PermintaanBarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermintaanBarang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermintaanBarang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	protected function findItem($id)
    {
        if (($model = PermintaanBarangDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }}
