<?php

namespace backend\controllers;

use Yii;
use common\models\Apotekumum;
use common\models\ApotekumumDetail;
use common\models\Kartustok;
use common\models\Obat;
use common\models\Detail;
use common\models\ApotekumumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ApotekStokopname;
/**
 * DafusgController implements the CRUD actions for Dafusg model.
 */
class ApotekumumController extends Controller
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
     * Lists all Dafusg models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApotekumumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dafusg model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$stok = new Kartustok();
		$model = $this->findModel($id);
		$resep = new ApotekumumDetail;
		$stokopname = new ApotekStokopname();
		if ($resep->load(Yii::$app->request->post())) {
			$resep->genKode();
			$resep->idtrx = $model->idtrx;
			$resep->tanggal = date('Y-m-d',strtotime($model->tgltrx));
			$resep->harga = $resep->obat->harga;
			$resep->satuan = $resep->obat->idsatuan;
			$resep->subtotal = $resep->obat->harga * $resep->qty;	
			$obatt = Obat::find()->where(['id'=>$resep->idobat])->one();
			if($obatt->stok < $resep->qty){
				\Yii::$app->getSession()->setFlash('danger', 'Gagal ditambah Stok Obat Kurang');
				return $this->refresh();
			}else{
				$rsp = ApotekumumDetail::find()->where(['idobat'=>$resep->idobat])->andwhere(['idtrx'=>$model->idtrx])->count();
				if($rsp > 0){
						$rspe = ApotekumumDetail::find()->where(['idobat'=>$resep->idobat])->andwhere(['idtrx'=>$model->idtrx])->one();
						$stk = Kartustok::find()->where(['idtrx'=>$rspe->iddetail])->one();
						$obt = Obat::find()->where(['id'=>$rspe->idobat])->one();
						$so = ApotekStokopname::find()->where(['idobat'=>$rspe->idobat])->andwhere(['tanggal'=>$resep->tanggal])->one();
						$so->stokkeluar = $so->stokkeluar + $resep->qty;								
						$so->stokakhir = $obt->stok - $resep->qty ;
						$rspe->qty = $rspe->qty + $resep->qty ; 
						$rspe->subtotal = $rspe->obat->harga * $rspe->qty ; 
						//$stk->stokawal = $obt->stok;
						$stk->qty = $rspe->qty;
						$stk->stokakhir = $stk->stokawal - $stk->qty;
						$obt->stok = $stk->stokakhir;
						$stk->stokkeluar = $rspe->qty;
						$rspe->save(false);
						$stk->save(false);
						$obt->save(false);
						$so->save(false);
						return $this->refresh();
					}else{
						if($resep->save()){
						$obat = Obat::find()->where(['id'=>$resep->idobat])->one();
						$sos = ApotekStokopname::find()->where(['idobat'=>$resep->idobat])->andwhere(['tanggal'=>$resep->tanggal])->one();
						$sosc = ApotekStokopname::find()->where(['idobat'=>$resep->idobat])->andwhere(['tanggal'=>$resep->tanggal])->count();
						if($sosc > 0){
						$sos->stokkeluar = $sos->stokkeluar + $resep->qty;								
						$sos->stokakhir = $obat->stok - $resep->qty ;
						$sos->save(false);
						}else{
						$stokopname->genKode();
						$stokopname->idobat = $resep->idobat;
						$stokopname->stokawal = $obat->stok;
						$stokopname->stokkeluar = $resep->qty;
						$stokopname->stokmasuk = 0;
						$stokopname->stokakhir = $obat->stok - $resep->qty ;
						$stokopname->tanggal = $resep->tanggal;	
						$stokopname->save(false);
						$opmn = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($stokopname->tanggal))])->andwhere(['statusstok'=>1])->andwhere(['idobat'=>$obat->id])->count();
						if($opmn > 0){				
						
							$opmn2c = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($stokopname->tanggal))])->andwhere(['statusstok'=>2])->andwhere(['idobat'=>$obat->id])->count();
							if($opmn2c > 0){
								$opmn2 = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($stokopname->tanggal))])->andwhere(['statusstok'=>2])->andwhere(['idobat'=>$obat->id])->one();
								$opmn2->statusstok = 0;
								$opmn2->save();
							}
								$stokopname->statusstok = 2 ;
							
							
							
						}else{
							$stokopname->statusstok = 1 ;
						}
						$stokopname->save(false);
						
						}
						$stok->jenismutasi = 6;
						$stok->keterangan = $model->idtrx;
						//$stok->idtrx = $resep->id;
						$stok->idtrx = $resep->iddetail;
						$stok->stokawal = $obat->stok;
						$stok->idobat = $obat->id;
						$stok->qty = $resep->qty;
						$stok->stokkeluar = $resep->qty;
						$stok->idtkp = 10;
						$stok->tgl = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
						$stok->user = Yii::$app->user->identity->id;
						$stok->stokakhir = $stok->stokawal - $stok->qty;
						$obat->stok = $stok->stokakhir;
						$stok->save(false);
						$obat->save(false);
						return $this->refresh();
						}else{
							return $this->render('view', [
								'model' => $model,
								//'rawat' => $rawat,
								'resep' => $resep,
							]);
						}	
					}
			}
		}
        return $this->render('view', [
			'model' => $model,
			//'rawat' => $rawat,
			'resep' => $resep,
		]);
    }
	public function actionHapusobat($id){
		$resep = ApotekumumDetail::find()->where(['id'=>$id])->one();
		$obat = Obat::find()->where(['id'=>$resep->idobat])->one();
		$so = ApotekStokopname::find()->where(['idobat'=>$resep->idobat])->andwhere(['tanggal'=>$resep->tanggal])->one();
		$stok = Kartustok::find()->where(['idtrx'=>$resep->iddetail])->one();
		$obat->stok = $obat->stok + $stok->qty;
		$so->stokkeluar = $so->stokkeluar - $resep->qty;
		$so->stokakhir = $so->stokakhir + $resep->qty;
		if($obat->save(false)){
			$stok->delete();
			$resep->delete();
			$so->save();
			return $this->redirect(Yii::$app->request->referrer);
		}
	}
	public function actionSelesai($id){
		$model= $this->findModel($id);
		$resep= ApotekumumDetail::find()->where(['idtrx'=>$model->idtrx])->all();
		$hargatotal = 0;
		foreach($resep as $rp){
			$hargatotal += $rp->subtotal;
		}
		$model->total = $hargatotal;
		$model->status = 1;
		$model->save(false);
		return $this->redirect(['index']);
		
	}

    /**
     * Creates a new Dafusg model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Apotekumum();

        if ($model->load(Yii::$app->request->post())) {
			$model->genKode();
			$model->tgltrx =  date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->status = 0;
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
     * Updates an existing Dafusg model.
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
     * Deletes an existing Dafusg model.
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
     * Finds the Dafusg model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dafusg the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apotekumum::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
