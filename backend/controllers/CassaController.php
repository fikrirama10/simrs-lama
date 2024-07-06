<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Trxapotek;
use common\models\Trandetail;
use common\models\Transaksi;
use common\models\TransaksiSearch;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Tindakandokter;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class CassaController extends Controller
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
     public function actionPrintFaktur($id) {
      //tampilkan bukti proses
	  $model = $this->findTindakan($id);
	  $rajal = Rawatjalan::findOne($model->idrawat);
	  $content = $this->renderPartial('faktur-farmasi',['model'=>$model,'rajal'=>$rajal]); 
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => Pdf::FORMAT_A4, 
		'marginTop' => '3',  
		'marginRight' => '4',
		'marginLeft' => '4',
		'marginBottom' => '4',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/faktur.css',
       // 'methods' => [ 
            // 'SetFooter'=>['RSAU dr. NORMAN T.LUBIS ,'],
        // ]
       //'options' => ['title' => 'Bukti Permohonan Informasi'],
       ]);
         $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_RAW;
            $headers = Yii::$app->response->headers;
            $headers->add('Content-Type', 'application/pdf');
      
      // return the pdf output as per the destination setting
      return $pdf->render(); 
     }
  public function actionIndex()
    {
		

        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // get your HTML raw content without any layouts or scripts
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
			
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
	
		$andWhere = ['status'=>1];
        $searchModel = new TransaksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere,$andFilterWhere);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
			
		
        ]);
    }

    /**
     * Displays a single Rawatjalan model.
     * @param integer $id
     * @return mixed
     */
	public function actionEdit($id)
    {
		$trx = new Trandetail;
		$tra = $this->findTindakan($id);
		$model = Rawatjalan::find()->where(['id'=>$tra->idrawat])->one();
		
			if ($trx->load(Yii::$app->request->post())){
			$trx->idtrx = $tra->idtrx;
			$trx->no_rm= $model->no_rekmed;
			$trx->idrawat= $model->id;
			$trx->tanggal= date('Y-m-d',strtotime('+7 hour',strtotime(date('Y-m-d'))));;
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
    public function actionView($id)
    {
		$trx = new Trandetail;
		$tra = new Transaksi;
		$model = $this->findModel($id);
			if ($trx->load(Yii::$app->request->post())){
			$tra->genKode();
			$trx->idtrx = $tra->idtrx;
			$trx->no_rm= $model->no_rekmed;
			$trx->idrawat= $model->id;
			$trx->tanggal= date('Y-m-d',strtotime('+7 hour',strtotime(date('Y-m-d'))));
			if($trx->save(false)){
			 $trx->harga = $trx->tindakan->tarif;
			 $trx->total = $trx->harga * $trx->jumlah;
				$trx->save();
				return $this->refresh();
			}
			else
			{	
				return $this->render('view', [
					'model' => $model,
					'trx' => $trx,
					'tra' => $tra,
				]);

			}
			
		   
		}
        return $this->render('view', [
            'model' => $this->findModel($id),
            'trx' => $trx,
            'tra' => $tra,
        ]);
    }
	  public function actionBeres($id)
    {
		$model = $this->findTindakan($id);
		$total=0;
		$transaksi = Trandetail::find()->where(['idrawat'=>$model->idrawat])->andWhere(['idtrx'=>$model->idtrx])->all();
		foreach($transaksi as $trx){
			$total +=$trx->total;
		}
		$model->total = $total;			
		$model->save(false);
		return $this->redirect(['index']);
	}
	 public function actionDeletetind($id)
    {
        $tindakan = Trandetail::find()->where(['id'=>$id])->one();
		$tindakan->delete();
         return $this->redirect(Yii::$app->request->referrer);
		
    }
	
	public function actionUppulang($id){
		$model = $this->findModel($id);
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
			}
			if($model->save(false)){
				if($model->idjenisrawat != 2){

					if($trx->save(false)){
						if($model->idbayar == 5){
							$trx->harga = $trx->tindakan->tarif;
							$trx->total = $trx->harga;
							$trx->save(false);
						}else{
							$trx->harga = $trx->tindakan->tarif;
							$trx->total = $trx->harga;
							$trx->save(false);
						}
							return $this->redirect(['billing/view/'.$tra->id]);
						}	
					}
				else{
					$trx->save(false);
					return $this->redirect(['billing/view/'.$tra->id]);
				}
			}
				
		}
		 return $this->render('uppulang', [
            'model' => $this->findModel($id),
        ]);
	}
	
	 public function actionSelesai($id)
    {
		$tra = new Transaksi;
		$total = 0;
		//$trx = new Transaksi;
		$model = $this->findModel($id);
		//$trx = Trandetail::find()->where(['idrawat'=>$model->id])->one();
		
		$tra->genKode();
		$tra->status = 1;
		$tra->no_rm = $model->no_rekmed;
		$tra->idrawat = $model->id;
		$tra->kodedokter = $model->drbayar;
		$tra->tglbayar = date('Y-m-d',strtotime($model->tglkbayar));
		$tra->tgltrx = date('Y-m-d',strtotime('+7 hour',strtotime(date('Y-m-d'))));
		$tra->jamtrx = date('H:i:s',strtotime('+7 hour',strtotime(date('H:i:s'))));
		$tra->idbayar = $model->idbayar;
		$tra->idjenisrawat = $model->idjenisrawat;
		$tra->iduser =  Yii::$app->user->identity->id;
		// if($model->idkelas == 1){
			// $pavilum
		// }
		if($tra->save(false)){
			
			$trx = Trandetail::find()->where(['idtrx'=>$tra->idtrx])->all();
			foreach($trx as $trx){
				$total +=$trx->total;
			}
			$tra->total = $total;				
			$model->sbayar = $tra->status;
			$model->save(false);
			$tra->save(false);
			return $this->redirect(Yii::$app->request->referrer);
		}
	}
	 public function actionBeresEdit($id){
		 $tra = Transaksi::find()->where(['id'=>$id])->one();
		 $trx = Trandetail::find()->where(['idtrx'=>$tra->idtrx])->all();
		 $total = 0;
		 $trx = Trandetail::find()->where(['idtrx'=>$tra->idtrx])->all();
		foreach($trx as $trx){
			$total +=$trx->total;
		}
		$tra->total = $total;	
		$tra->iduser =  Yii::$app->user->identity->id;
		$tra->save(false);
	 }
	public function actionPrint($id) {
      //tampilkan bukti proses
	  $modela = Transaksi::find()->where(['id'=>$id])->one();
	  $model = Transaksi::find()->where(['idrawat'=>$modela->idrawat])->one(); 
	   $model->status = 2;
	  $model->save();
	  $content = $this->renderPartial('printfaktur2',['model'=>$model]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => Pdf::FORMAT_A4, 
		'marginTop' => '3',  
		'marginRight' => '4',
		'marginLeft' => '4',
		'marginBottom' => '4',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/faktur.css',
       // 'methods' => [ 
            // 'SetFooter'=>['RSAU dr. NORMAN T.LUBIS ,'],
        // ]
       //'options' => ['title' => 'Bukti Permohonan Informasi'],
       ]);
         $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_RAW;
            $headers = Yii::$app->response->headers;
            $headers->add('Content-Type', 'application/pdf');
      
      // return the pdf output as per the destination setting
      return $pdf->render(); 
     }
	 
	 public function actionPrint2($id) {
      //tampilkan bukti proses
	  $modela = Transaksi::find()->where(['id'=>$id])->one();
	  $model = Transaksi::find()->where(['idrawat'=>$modela->idrawat])->one(); 
	   $model->status = 2;
	  $model->save();
	  $content = $this->renderPartial('printfaktur2',['model'=>$model]); 
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => Pdf::FORMAT_A4, 
		'marginTop' => '3',  
		'marginRight' => '4',
		'marginLeft' => '4',
		'marginBottom' => '4',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/faktur.css',
       // 'methods' => [ 
            // 'SetFooter'=>['RSAU dr. NORMAN T.LUBIS ,'],
        // ]
       //'options' => ['title' => 'Bukti Permohonan Informasi'],
       ]);
         $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_RAW;
            $headers = Yii::$app->response->headers;
            $headers->add('Content-Type', 'application/pdf');
      
      // return the pdf output as per the destination setting
      return $pdf->render(); 
     }
	
	
        

    /**
     * Creates a new Rawatjalan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCekObat($id){
		$model = $this->findModel($id);
		$jumlah =0;
	
	    $obat = Trxapotek::find()->where(['idrawat'=>$model->id])->one();
	    $obatr = Trxapotek::find()->where(['idrawat'=>$model->id])->all();
		$obatc = Trxapotek::find()->where(['idrawat'=>$model->id])->count();
		$trxo =  Trandetail::find()->where(['idrawat'=>$model->id])->one();
	//	$trx =  	::find()->where(['idrawat'=>$model->idrawat])->count();
		$trd = new Trandetail;
		$tra = new Transaksi;
		$tra->genKode();
		//$trx->idtrx = $tra->idtrx;
			if($obatc < 1){
				\Yii::$app->getSession()->setFlash('danger', 'Belum Ada Transaksi Di Apotek'.$obatc);
				return $this->redirect(['cassa/view/'.$model->id]);
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
			
			return $this->redirect(['cassa/view/'.$model->id]);
			}
			
			
		
		
		
		
	}
    public function actionCreate()
    {
        $model = new Rawatjalan();
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	public function actionKeybpjs(){
			$data = "29250";
			$secretKey = "5lQ5E30F4C";
         // Computes the timestamp
          date_default_timezone_set('UTC');
          $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
           // Computes the signature by hashing the salt with the secret key as the key
			$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
 
   // base64 encode…
   $encodedSignature = base64_encode($signature);
	 return $this->render('keybpjs', [
            'secretKey' => $secretKey,
            'encodedSignature' => $encodedSignature,
            'signature' => $signature,
			'tStamp'=>$tStamp,
			
        ]);
   }
   	public function actionKeybpjsCek(){
			$data = "22863";
			$secretKey = "7iO4B31311";
         // Computes the timestamp
          date_default_timezone_set('UTC');
          $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
           // Computes the signature by hashing the salt with the secret key as the key
			$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
 
   // base64 encode…
   $encodedSignature = base64_encode($signature);
	 return $this->render('keybpjs', [
            'secretKey' => $secretKey,
            'encodedSignature' => $encodedSignature,
            'signature' => $signature,
			'tStamp'=>$tStamp,
			
        ]);
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
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findTindakan($id)
    {
        if (($model = Transaksi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


	}
