<?php

namespace backend\controllers;

use Yii;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Rawatjalan;
use common\models\Trandetail;
use common\models\TransaksiSearch;
use common\models\Trxapotek;
use common\models\Transaksi;
use common\models\RawatjalanSearch;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class BillingController extends Controller
{
    
    public function actionEditDokter($id){
		$tra = $this->findTransaksi($id);
		$model = Rawatjalan::find()->where(['id'=>$tra->idrawat])->one();
		if ($tra->load(Yii::$app->request->post())){
			if($tra->save()){
			    $model->drbayar = $tra->kodedokter;
			    $model->save();
		    	return $this->redirect(['billing/view/'.$tra->id]);
			}
		}
		return $this->render('edit-dokter', [
					'model' => $model, 
					'tra' => $tra,
				]);
	}
	public function actionReportbybayar($start='', $end='',$cek='',$search=''){
	     $transaksi = Transaksi::find()->where(['between', 'DATE_FORMAT(tglbayar,"%Y-%m-%d")', $start, $end])->andwhere(['idbayar'=>$search])->andwhere(['idjenisrawat'=>$cek])->orderBy(['tglbayar'=>SORT_ASC])->all();
	    //return count($transaksi);
	     $content = $this->renderPartial('report', ['transaksi' => $transaksi,'judul'=>$cek]);
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
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
                //'SetFooter'=>[$footer],
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
	public function actionReport($start='', $end='',$cek='',$search=''){
	    $transaksi = Transaksi::find()->joinWith(['rawat as r'])->where(['between', 'DATE_FORMAT(r.tglkeluar,"%Y-%m-%d")', $start, $end])->andwhere(['transaksi.idbayar'=>$search])->andwhere(['>','transaksi.total',0])->andwhere(['transaksi.idjenisrawat'=>$cek])->orderBy(['r.tglkeluar'=>SORT_ASC])->all();
	    //return count($transaksi);
	     $content = $this->renderPartial('reportlos', ['transaksi' => $transaksi,'judul'=>$cek]);
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
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
                //'SetFooter'=>[$footer],
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
    public function actionData($start='', $end='',$cek='')
    {		
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			else if($cek == 'custom'){ $title = 'Periode'; }
			
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['IdStat'=>4];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}
		
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
      
		
        return $this->render('datapasien', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
        ]);
    }
	 public function actionGetSearchPasien($start='', $end='',$cek='',$search='',$search2='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){			
			
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idbayar', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			
			$andFilterWhere = ['or',['like', 'idbayar', $search], ];
		
		
		}
	
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andFilterWhere);
     

        return $this->renderAjax('search-pasien', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
			
		
        ]);
    }
	public function actionIndex(){
		$url = 'https://simrs.rsausulaiman.com/dashboard/rest/billing-transaksi';
		$content= Yii::$app->kazo->fetchApiData($url);
        $json = json_decode($content, true);	
	
		$dataYanmas = Rawatjalan::find()->where(['sbayar'=>null])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")'=>date('Y-m-d')])->andwhere(['idbayar'=>4])->andwhere(['batal'=>0])->orderby(['tgldaftar'=>SORT_DESC])->all();
		$dataBpjs = Rawatjalan::find()->where(['sbayar'=>null])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")'=>date('Y-m-d')])->andwhere(['idbayar'=>5])->andwhere(['batal'=>0])->orderby(['tgldaftar'=>SORT_DESC])->all();
		
		return $this->render('index', [
           'dataYanmas'=>$dataYanmas,
           'dataBpjs'=>$dataBpjs,
           'json'=>$json,
        ]);
	}
	public function actionGetrajal()
    {
		$kode = Yii::$app->request->post('id');
		if($kode){
			$model = Rawatjalan::find()->where(['id'=>$kode])->one();
		}else{
			$model = "";
		}
		return \yii\helpers\Json::encode($model);
    }
	public function actionShowAll($id){
		$nokartu =$id;
		$url = 'https://simrs.rsausulaiman.com/dashboard/rest/billing2?rm='.$id;
		$content= Yii::$app->kazo->fetchApiData($url);
        $json = json_decode($content, true);		
		
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/billing?rm='.$id;
		$content2 = Yii::$app->kazo->fetchApiData($url2);
        $json2 = json_decode($content2, true);		
		
		return $this->renderAjax('_showAll', [
           'json'=>$json2,
		   'json2'=>$json,
        ]);

	}
	
	public function actionCekObat($id){
		$model = $this->findModel($id);
		$jumlah =0;
		$obat = Trxapotek::find()->where(['idrawat'=>$model->id])->one();
		$obatr = Trxapotek::find()->where(['idrawat'=>$model->id])->all();
		
		
		$obatc = Trxapotek::find()->where(['idrawat'=>$model->id])->andwhere(['idlok'=>$model->idjenisrawat])->count();
		$trxo =  Trandetail::find()->where(['idrawat'=>$model->id])->one();	
		$trd = new Trandetail;
		$tra = Transaksi::find()->where(['idrawat'=>$model->id])->one();
		//$trx->idtrx = $tra->idtrx;
			if($obatc < 1){
				\Yii::$app->getSession()->setFlash('danger', 'Belum Ada Transaksi Di Apotek');
				return $this->redirect(['billing/view/'.$tra->id]);
			}else{
				$oobat = $obat->total;
				$trd->idtrx = $tra->idtrx;
				$trd->idrawat = $model->id;
				$trd->no_rm = $model->no_rekmed;
				$trd->tanggal= date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
				//$trd->no_rekmed = $model->no_rekmed;
			if($model->idbayar == 4){
				if($model->idjenisrawat == 2){
					foreach($obatr as $ori){
						$jumlah += $ori->total;
					}
					$trd->idtindakan = 289;
					$trd->jumlah = 1;
					$trd->harga = $jumlah;
					$trd->total = $jumlah;
				}else{
					$trd->idtindakan = 289;
				$trd->jumlah = 1;
				$trd->harga = $oobat;
				$trd->total = $oobat;
				}
				
			}else{
				if($model->idjenisrawat == 2){
					foreach($obatr as $ori){
						$jumlah += $ori->total;
					}
					$trd->idtindakan = 282;
					$trd->jumlah = 1;
					$trd->harga = $jumlah;
					$trd->total = $jumlah;
				}else{
					$trd->idtindakan = 282;
					$trd->jumlah = 1;
					$trd->harga = $oobat;
					$trd->total = $oobat;	
				}
				
			}
			$trd->save(false);
			
			return $this->redirect(['billing/view/'.$tra->id]);
			}	
		
	}
	public function actionSelesai($id)
    {
		$tra = $this->findTransaksi($id);
		$model = Rawatjalan::find()->where(['id'=>$tra->idrawat])->one();
		$detail = Trandetail::find()->where(['idtrx'=>$tra->idtrx])->all();
		$jml = 0 ;
		$tra->tglbayar = date('Y-m-d',strtotime($model->tglkbayar));
		foreach($detail as $detail){
			$jml += $detail->total;
		}
		
		$tra->total = $jml;
		$tra->status = 1;
		if($tra->save(false)){
			$model->sbayar = 1;
			$model->save(false);
			return $this->redirect(Yii::$app->request->referrer);
		}
	}
	public function actionDeletetind($id)
    {
        $tindakan = Trandetail::find()->where(['id'=>$id])->one();
		$tindakan->delete();
         return $this->redirect(Yii::$app->request->referrer);
		
    }
	public function actionSelesaiEdit($id){
		$tra = $this->findTransaksi($id);
		$trx = Trandetail::find()->where(['idtrx'=>$tra->idtrx])->all();
		$jml=0;
		foreach($trx as $trx){
			$jml += $trx->total;
		}
		$tra->total = $jml;
		if($tra->save()){
			return $this->redirect(['billing/view/'.$tra->id]);
		}else{
			return 'Gagal';
		}
	}
	public function actionEdit($id)
    {
		$trx = new Trandetail;
		$tra = $this->findTransaksi($id);
		$model = Rawatjalan::find()->where(['id'=>$tra->idrawat])->one();
		
			if ($trx->load(Yii::$app->request->post())){
			$trx->idtrx = $tra->idtrx;
			$trx->no_rm= $model->no_rekmed;
			$trx->idrawat= $model->id;
			$trx->tanggal= date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));;
			if($trx->save(false)){
				$trx->harga = $trx->tindakan->tarif;
				$trx->total = $trx->harga * $trx->jumlah;
				$trx->save();
			 return $this->refresh();
			}
			else
			{	
				return $this->render('edit', [
					'model' => $model,
					'trx' => $trx,
					'tra' => $tra,
				]);

			}
			
		   
		}
        return $this->render('edit', [
            'model' => $model,
            'trx' => $trx,
            'tra' => $tra,
        ]);
    }
	public function actionCreate($id){
		$model = $this->findModel($id);
		$transaksi = Transaksi::find()->where(['idrawat'=>$model->id])->count();
		$tran = Transaksi::find()->where(['idrawat'=>$model->id])->one();
		if($transaksi > 0){
		    return $this->redirect(['billing/view/'.$tran->id]);
		}else{
		$trx = new Trandetail;
		$tra = new Transaksi;
		if($model->load(Yii::$app->request->post())){
			$tra->genKode();
			$tra->idrawat = $model->id;
			$tra->no_rm = $model->no_rekmed;
			
			$tra->iduser = Yii::$app->user->identity->id;
			$tra->status = 1;
			$tra->tgltrx = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			$tra->jamtrx = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			$tra->idjenisrawat = $model->idjenisrawat;
				$tra->idbayar = $model->idbayar;
				$tra->kodedokter = $model->drbayar;		
				$tra->save(false);
				$trx->idtrx = $tra->idtrx;
				$trx->no_rm= $model->no_rekmed;
				$trx->idrawat= $model->id;
				$trx->kodedokter= $model->drbayar;
				$trx->tanggal= date('Y-m-d',strtotime('+7 hour',strtotime(date('Y-m-d'))));
				if($model->idjenisrawat == 2){
					if($model->idbayar == 4){
							$trx->harga = 110000;
							$trx->idtindakan = 277;
							$trx->jumlah = 1;
							$trx->total = $trx->harga;
					}else{
							$kelas = $model->idkelas;
							$tglmasuk = $model->tgldaftar;
							$tglkeluar = $model->tglkbayar;
							$lamarawat = strtotime($model->tglkbayar) - strtotime($model->tgldaftar);
							$lm = floor($lamarawat/86400)+2;
							if($model->idkelas == 1){
								$t1 = 20000 * $lm;
								$t2 = 3000 ;
								$t3 = 4000  ;
								$t4 = 10000 ;
								$tt = ($t2+$t3+$t4) * $lm;
								$te = $t1 + $tt;
								$trx->harga = $te;
								$trx->idtindakan = 11;
								$trx->idtindakan = 11;
								$trx->jumlah = 1;
								$trx->total = $trx->harga;
							}else if($model->idkelas == 2){
								$t1 = 20000 * $lm;
								$t2 = 2500 ;
								$t3 = 4000  ;
								$t4 = 10000 ;
								$tt =($t2+$t3+$t4) * $lm;
								$te = $t1+ $tt;
								$trx->harga = $te;
								$trx->idtindakan = 11;
								$trx->jumlah = 1;
								$trx->total = $trx->harga;
							}else{
								$t1 = 20000 * $lm;
								$t2 = 2000 ;
								$t3 = 4000  ;
								$t4 = 10000 ;
								$tt = ($t2+$t3+$t4) * $lm;
								$te = $t1 + $tt;
								$trx->harga = $te;
								$trx->idtindakan = 11;
								$trx->jumlah = 1;
								$trx->total = $trx->harga;
							}
						} 
				}else{
					if($model->idbayar == 5){
						$trx->idtindakan = 4  ;
						$trx->jumlah = 1 ;
					}else{
						$trx->idtindakan = 3 ;
						$trx->jumlah = 1 ;
					}
			if($model->save()){
				
					
						if($model->idjenisrawat != 2){

							if($trx->save()){
								if($model->idbayar == 5){
									$trx->harga = $trx->tindakan->tarif;
									$trx->total = $trx->harga;
									$trx->save();
								}else{
									$trx->harga = $trx->tindakan->tarif;
									$trx->total = $trx->harga;
									$trx->save();
								}
								return $this->redirect(['billing/view/'.$tra->id]);
							}	
						}
						else{
							$trx->save();
							return $this->redirect(['billing/view/'.$tra->id]);
						}
					
				}
			}
		}
		 return $this->render('uppulang', [
            'model' => $this->findModel($id),
            'transaksi' =>$transaksi
        ]);
		}
	}
	public function actionView($id){
		$model = $this->findTransaksi($id);
		$trx = new Trandetail;
		if ($trx->load(Yii::$app->request->post())){
			$trx->idtrx = $model->idtrx;
			$trx->no_rm= $model->no_rm;
			$trx->idrawat= $model->idrawat;
			$trx->tanggal= date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			if($trx->save(false)){
			 $trx->harga = $trx->tindakan->tarif;
			 $trx->total = $trx->harga * $trx->jumlah;
				$trx->save();
				return $this->refresh();
			}
			else
			{	
				return $this->render('view', [
					'model'=>$model,
					'trx'=>$trx,
				]);

			}
			
		   
		}
		return $this->render('view',[
			'model'=>$model,
			'trx'=>$trx,
		]);
	}
	
public function actionDatabayar($start='', $end='',$cek='')
    {		
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			else if($cek == 'custom'){ $title = 'Periode'; }
			
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['IdStat'=>4];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}

		$andWhere = ['>','status',0];
        $searchModel = new TransaksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere);
      
		
        return $this->render('databayar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
        ]);
    }
	 public function actionGetSearch($start='', $end='',$cek='',$search='',$search2='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){			
			
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];
			$andFilterWhere = ['or',['like', 'idbayar', $search], ];
		}else{
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];
			
			$andFilterWhere = ['or',['like', 'idbayar', $search], ];
		
		
		}
	
		$andWhere = ['>','status',0] ;
		$searchModel = new TransaksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere,$andFilterWhere);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
			
		
        ]);
    }

	
	 protected function findModel($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	 protected function findTransaksi($id)
    {
        if (($model = Transaksi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}