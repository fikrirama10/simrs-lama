<?php

namespace backend\controllers;

use Yii;
use kartik\mpdf\Pdf;
use common\models\Rawatjalan;
use common\models\Obat;
use common\models\RawatjalanSearch;
use common\models\PasienSearch;
use common\models\Resepdokter;
use common\models\Pasien;
use common\models\TransaksiReturn;
use common\models\Trxmanual;
use common\models\Trxresep;
use common\models\Trxapotek;
use common\models\TrxapotekSearch;
use common\models\Rekamedis;
use common\models\ApotekStokopname;
use common\models\Kartustok;
use common\models\RekamedisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RekamedisController implements the CRUD actions for Rekamedis model.
 */
class ResepController extends Controller
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
     * Lists all Rekamedis models.
     * @return mixed
     */
     public function actionReport($start='', $end='',$cek='',$search=''){
	    $transaksi = Trxapotek::find()->where(['between', 'DATE_FORMAT(tgl,"%Y-%m-%d")', $start, $end])->andwhere(['idbayar'=>$search])->andwhere(['idlok'=>$cek])->andwhere(['status'=>1])->orderBy(['tgl'=>SORT_ASC])->all();
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
     public function actionRetur($id,$obat){
		$resep = Trxresep::find()->where(['id'=>$id])->andwhere(['idobat'=>$obat])->one();
		$retur = new TransaksiReturn();
		$mutasi = new ApotekStokopname();
		$stok = new Kartustok();
		$dataobat = Obat::findOne($obat);
		if($retur->load(Yii::$app->request->post())){
			$retur->idobat = $resep->idobat;
			$retur->idtrx = $resep->trxid;
			$retur->harga = $resep->obat->harga;
			$retur->total = $resep->obat->harga * $retur->qty;
			$retur->status = 1;
			$retur->iduser = Yii::$app->user->identity->id;
			$retur->tgl = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
			
			$stok->idobat = $retur->idobat ;
			$stok->qty = $retur->qty ;
			$stok->stokawal = $dataobat->stok ;
			$stok->stokmasuk = $retur->qty;
			$stok->stokakhir = $retur->qty + $dataobat->stok;
			$stok->stokakhir = $retur->qty + $dataobat->stok;
			$stok->keterangan = $resep->trxid;
			$stok->tgl = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
			$stok->idtrx = $resep->bkid;
			$stok->user = Yii::$app->user->identity->id;
			if($resep->trx->idbayar == 5){
				$stok->jenismutasi = 8;
			}else{
				$stok->jenismutasi = 7;
			}
			$stok->idtkp = $resep->trx->idlok;
			$opname = ApotekStokopname::find()->where(['tanggal'=>date('Y-m-d')])->andwhere(['idobat'=>$obat])->one();
			$opnamec = ApotekStokopname::find()->where(['tanggal'=>date('Y-m-d')])->andwhere(['idobat'=>$obat])->count();
			if($opnamec > 0){
				$opname->stokmasuk = $opname->stokmasuk + $retur->qty;
				$opname->stokawal = $dataobat->stok;
				$opname->stokakhir = $dataobat->stok + $retur->qty;
				$opname->save(false);
			}
			else{
			$mutasi->tanggal = date('Y-m-d',strtotime('+7 hour',strtotime(date('Y-m-d'))));
			$mutasi->stokmasuk = $retur->qty;
			$mutasi->stokawal = $dataobat->stok;
			$mutasi->stokakhir = $dataobat->stok + $retur->qty;
			$mutasi->genKode();
			$mutasi->idobat = $dataobat->id;
			$opmn = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($retur->tgl))])->andwhere(['statusstok'=>1])->andwhere(['idobat'=>$dataobat->id])->count();
						if($opmn > 0){				
						
							$opmn2c = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($retur->tgl))])->andwhere(['statusstok'=>2])->andwhere(['idobat'=>$dataobat->id])->count();
							if($opmn2c > 0){
								$opmn2 = ApotekStokopname::find()->where(['DATE_FORMAT(tanggal,"%m")'=>date('m',strtotime($retur->tgl))])->andwhere(['statusstok'=>2])->andwhere(['idobat'=>$dataobat->id])->one();
								$opmn2->statusstok = 0;
								$opmn2->save();
							}else{
								$mutasi->statusstok = 2 ;
							}
							
							
							
							
						}else{
							$mutasi->statusstok = 1 ;
						}
						$mutasi->save(false);
			}
			
			$resep->jumlah = $resep->jumlah - $retur->qty;
			$resep->total = ($resep->jumlah - $retur->qty) * $resep->obat->harga;
			$resep->totalbeli = ($resep->jumlah - $retur->qty) * $resep->obat->hargabeli;
			$resep->retur = $retur->qty;
			$dataobat->stok = $dataobat->stok + $retur->qty;
			if($retur->save(false)){
				$stok->save(false);
				
				$resep->save(false);
				$dataobat->save(false);
				return $this->redirect(['resep/createresep/'.$resep->trx->id]);
			}
		}
		return $this->render('return',[
			'resep'=>$resep,
			'retur'=>$retur,
		]);
	}
     public function actionFaktur($id){
	  //tampilkan bukti proses
	$model = Trxapotek::find()->where(['id' => $id])->one();
	$resep = Trxresep::find()->where(['trxid'=>$model->idtrx])->all();
	$content = $this->renderPartial('faktur',['model' => $model ,'resep'=>$resep]);

	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
		'marginTop' => '10',  
		'marginRight' => '4',
		'marginLeft' => '4',
		'marginBottom' => '4',
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/faktur.css',
	   //'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
    public function actionNewResep(){
		$url = 'https://simrs.rsausulaiman.com/dashboard/rest/resep-transaksi';
		$content= Yii::$app->kazo->fetchApiData($url);
        $json = json_decode($content, true);
		
		$dataYanmas = Rawatjalan::find()->where(['apotek'=>null])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")'=>date('Y-m-d')])->andwhere(['idbayar'=>4])->orderby(['tgldaftar'=>SORT_DESC])->all();
		$dataBpjs = Rawatjalan::find()->where(['apotek'=>null])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")'=>date('Y-m-d')])->andwhere(['idbayar'=>5])->orderby(['tgldaftar'=>SORT_DESC])->all();
		
		return $this->render('new-resep',[
			'json'=>$json,
			'dataYanmas'=>$dataYanmas,
			'dataBpjs'=>$dataBpjs,
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
		$url = 'https://simrs.rsausulaiman.com/dashboard/rest/resep-detail?rm='.$id;
		$content= Yii::$app->kazo->fetchApiData($url);
        $json = json_decode($content, true);		
		
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/resep?rm='.$id;
		$content2 = Yii::$app->kazo->fetchApiData($url2);
        $json2 = json_decode($content2, true);		
		
		return $this->renderAjax('_showAll', [
           'json'=>$json2,
		   'json2'=>$json,
        ]);

	}
    public function actionIndex()
    {
        $searchModel = new RawatjalanSearch();
	//	$where = ['<>','idjenisrawat',2];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
public function actionListResep($start='', $end='',$cek='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){
		
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tgl', $start, $end];
			
		}else{
			$where = ['between', 'tgl', date('Y-m-d'), date('Y-m-d')];
			
		
		
		}
        $searchModel = new TrxapotekSearch();
		$andwhere = ['status'=>1];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where,$andwhere);

        return $this->render('listresep', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionGetSearch($start='', $end='',$cek='',$search='',$search2='')
    {
			if($start !== '' && $end !== '' && $cek !== ''){
		
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tgl', $start, $end];
			$andFilterWhere = ['or',['like', 'idbayar', $search], ];
		}else{
			$where = ['between', 'tgl', date('Y-m-d'), date('Y-m-d')];
			$andFilterWhere = ['or',['like', 'idbayar', $search], ];
		
		}
		
		$andWhere = ['status'=>1];  $searchModel = new TrxapotekSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere,$andFilterWhere);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
		
        ]);
    }
	
	
	public function actionView($id){
		$model = $this->findRajal($id);
		
		return $this->render('view', [
            'model' => $model,
        ]);
	
	}
	
	public function actionCek($id){
		$rp = Trxresep::find()->where(['id'=>$id])->one();
		$st = Kartustok::find()->where(['idtrx'=>$resep->idtrx])->one();
		$ob = Obat::find()->where(['idobat'=>$resep->idobat])->one();
		
	}
	public function actionCreateresep($id){
		$model = $this->findTrx($id);
		$rawat = Rawatjalan::find()->where(['id'=>$model->idrawat])->one();
		$resep = new Trxresep();
		$stok = new Kartustok();
		$stokopname = new ApotekStokopname();
		if($resep->load(Yii::$app->request->post())){
			$resep->trxid = $model->idtrx;
			$resep->tanggal  = date('Y-m-d',strtotime($model->tglresep));
			$resep->iduser  = Yii::$app->user->identity->id;
			$resep->norm  = $model->norm;	
			$resep->genKode();
			$resep->harga = $resep->obat->harga;
			$resep->satuan = $resep->obat->idsatuan;
			$resep->totalbeli = $resep->obat->hargabeli * $resep->jumlah;
			$resep->total = $resep->obat->harga * $resep->jumlah;	
			$obatt = Obat::find()->where(['id'=>$resep->idobat])->one();
			if($obatt->stok < $resep->jumlah){
				\Yii::$app->getSession()->setFlash('danger', 'Gagal ditambah Stok Obat Kurang');
				return $this->refresh();
			}else{
					$rsp = Trxresep::find()->where(['idobat'=>$resep->idobat])->andwhere(['trxid'=>$model->idtrx])->count();
					if($rsp > 0){
						$rspe = Trxresep::find()->where(['idobat'=>$resep->idobat])->andwhere(['trxid'=>$model->idtrx])->one();
						$stk = Kartustok::find()->where(['idtrx'=>$rspe->bkid])->one();
						$obt = Obat::find()->where(['id'=>$rspe->idobat])->one();
						$so = ApotekStokopname::find()->where(['idobat'=>$rspe->idobat])->andwhere(['tanggal'=>$resep->tanggal])->one();
						$so->stokkeluar = $so->stokkeluar + $resep->jumlah;								
						$so->stokakhir = $obt->stok - $resep->jumlah ;
						$rspe->jumlah = $rspe->jumlah + $resep->jumlah ; 
						$rspe->total = $rspe->obat->harga * $rspe->jumlah ; 
						//$stk->stokawal = $obt->stok;
						$stk->qty = $rspe->jumlah;
						$stk->stokakhir = $stk->stokawal - $stk->qty;
						$obt->stok = $stk->stokakhir;
						$stk->stokkeluar = $rspe->jumlah;
						$rspe->save(false);
						$stk->save(false);
					    $obt->sisa = $obt->sisastok + $stk->qty;
						$kadal = $obt->sisastok - $stk->qty;
						if($kadal < 1){
							$obt->sisastok = 0;
						}else{
							$obt->sisastok = $kadal;
						}
						if($obt->save(false)){
							if($obt->stok < $obt->mstok){
								$obt->status = 1;
								$obt->save(false);
							}else{
								$obt->status = 0;
								$obt->save(false);								
							}
						}
						$so->save(false);
						return $this->refresh();
					}else{
						if($resep->save(false)){
						$obat = Obat::find()->where(['id'=>$resep->idobat])->one();
						if($rawat->idbayar == 4){
							$stok->jenismutasi = 1;
						}else{
							$stok->jenismutasi = 2;
						}
						$sos = ApotekStokopname::find()->where(['idobat'=>$resep->idobat])->andwhere(['tanggal'=>$resep->tanggal])->one();
						$sosc = ApotekStokopname::find()->where(['idobat'=>$resep->idobat])->andwhere(['tanggal'=>$resep->tanggal])->count();
						if($sosc > 0){
						$sos->stokkeluar = $sos->stokkeluar + $resep->jumlah;								
						$sos->stokakhir = $obat->stok - $resep->jumlah ;
						$sos->save(false);
						}else{
						$stokopname->genKode();
						$stokopname->idobat = $resep->idobat;
						$stokopname->stokawal = $obat->stok;
						$stokopname->stokkeluar = $resep->jumlah;
						$stokopname->stokmasuk = 0;
						$stokopname->stokakhir = $obat->stok - $resep->jumlah ;
						$stokopname->tanggal = $resep->tanggal;	
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
						
						//$stok->trxid = $model->idtrx;
						$stok->keterangan = $model->idtrx;
						//$stok->idtrx = $resep->id;
						$stok->idtrx = $resep->bkid;
						$stok->stokawal = $obat->stok;
						$stok->idobat = $obat->id;
						$stok->qty = $resep->jumlah;
						$stok->stokkeluar = $resep->jumlah;
						$stok->idtkp = $model->idlok;
						$stok->tgl = date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
						$stok->user = Yii::$app->user->identity->id;
						$stok->stokakhir = $stok->stokawal - $stok->qty;
						$stok->save(false);
				        $obat->sisa = $obat->sisastok + $stok->qty;
						$kadal = $obat->sisastok - $stok->qty;
						if($kadal < 1){
							$obat->sisastok = 0;
						}else{
							$obat->sisastok = $kadal;
						}
						$obat->stok = $stok->stokakhir;
						$stok->save(false);
						if($obat->save(false)){
							if($obat->stok < $obat->mstok){
								$obat->status = 1;
								$obat->save(false);
							}else{
								$obat->status = 0;
								$obat->save(false);								
							}
						}
						return $this->refresh();
						}else{
							return $this->render('createresep', [
								'model' => $model,
								'rawat' => $rawat,
								'resep' => $resep,
							]);
						}
					}				
			
			}		
			
		}else{
			return $this->render('createresep', [
            'model' => $model,
            'rawat' => $rawat,
			'resep' => $resep,
        ]);
		}
		return $this->render('createresep', [
            'model' => $model,
            'rawat' => $rawat,
			'resep' => $resep,
        ]);
	
	}
	public function actionSelesai($id){
		$model= $this->findTrx($id);
		$rawat = Rawatjalan::find()->where(['id'=>$model->idrawat])->one();
		$resep= Trxresep::find()->where(['trxid'=>$model->idtrx])->all();
		$hargatotal = 0;
		$hargatotalbeli = 0;
		foreach($resep as $rp){
			$hargatotal += $rp->total;
			$hargatotalbeli += $rp->totalbeli;
			
		}
		$model->totalbeli = $hargatotalbeli;
		$model->total = $hargatotal;
		$model->status = 1;
		$rawat->apotek = 1;
		$model->save(false);
		$rawat->save(false);
		return $this->redirect(['resep/new-resep']);
		
	}
	public function actionHapusobat($id){
		$resep = Trxresep::find()->where(['id'=>$id])->one();
		$obat = Obat::find()->where(['id'=>$resep->idobat])->one();
		$stok = Kartustok::find()->where(['idtrx'=>$resep->bkid])->one();
		$so = ApotekStokopname::find()->where(['idobat'=>$resep->idobat])->andwhere(['tanggal'=>$resep->tanggal])->one();
		$obat->stok = $obat->stok + $stok->qty;
		$so->stokkeluar = $so->stokkeluar - $resep->jumlah;
		$so->stokakhir = $so->stokakhir + $resep->jumlah;
		if($obat->save(false)){
		   if($obat->stok < $obat->mstok){
				$obat->sisastok = $obat->sisa - $stok->qty;
				$obat->sisa = 0 ;
				$obat->status = 1;
				$obat->save(false);
			}else{
				$obat->sisastok = $obat->sisa - $stok->qty;
				$obat->sisa = 0 ;
				$obat->status = 0;
				$obat->save(false);								
			}
			$stok->delete();
			$resep->delete();
			$so->save();
			return $this->redirect(Yii::$app->request->referrer);
		}
	}
	public function actionDetail($id){
		$model = $this->findRajal($id);
		$trxman = new Trxapotek();
		$trxman->genNoresep();
		$trxman->koderawat= $model->idrawat;
		$trxman->idrawat= $model->id;
		$trxman->norm= $model->no_rekmed;
		$trxman->idlok= $model->idjenisrawat;
		$trxman->idbayar= $model->idbayar;
		$trxman->nama= $model->pasien->nama_pasien;
		$trxman->tgl= $model->tgldaftar;
		$trxman->tglresep= date('Y-m-d G:i:s',strtotime('+7 hour',strtotime(date('Y-m-d G:i:s'))));
		if($trxman->save(false)){
			 return $this->redirect(['resep/createresep/'.$trxman->id]);
		}
	
	}
	
		
	 public function actionLabel($id) {
	  //tampilkan bukti proses
	  $model = Trxapotek::find()->where(['id' => $id])->one();
		$resep = Trxresep::find()->where(['trxid'=>$model->idtrx])->all();
	  $content = $this->renderPartial('etiket',['model' => $model ,'resep'=>$resep]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => [60,40],
	   'marginTop' => '0',
	   'orientation' => Pdf::ORIENT_PORTRAIT, 
	   'marginLeft' => '1',
	   'marginRight' => '1',
	   'marginBottom' => '0',
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/etiket.css',
	   //'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	public function actionDelete($id)
    {
        $this->findModel($id)->delete();

         return $this->redirect(Yii::$app->request->referrer);
    }
 

    
    protected function findModel($id)
    {
        if (($model = Resepdokter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	protected function findTrx($id)
    {
        if (($model = Trxapotek::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	protected function findRajal($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }}
