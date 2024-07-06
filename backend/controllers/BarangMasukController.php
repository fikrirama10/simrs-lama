<?php

namespace backend\controllers;

use Yii;
use common\models\BarangMasuk;
use common\models\BarangMasukdetailSearch;
use common\models\BarangMasukdetail;
use common\models\BarangMasukSearch;
use common\models\Kartustok;
use common\models\Obat;
use common\models\ApotekStokopname;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BarangMasukController implements the CRUD actions for BarangMasuk model.
 */
class BarangMasukController extends Controller
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
     * Lists all BarangMasuk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BarangMasukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BarangMasuk model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = BarangMasuk::findOne($id);
		$barang = BarangMasukDetail::find()->where(['idtrx'=>$model->idtrx])->all();
		$searchModel = new BarangMasukdetailSearch();
		$where = ['idtrx'=>$model->idtrx];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
		return $this->render('view',[
			'model'=>$model,
			'barang'=>$barang,
			'dataProvider'=>$dataProvider,
			'searchModel'=>$searchModel,
		]);
		// $model = $this->findModel($id);
		// $barangMsk = new BarangMasukdetail;
		// $stok = new Kartustok();
		// $stokopname = new ApotekStokopname();
		// if ($barangMsk->load(Yii::$app->request->post())) {
			// $barangMsk->genKode();
			// $barangMsk->tanggal = $model->tanggal;
			// $barangMsk->idtrx = $model->idtrx;
			// $barangMsk->harga = $barangMsk->obat->hargabeli;
			// $barangMsk->satuan = $barangMsk->obat->idsatuan;
			// $barangMsk->jumlah = $barangMsk->obat->hargabeli * $barangMsk->qty;	
			// $msk = BarangMasukdetail::find()->where(['idbarang'=>$barangMsk->idbarang])->andwhere(['idtrx'=>$model->idtrx])->count();
			// if($msk > 0){
				// $brgMsk = BarangMasukdetail::find()->where(['idbarang'=>$barangMsk->idbarang])->andwhere(['idtrx'=>$model->idtrx])->one();
				// $stk = Kartustok::find()->where(['idtrx'=>$brgMsk->iddetail])->one();
				// $obt = Obat::find()->where(['id'=>$brgMsk->idbarang])->one();
				// $so = ApotekStokopname::find()->where(['idobat'=>$brgMsk->idbarang])->andwhere(['tanggal'=>$barangMsk->tanggal])->one();
				// $so->stokmasuk = $so->stokmasuk + $barangMsk->qty;								
				// $so->stokakhir = $obt->stok + $barangMsk->qty ;
				// $brgMsk->qty = $brgMsk->qty + $barangMsk->qty ; 
				// $brgMsk->jumlah = $brgMsk->obat->hargabeli * $brgMsk->qty ; 
				// $stk->qty = $brgMsk->qty;
				// $stk->stokakhir = $stk->stokawal + $stk->qty;
				// $obt->sisastok = $obt->stok;
				// $obt->stok = $stk->stokakhir;
				// $stk->stokmasuk = $brgMsk->qty;
				// $obt->sisaed = $obt->kadaluarsa;
				// $brgMsk->save(false);
				// $stk->save(false);
				// if($obt->save(false)){
							// if($obt->stok < $obt->mstok){
								// $obt->status = 1;								
								// $obt->kadaluarsa = $barangMsk->ed;
								// $obt->save(false);
							// }else{
								// $obt->kadaluarsa = $barangMsk->ed;
								// $obt->status = 0;
								// $obt->save(false);								
							// }
						// }
				// $so->save(false);
				// return $this->refresh();
			// }else{
				// if($barangMsk->save()){
					// $obat = Obat::find()->where(['id'=>$barangMsk->idbarang])->one();
					// $sos = ApotekStokopname::find()->where(['idobat'=>$barangMsk->idbarang])->andwhere(['tanggal'=>$barangMsk->tanggal])->one();
					// $sosc = ApotekStokopname::find()->where(['idobat'=>$barangMsk->idbarang])->andwhere(['tanggal'=>$barangMsk->tanggal])->count();
					// if($sosc > 0){
						// $sos->stokmasuk = $sos->stokmasuk + $barangMsk->qty;								
						// $sos->stokakhir = $obat->stok + $barangMsk->qty ;
						// $sos->save(false);
					// }else{
						// $stokopname->genKode();
						// $stokopname->idobat = $barangMsk->idbarang;
						// $stokopname->stokawal = $obat->stok;
						// $stokopname->stokkeluar = 0;
						// $stokopname->stokmasuk = $barangMsk->qty;
						// $stokopname->stokakhir = $obat->stok + $barangMsk->qty ;
						// $stokopname->tanggal = $model->tanggal;	
						// $stokopname->save(false);
						// $opmn = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($stokopname->tanggal))])->andwhere(['statusstok'=>1])->andwhere(['idobat'=>$obat->id])->count();
						// if($opmn > 0){				
						
							// $opmn2c = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($stokopname->tanggal))])->andwhere(['statusstok'=>2])->andwhere(['idobat'=>$obat->id])->count();
							// if($opmn2c > 0){
								// $opmn2 = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($stokopname->tanggal))])->andwhere(['statusstok'=>2])->andwhere(['idobat'=>$obat->id])->one();
								// $opmn2->statusstok = 0;
								// $opmn2->save();
							// }
								// $stokopname->statusstok = 2 ;
							
							
							
						// }else{
							// $stokopname->statusstok = 1 ;
						// }
						// $stokopname->save(false);
						
					// }
					// if($model->jenisbarang == 4){
						// $stok->jenismutasi = 3;
					// }else{
						// $stok->jenismutasi = 4;
					// }
					// $stok->keterangan = $model->idtrx;
					// $stok->idtrx = $barangMsk->iddetail;
					// $stok->stokawal = $obat->stok;
					// $stok->idobat = $obat->id;
					// $stok->qty = $barangMsk->qty;
					// $stok->stokmasuk = $barangMsk->qty;
					// $stok->idtkp = 14;//gudang
					// $stok->tgl = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
					// $stok->user = Yii::$app->user->identity->id;
					// $stok->stokakhir = $stok->stokawal + $stok->qty;
					// $obat->sisastok = $obat->stok;
					// $obat->stok = $stok->stokakhir;
					// $obat->sisaed = $obat->kadaluarsa;
					// $stok->save(false);
					// if($obat->save(false)){
							// if($obat->stok < $obat->mstok){
								// $obat->kadaluarsa = $barangMsk->ed;
								// $obat->status = 1;
								// $obat->save(false);
							// }else{
								// $obat->kadaluarsa = $barangMsk->ed;
								// $obat->status = 0;
								// $obat->save(false);								
							// }
						// }
					// return $this->refresh();
				// }else{
					 // return $this->render('view', [
						// 'model' => $model,
						// 'barangMsk' => $barangMsk,
					// ]);
				// }
			// }
		// }else{
			// return $this->render('view', [
				// 'model' => $model,
				// 'barangMsk' => $barangMsk,
			// ]);
		// }
        // return $this->render('view', [
            // 'model' => $model,
            // 'barangMsk' => $barangMsk,
        // ]);
    }
	public function actionHapusobat($id){
		$resep = BarangMasukdetail::find()->where(['id'=>$id])->one();
		$obat = Obat::find()->where(['id'=>$resep->idbarang])->one();
		$so = ApotekStokopname::find()->where(['idobat'=>$resep->idbarang])->andwhere(['tanggal'=>$resep->tanggal])->one();
		$stok = Kartustok::find()->where(['idtrx'=>$resep->iddetail])->one();
		$obat->stok = $obat->stok - $stok->qty;
		$so->stokmasuk = $so->stokmasuk - $resep->qty;
		$so->stokakhir = $so->stokakhir - $resep->qty;
		if($obat->save(false)){
			if($obat->stok < $obat->mstok){
				$obat->kadaluarsa = $obat->sisaed;
				//$obat->sisastok = $obat->sisastok - $stok->qty;
				$obat->status = 1;
				$obat->save(false);
			}else{
				$obat->kadaluarsa = $obat->sisaed;
				//$obat->sisastok = $obat->sisastok - $stok->qty;
				$obat->status = 0;
				$obat->save(false);								
			}
			$stok->delete();
			$resep->delete();
			$so->save();
			return $this->redirect(Yii::$app->request->referrer);
		}
	}
	public function actionSelesai($id){
		$model= $this->findModel($id);
		$resep= BarangMasukdetail::find()->where(['idtrx'=>$model->idtrx])->all();
		$hargatotal = 0;
		foreach($resep as $rp){
			$hargatotal += $rp->jumlah;
		}
		$model->total = $hargatotal;
		$model->status = 1;
		$model->save(false);
		return $this->redirect(['index']);
		
	}
    /**
     * Creates a new BarangMasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BarangMasuk();

        if ($model->load(Yii::$app->request->post())) {
			$model->genKode();
			$model->status = 0;
			$model->jenismasuk = '40400';
			if($model->save(false)){
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
     * Updates an existing BarangMasuk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BarangMasuk model.
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
     * Finds the BarangMasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BarangMasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BarangMasuk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
