<?php

namespace backend\controllers;

use Yii;
use common\models\PermintaanBarangDetail;
use common\models\Obat;
use common\models\PermintaanBarangDetailSearch;
use common\models\BarangMasukdetail;
use common\models\Kartustok;
use common\models\ApotekStokopname;
use common\models\BarangMasukdetailSearch;
use common\models\BarangMasuk;
use common\models\PermintaanBarang;
use common\models\PermintaanBarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PermintaanBarangController implements the CRUD actions for PermintaanBarang model.
 */
class PenerimaanBarangController extends Controller
{
	public function actionIndex(){
		$searchModel = new PermintaanBarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
	public function actionView($id){
		$model = PermintaanBarang::findOne($id);
		$masuk = BarangMasuk::find()->where(['idpermintaan'=>$model->id])->one();
		$barang = new BarangMasuk();
		$where = ['idpermintaan'=>$model->idpermintaan];
		$searchModel = new PermintaanBarangDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
		if($model->status == 4){
			return $this->redirect(['penerimaan-barang/terimabarang?id='.$masuk->id]);
		}
        if ($barang->load(Yii::$app->request->post())) {
			$barang->genKode();
			$barang->status = 0;
			$barang->jenismasuk = '40400';
			$barang->idpermintaan = $model->id;
			$barang->up = $model->idpermintaan;
			if($barang->save(false)){
				 return $this->redirect(['insert-barang', 'id' => $barang->id]);
			}else{
				 return $this->render('view', [
					'model' => $model,
					'barang' => $barang,
				]);
			}
           
        }
		return $this->render('view',[
			'model'=>$model,
			'barang' => $barang,
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}
	public function actionInsertBarang($id){
		$masuk = BarangMasuk::findOne($id);
		$model = PermintaanBarang::findOne($masuk->idpermintaan);
		 $aNilai=[];
			$barang = PermintaanBarangDetail::find()->where(['idtrx'=>$masuk->idpermintaan])->all();
			 foreach ($barang as $siswa) {
				$nilai = new BarangMasukdetail([
					'idbarang'=>$siswa->idobat,
					'namaobat'=>$siswa->obat->namaobat,
					'permintaan'=>$siswa->qty,
				]);
				$aNilai[$siswa->id] = $nilai;
			}
		
		if(BarangMasukdetail::loadMultiple($aNilai,  Yii::$app->request->post()) && BarangMasukdetail::validateMultiple($aNilai)){
            $jml = 0;
			foreach ($aNilai as $nilai) {
				$nilai->idtrx = $masuk->idtrx;
				$nilai->status =1;
				$nilai->tanggal = $masuk->tanggal;
				$nilai->harga = $nilai->obat->hargabeli;
				$nilai->satuan = $nilai->obat->idsatuan;
				$nilai->jumlah = $nilai->obat->hargabeli * $nilai->qty;	
				$nilai->genKode();
			    $nilai->save();
            }
			$masuk->status = 2;
			$model->status = 4;
			$model->save(false);
			$masuk->save(false);
            return $this->redirect(['terimabarang?id='.$masuk->id]);
        }
		return $this->render('insert-barang',[
			'masuk'=>$masuk,
			'model'=>$model,
			'aNilai'=>$aNilai,
		]);
	}
	
	public function actionTerimabarang($id){
		$model = BarangMasuk::findOne($id);
		$barang = BarangMasukDetail::find()->where(['idtrx'=>$model->idtrx])->all();
		$searchModel = new BarangMasukdetailSearch();
		$where = ['idtrx'=>$model->idtrx];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
		return $this->render('terima',[
			'model'=>$model,
			'barang'=>$barang,
			'dataProvider'=>$dataProvider,
			'searchModel'=>$searchModel,
		]);
	}
	public function actionTambahStok($id){
		$model = BarangMasuk::findOne($id);
		$barangMsk = BarangMasukDetail::find()->where(['idtrx'=>$model->idtrx])->all();
		$total = 0;
		foreach($barangMsk as $barangMsk){
			$stok = new Kartustok();
			
			$stokopname = new ApotekStokopname();
			$obat = Obat::find()->where(['id'=>$barangMsk->idbarang])->one();
			$sos = ApotekStokopname::find()->where(['idobat'=>$barangMsk->idbarang])->andwhere(['tanggal'=>$barangMsk->tanggal])->one();
			$sosc = ApotekStokopname::find()->where(['idobat'=>$barangMsk->idbarang])->andwhere(['tanggal'=>$barangMsk->tanggal])->count();
					if($sosc > 0){
						$sos->stokmasuk = $sos->stokmasuk + $barangMsk->qty;					
						$sos->stokakhir = $obat->stok + $barangMsk->qty ;
						$sos->save(false);
					}else{
						$stokopname->genKode();
						$stokopname->idobat = $barangMsk->idbarang;
						$stokopname->stokawal = $obat->stok;
						$stokopname->stokkeluar = 0;
						$stokopname->stokmasuk = $barangMsk->qty;
						$stokopname->stokakhir = $obat->stok + $barangMsk->qty ;
						$stokopname->tanggal = $model->tanggal;	
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
						if($model->jenisbarang == 4){
						$stok->jenismutasi = 3;
						}else{
							$stok->jenismutasi = 4;
						}
					$stok->keterangan = $model->idtrx;
					$stok->idtrx = $barangMsk->iddetail;
					$stok->stokawal = $obat->stok;
					$stok->idobat = $obat->id;
					$stok->qty = $barangMsk->qty;
					$stok->stokmasuk = $barangMsk->qty;
					$stok->idtkp = 14;//gudang
					$stok->tgl = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
					$stok->user = Yii::$app->user->identity->id;
					$stok->stokakhir = $stok->stokawal + $stok->qty;
					$obat->sisastok = $obat->stok;
					$obat->stok = $stok->stokakhir;
					$obat->sisaed = $obat->kadaluarsa;
					$stok->save(false);
					if($obat->save(false)){
							if($obat->stok < $obat->mstok){
								if($barangMsk->ed == null){
									$obat->kadaluarsa = $obat->kadaluarsa;
								}else{
									$obat->kadaluarsa = $barangMsk->ed;
								}
								$obat->status = 1;
								$obat->save(false);
							}else{
								if($barangMsk->ed == null){
									$obat->kadaluarsa = $obat->kadaluarsa;
								}else{
									$obat->kadaluarsa = $barangMsk->ed;
								}
								
								$obat->status = 0;
								$obat->save(false);								
							}
						}
					
					$total += $barangMsk->jumlah;
					}
					
					$model->status = 3;
					$model->total = $total;
					$model->save(false);
					return $this->redirect(Yii::$app->request->referrer);
					
		}
}
