<?php

namespace backend\controllers;

use Yii;
use common\models\Trxmanual;
use common\models\Trxresep;
use common\models\Obat;
use common\models\Trxmanualdetail;
use common\models\TrxmanualSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrxmanualController implements the CRUD actions for Trxmanual model.
 */
class TrxmanualController extends Controller
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
     * Lists all Trxmanual models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrxmanualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trxmanual model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	
    public function actionView($id)
    {	
		$model = $this->findModel($id);
		$trx = new Trxmanualdetail;
		  if ($trx->load(Yii::$app->request->post())) {
				$trx->trxid = $model->trxid;
				$trx->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
				$trx->harga = $trx->tindakan->tarif;
				$trx->total = $trx->harga * $trx->jumlah;			
				if($trx->save()){					
				return $this->redirect(['view', 'id' => $model->id]);
				}else{
					 return $this->render('view', [
						'model' => $model,
						'trx' => $trx,
					]);
				}
			
			}
        return $this->render('view', [
            'model' => $model,
            'trx' => $trx,
        ]);
    }
	public function actionDeletetind($id)
    {
        $tindakan = Trxmanualdetail::find()->where(['id'=>$id])->one();
		$tindakan->delete();
        return $this->redirect(Yii::$app->request->referrer);
		
    }
	public function actionSelesai($id)
    {
		
		$model = $this->findModel($id);
		$trx = Trxmanualdetail::find()->where(['trxid'=>$model->trxid])->count();
		if($trx < 1){
			\Yii::$app->getSession()->setFlash('danger', 'Gagal , Tidak Ada transaksi');
			return $this->redirect(Yii::$app->request->referrer);
		}else{
			\Yii::$app->getSession()->setFlash('success', 'Berhasil , Transaksi tercatat');
			$model->status = 1;
			$model->save(false);
			return $this->redirect(Yii::$app->request->referrer);
		}
		
		
	}
	public function actionBeres()
    {
		return $this->redirect(['index']);
	}
	
	public function actionHapus($id){
		$model = $this->findResep($id);
		$resep = Trxresep::find()->where(['id'=>$model->id])->one();
		$obat = Obat::find()->where(['id'=>$model->idobat])->one();
		$obat->stok = $obat->stok + $resep->jumlah ;
		if($obat->save(false)){
			$resep->delete();
			return $this->redirect(Yii::$app->request->referrer);
		}else{
			echo 'Gagal';
		}
	}

    /**
     * Creates a new Trxmanual model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Trxmanual();

        if ($model->load(Yii::$app->request->post())) {
			$model->genKode();
			$model->tgl = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->casier = Yii::$app->user->identity->id ;
			$model->status = 0 ;
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
     * Updates an existing Trxmanual model.
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
     * Deletes an existing Trxmanual model.
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
     * Finds the Trxmanual model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trxmanual the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trxmanual::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	protected function findResep($id)
    {
        if (($model = Trxresep::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
