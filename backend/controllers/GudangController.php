<?php

namespace backend\controllers;

use Yii;
use common\models\Distribusi;
use common\models\Itemdistri;
use common\models\Rawatjalan;
use common\models\Apotekmutasi;
use common\models\Resepdokter;
use common\models\ObatSearch;
use common\models\Pembelianapotek;
use common\models\PembelianapotekSearch;
use common\models\Itembeli;
use common\models\Obat;
use common\models\Katbobat;
use common\models\Tindakandokter;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class GudangController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Rawatjalan models.
     * @return mixed
     */
    public function actionIndex()
    {
		
        $searchModel = new ObatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		//$dataProvider->query->where('status = 3');
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 
    public function actionDatapembelian()
    {
		
        $searchModel = new PembelianapotekSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		//$dataProvider->query->where('status = 3');
		
        return $this->render('datapembelian', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rawatjalan model.
     * @param integer $id
     * @return mixed
     */
	  public function actionTambahdistri($id)
    {
		$model = $this->findDdistri($id);
		$pembelian = Obat::find()->where(['id'=>$model->idobat])->one();
		$mutasi = new Apotekmutasi;
		
			$model->status = 1;
			if($model->ke == 'Perawatan'){
			$pembelian->stok = $pembelian->stok;
			$pembelian->stokgudang = $pembelian->stokgudang;
			}else{
			$pembelian->stok = $pembelian->stok + $model->jumlah;
			$pembelian->stokgudang = $pembelian->stokgudang - $model->jumlah;
			}
			$mutasi->idobat = $model->idobat;
			$mutasi->ket = 'Keluar';
			$mutasi->dari = 'Gudang';
			$mutasi->status = 'Distribusi';
			$mutasi->ke = $model->ke ;
			$mutasi->jumlah = $model->jumlah;
			$mutasi->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$mutasi->idsatuan = $model->idsatuan;
			$model->save(false);
			$pembelian->save(false);
			$mutasi->save(false);
			if($model->ke == 'Farmasi'){
			return $this->redirect(['gudang/masuk/'.$model->id]);
			}else{
				return $this->redirect(['gudang/reviewdistribusi/'.$model->faktur->id]);
			}
    }
		  public function actionMasuk($id)
    {
		$model = $this->findDdistri($id);
		$pembelian = Obat::find()->where(['id'=>$model->idobat])->one();
		$mutasi = new Apotekmutasi;
		
			$model->status = 1;
			$mutasi->idobat = $model->idobat;
			$mutasi->ket = 'Masuk';
			$mutasi->dari = 'Gudang';
			$mutasi->status = 'Distribusi';
			$mutasi->ke = $model->ke ;
			$mutasi->jumlah = $model->jumlah;
			$mutasi->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$mutasi->idsatuan = $model->idsatuan;
			$model->save(false);
			$pembelian->save(false);
			$mutasi->save(false);
			return $this->redirect(['gudang/reviewdistribusi/'.$model->faktur->id]);
    }
	 
    public function actionTambah($id)
    {
		$model = $this->findDbeli($id);
		$pembelian = Obat::find()->where(['id'=>$model->idobat])->one();
		$mutasi = new Apotekmutasi;
		
			$model->status = 1;
			$pembelian->stokgudang = $model->jumlah + $pembelian->stokgudang;
			$mutasi->idobat = $model->idobat;
			$mutasi->ket = 'Masuk';
			$mutasi->dari = 'Gudang';
			$mutasi->jumlah = $model->jumlah;
			$mutasi->status = 'Pembelian';
			$mutasi->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$mutasi->idsatuan = $model->idsatuan;
			$model->save(false);
			$pembelian->save(false);
			$mutasi->save(false);
			return $this->redirect(['gudang/reviewpembelian/'.$model->faktur->id]);
    }
	public function actionKurangi($id)
    {
		$model = $this->findModel($id);
		//$pembelian = new Pembelianapotek;
		$mutasi = new Apotekmutasi;
		if ($model->load(Yii::$app->request->post())&&$mutasi->load(Yii::$app->request->post())) {
			$model->stok = $model->stok - $mutasi->jumlah;
			$mutasi->idobat = $model->id ; 
			$mutasi->idsatuan =  $model->idsatuan ; 
			$mutasi->ket = 'keluar' ;
			$mutasi->tanggal = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			
			if($model->save(false)){
				$mutasi->save(false);
				 return $this->redirect(['index']);
			}
			else
			{	
				return $this->render('kurangi', [
					'model' => $model,
					'mutasi' => $mutasi,
				]);
			}
			
		   
		} else {
			return $this->render('kurangi', [
            'model' => $model,
            'mutasi' => $mutasi,
        ]);
		
		}
        
    }
	public function actionOrder($id)
    {
		$model = $this->findModel($id);
		$pembelian = new Resepdokter;
		$mutasi = new Apotekmutasi;
		if ($model->load(Yii::$app->request->post())&&$mutasi->load(Yii::$app->request->post())) {
			$model->stok = $model->stok - $mutasi->jumlah;
			$mutasi->idobat = $model->id ; 
			$mutasi->idsatuan =  $model->idsatuan ; 
			$mutasi->ket = 'keluar' ;
			$mutasi->tanggal = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			
			if($model->save(false)){
				$mutasi->save(false);
				 return $this->redirect(['index']);
			}
			else
			{	
				return $this->render('kurangi', [
					'model' => $model,
					'mutasi' => $mutasi,
				]);
			}
			
		   
		} else {
			return $this->render('kurangi', [
            'model' => $model,
            'mutasi' => $mutasi,
        ]);
		
		}
        
    }
	//Pembelianapotek
	
	public function actionPembelian()
     {

        $radid = new Pembelianapotek;
        $raddetail = [new Itembeli];


        if ($radid->load(Yii::$app->request->post())) {


            $raddetail = Model::createMultiple(Itembeli::classname());

            Model::loadMultiple($raddetail, Yii::$app->request->post());


            // validate all models

            $valid = $radid->validate();

            $valid = Model::validateMultiple($raddetail) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
				if($radid->total != $radid->bayar){
					$radid->status = 0;
				}else{
					$radid->status = 1;
				}
				$radid->sisabayar = $radid->total - $radid->bayar;
				$radid->dari = 'Gudang';
                try {

                    if ($flag = $radid->save(false)) {
					
                        foreach ($raddetail as $raddetail) {
						$raddetail->nofaktur = $radid->nofaktur;
                            if (! ($flag = $raddetail->save(false))) {

                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['/gudang/reviewpembelian/'.$radid->id]);

                    }

                } catch (Exception $e) {

                    $transaction->rollBack();

                }

            }

        }
		 return $this->render('pembelian', [

            'radid' => $radid,
            'raddetail'=>$raddetail,
            'raddetail' => (empty($raddetail)) ? [new Itembeli] : $raddetail

        ]);

    }
	
	public function actionDistribusi()
     {

        $radid = new Distribusi;
        $raddetail = [new Itemdistri];


        if ($radid->load(Yii::$app->request->post())) {


            $raddetail = Model::createMultiple(Itemdistri::classname());

            Model::loadMultiple($raddetail, Yii::$app->request->post());


            // validate all models

            $valid = $radid->validate();

            $valid = Model::validateMultiple($raddetail) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
			
                try {

                    if ($flag = $radid->save(false)) {
					
                        foreach ($raddetail as $raddetail) {
						$raddetail->nodistri = $radid->nodistri;
						$raddetail->ke = $radid->tempat;
					
                            if (! ($flag = $raddetail->save(false))) {

                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['/gudang/reviewdistribusi/'.$radid->id]);

                    }

                } catch (Exception $e) {

                    $transaction->rollBack();

                }

            }

        }
		 return $this->render('distribusi', [

            'radid' => $radid,
            'raddetail'=>$raddetail,
            'raddetail' => (empty($raddetail)) ? [new Itemdistri] : $raddetail

        ]);

    }

	 public function actionReviewpembelian($id)
    {
		$model = $this->findBeli($id);
        return $this->render('reviewpembelian', [
            'model' => $model,
        ]);
    }
	 public function actionReviewdistribusi($id)
    {
		$model = $this->findDistribusi($id);
        return $this->render('reviewdistribusi', [
            'model' => $model,
        ]);
    }
 public function actionListbarang($id)
	  {
		$models=Katbobat::find()->where(['idjenis' => $id])->orderBy('kat')->all();
		echo"<option value='0'>- Pilih -</option>";
		foreach($models as $k){
		  echo "<option value='".$k->id."'>".$k->kat."</option>";
		}
	  }
 public function actionView($id)
    {
		$model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
public function actionAntri($id)
    {
		$model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    
	/**
     * Creates a new Rawatjalan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Obat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rawatjalan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */


	
    /**
     * Deletes an existing Rawatjalan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
  

    /**
     * Finds the Rawatjalan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rawatjalan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Obat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	 protected function findBeli($id)
    {
        if (($model = Pembelianapotek::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	 protected function findDistribusi($id)
    {
        if (($model = Distribusi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	 protected function findDbeli($id)
    {
        if (($model = Itembeli::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findDdistri($id)
    {
        if (($model = Itemdistri::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
