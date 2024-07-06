<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Apotekmutasi;
use common\models\Kartustok;
use common\models\Resepdokter;
use common\models\ObatSearch;
use common\models\Pembelianapotek;
use common\models\ApotekStokopname;
use common\models\Trxresep;
use common\models\PembelianapotekSearch;
use common\models\Itembeli;
use common\models\Obat;
use common\models\Katbobat;
use common\models\Tindakandokter;
use kartik\mpdf\Pdf;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class ApotekController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                
            ],
        ];
    }

    /**
     * Lists all Rawatjalan models.
     * @return mixed
     */
     		public function actionPrint(){
		$obat = Obat::find()->where(['idjenisobat'=>4])->orderBy(['stok'=>SORT_ASC])->all();
		 $content = $this->renderPartial('print',['obat'=>$obat]);
		 $footer = '
		<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top:3mm !important; margin-top:-50px !imporatnt">
		Page {PAGENO} of {nb}
		</div>';
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
           'orientation' => Pdf::ORIENT_PORTRAIT,
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
                'SetFooter'=>[$footer],
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
	public function actionPrintBpjs(){
		$obat = Obat::find()->where(['idjenisobat'=>5])->orderBy(['stok'=>SORT_ASC])->all();
		 $content = $this->renderPartial('print',['obat'=>$obat]);
		 $footer = '
		<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top:3mm !important; margin-top:-50px !imporatnt">
		Page {PAGENO} of {nb}
		</div>';
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
           'orientation' => Pdf::ORIENT_PORTRAIT,
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
                'SetFooter'=>[$footer],
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
	    public function actionDelete($id)
    {	
        $this->findModel($id)->delete();
		
        return $this->redirect(['index']);
    }
     public function actionIndex()
    {
		
        $searchModel = new ObatSearch();
		$where = ['idjenisobat'=>4];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);

		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionIndexBpjs()
    {
		
        $searchModel = new ObatSearch();
		$where = ['idjenisobat'=>5];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
		//$dataProvider->query->where('status = 3');
		
        return $this->render('index_bpjs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 
    public function actionDatapembelian()
    {
		
        $searchModel = new PembelianapotekSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->where('dari = "Farmasi"');
		
        return $this->render('datapembelian', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 public function actionBelian($id)
    {
		$model = $this->findBeli($id);
		return $this->render('Belian',[
		'model'=>$model,
		]);
    }

    /**
     * Displays a single Rawatjalan model.
     * @param integer $id
     * @return mixed
     */
    public function actionTambah($id)
    {
		$model = $this->findDbeli($id);
		$pembelian = Obat::find()->where(['id'=>$model->idobat])->one();
		$mutasi = new Apotekmutasi;
		
			$model->status = 1;
			$pembelian->stok = $model->jumlah + $pembelian->stok;
			$mutasi->idobat = $model->idobat;
			$mutasi->ket = 'Masuk';
			$mutasi->jumlah = $model->jumlah;
			$mutasi->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$mutasi->idsatuan = $model->idsatuan;
			$mutasi->dari = 'Farmasi';
			$mutasi->ke = 'Farmasi';
			$mutasi->status = 'Pembelian';
			$model->save(false);
			$pembelian->save(false);
			$mutasi->save(false);
			return $this->redirect(['reviewpembelian/'.$model->faktur->id]);
    }
public function actionLaporanHarian($start='',$end='',$cek='',$search=''){
		//$obat = Trxresep::find()->joinWith(['obat as obt'])->where(['obt.idjenisobat'=>$search])->count();
		if($start !== '' && $end !== '' && $cek !== ''){
		
		$url = 'https://simrs.rsausulaiman.com/apites/stok?bulan='.$start.'&bayar='.$search.'&tahun='.$end;
        $content = file_get_contents($url);
        $json = json_decode($content, true);
		}else{	
		$url = 'https://simrs.rsausulaiman.com/apites/stok?bulan='.date('m').'&bayar='.$search.'&tahun='.date('Y');
        $content = file_get_contents($url);
        $json = json_decode($content, true);
		}
		return $this->render('laporanharian',['json'=>$json]);
	}
	public function actionGetDataBulanan($start='',$end='',$cek='',$search=''){
		//$obat = Trxresep::find()->joinWith(['obat as obt'])->where(['obt.idjenisobat'=>$search])->count();
		if($start !== '' && $end !== '' && $cek !== ''){
		if($search == 5){
			$title = 'BPJS';
			$tanggal = $start.'/'.$end;
		}else{
			$title = 'Yanmasum';
			$tanggal = $start.'/'.$end;
		}
		$url = 'https://simrs.rsausulaiman.com/apites/stok?bulan='.$start.'&bayar='.$search.'&tahun='.$end;
        $content = file_get_contents($url);
        $json = json_decode($content, true);
		}else{	
		$url = 'https://simrs.rsausulaiman.com/apites/stok?bulan='.$start.'&bayar='.$search.'&tahun='.$end;
        $content = file_get_contents($url);
        $json = json_decode($content, true);
		}
		return $this->renderAjax('data-bulanan',['json'=>$json,'title'=>$title,'tanggal'=>$tanggal]);
	}
	public function actionPrintlaporanBulanan($start='',$end='',$search='',$cek='')
	{
		if($start !== '' && $end !== '' && $cek !== ''){
		if($search == 5){
			$title = 'BPJS';
			$tanggal = 'Bulan '. date('F',strtotime('01-'.$start.'-'.$end)).' Tahun '.$end;
			$tanggal2 =  date('F',strtotime('01-'.$start.'-'.$end)).' '.$end;
		}else{
			$title = 'Yanmasum';
			$tanggal = 'Bulan '. date('F',strtotime('01-'.$start.'-'.$end)).' Tahun '.$end;
			$tanggal2 =  date('F',strtotime('01-'.$start.'-'.$end)).' '.$end;
		}
		$url = 'https://simrs.rsausulaiman.com/apites/stok?bulan='.$start.'&bayar='.$search.'&tahun='.$end;
        $content = file_get_contents($url);
        $json = json_decode($content, true);
		}else{	
		$url = 'https://simrs.rsausulaiman.com/apites/stok?bulan='.$start.'&bayar='.$search.'&tahun='.$end;
        $content = file_get_contents($url);
        $json = json_decode($content, true);
		}
        $content = $this->renderPartial('report-bulanan',['json'=>$json,'title'=>$title,'tanggal'=>$tanggal,'tanggal2'=>$tanggal2]);
		
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
                'SetFooter'=>[$footer],
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
	public function actionLaporanHarianObat($start='',$end='',$search='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$stokyanmas = ApotekStokopname::find()->joinWith(['obat as ob'])->where(['tanggal'=>$start])->andWhere(['ob.idjenisobat'=>$search])->orderBy(['stokakhir' => SORT_ASC])->all();
			$awal = date('Y-m-d',strtotime($start));
		}else{
			$stokyanmas = ApotekStokopname::find()->joinWith(['obat as ob'])->where(['tanggal'=>date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))))])->andWhere(['ob.idjenisobat'=>4])->orderBy(['stokakhir' => SORT_ASC])->all();
			$awal = date('Y-m-d');
		}
		return $this->render('laporanharianym',['stokyanmas'=>$stokyanmas,'awal'=>$awal]);
	}
	public function actionGetLaporanHarianYm($start='',$end='',$search='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$awal = date('Y-m-d',strtotime($start));
			$stokyanmas = ApotekStokopname::find()->joinWith(['obat as ob'])->where(['tanggal'=>$start])->andWhere(['ob.idjenisobat'=>$search])->orderBy(['stokakhir' => SORT_ASC])->all();
		}else{
			$awal = date('Y-m-d');
			$stokyanmas = ApotekStokopname::find()->joinWith(['obat as ob'])->where(['tanggal'=>date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))))])->andWhere(['ob.idjenisobat'=>4])->orderBy(['stokakhir' => SORT_ASC])->all();
		}
		return $this->renderAjax('get-laporanharian-ym',['stokyanmas'=>$stokyanmas,'awal'=>$awal]);
	}
	public function actionPrintlaporan($start='',$end='',$search='',$cek='')
	{
		if($start !== '' && $end !== '' && $cek !== ''){
			$awal = date('Y-m-d',strtotime($start));
			$stokyanmas = ApotekStokopname::find()->joinWith(['obat as ob'])->where(['tanggal'=>$start])->andWhere(['ob.idjenisobat'=>$search])->orderBy(['ob.namaobat' => SORT_ASC])->all();
		}else{
			$awal = date('Y-m-d');
			$stokyanmas = ApotekStokopname::find()->joinWith(['obat as ob'])->where(['tanggal'=>date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))))])->andWhere(['ob.idjenisobat'=>4])->orderBy(['ob.namaobat' => SORT_ASC])->all();
		}
        $content = $this->renderPartial('reportharian',['stokyanmas'=>$stokyanmas,'awal'=>$awal]);
		
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
                'SetFooter'=>[$footer],
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
	public function actionDetailLaporanObat($id){
		$stokopname = ApotekStokopname::find()->where(['id'=>$id])->one();
		return $this->render('detaillaporanobat',[
			'stokopname'=>$stokopname,
		]);
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
				$radid->dari = 'Farmasi';
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

                        return $this->redirect(['/apotek/reviewpembelian/'.$radid->id]);

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

	 public function actionReviewpembelian($id)
    {
		$model = $this->findBeli($id);
        return $this->render('reviewpembelian', [
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
public function actionView($id,$start='',$end='',$cek='')
    {
		
		$model = $this->findModel($id);
		if($start !== '' && $end !== '' && $cek !== ''){	
		$trxresep = Trxresep::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tanggal)'=>$start])->andwhere(['YEAR(tanggal)'=>$end])->sum('jumlah');
		$trxresepc = Trxresep::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tanggal)'=>$start])->andwhere(['YEAR(tanggal)'=>$end])->count();				
		if($trxresepc < 1){
			$rata = 0;
			$resep = 0;
			$jumlah = 0 ;
		}else{
			$resep = $trxresepc;
			$jumlah = $trxresep ;
			$rata = $trxresep / $trxresepc;
		}
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/hari?b='.$start.'&y='.$end.'&obat='.$model->id;
		$kartustok = Kartustok::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tgl)'=>$start])->andwhere(['YEAR(tgl)'=>$end])->all();
		}else{
		$trxresep = Trxresep::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tanggal)'=>date('m')])->andwhere(['YEAR(tanggal)'=>date('Y')])->sum('jumlah');
		$trxresepc = Trxresep::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tanggal)'=>date('m')])->andwhere(['YEAR(tanggal)'=>date('Y')])->count();				
		if($trxresepc < 1){
			$rata = 0;
			$resep = 0;
			$jumlah = 0 ;
		}else{
			$resep = $trxresepc;
			$jumlah = $trxresep ;
			$rata = $trxresep / $trxresepc;
		}

			
		$kartustok = Kartustok::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tgl)'=>date('m')])->andwhere(['YEAR(tgl)'=>date('Y')])->all();
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/hari?b='.date('m').'&y='.date('Y').'&obat='.$model->id;
		}
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		
        return $this->render('view', [
            'rata' => $rata,
            'jumlah' => $jumlah,
            'resep' => $resep,
            'model' => $model,
            'json2' => $json2,
            'kartustok' => $kartustok,
        ]);
    }
public function actionGetSearch($id,$start='',$end='',$cek='')
    {
		
		$model = $this->findModel($id);
		if($start !== '' && $end !== '' && $cek !== ''){	
		$trxresep = Trxresep::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tanggal)'=>$start])->andwhere(['YEAR(tanggal)'=>$end])->sum('jumlah');
		$trxresepc = Trxresep::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tanggal)'=>$start])->andwhere(['YEAR(tanggal)'=>$end])->count();				
		if($trxresepc < 1){
			$rata = 0;
			$resep = 0;
			$jumlah = 0 ;
		}else{
			$resep = $trxresepc;
			$jumlah = $trxresep ;
			$rata = $trxresep / $trxresepc;
		}
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/hari?b='.$start.'&y='.$end.'&obat='.$model->id;
		$kartustok = Kartustok::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tgl)'=>$start])->andwhere(['YEAR(tgl)'=>$end])->all();
		}else{
		$trxresep = Trxresep::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tanggal)'=>date('m')])->andwhere(['YEAR(tanggal)'=>date('Y')])->sum('jumlah');
		$trxresepc = Trxresep::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tanggal)'=>date('m')])->andwhere(['YEAR(tanggal)'=>date('Y')])->count();				
		if($trxresepc < 1){
			$rata = 0;
			$resep = 0;
			$jumlah = 0 ;
		}else{
			$resep = $trxresepc;
			$jumlah = $trxresep ;
			$rata = $trxresep / $trxresepc;
		}

			
		$kartustok = Kartustok::find()->where(['idobat'=>$model->id])->andwhere(['MONTH(tgl)'=>date('m')])->andwhere(['YEAR(tgl)'=>date('Y')])->all();
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/hari?b='.date('m').'&y='.date('Y').'&obat='.$model->id;
		}
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		
        return $this->renderAjax('search', [
			'rata' => $rata,
            'jumlah' => $jumlah,
            'resep' => $resep,
            'model' => $model,
            'json2' => $json2,
			 'kartustok' => $kartustok,
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

        if ($model->load(Yii::$app->request->post())) {
			$model->ket = 40400;
			if( $model->save()){
				return $this->redirect(['index']);
			}else{
				return $this->render('create', [
                'model' => $model,
            ]);
			}
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	 public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                if($model->idjenisobat == 4){
                    return $this->redirect(['index']);
                }else{
                     return $this->redirect(['index-bpjs']);
                }
            }
           
        }

        return $this->render('update', [
            'model' => $model,
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
  //PRint
  
	public function actionPrintlaporanBpjs($tanggal='')
	{
		$stokyanmas = ApotekStokopname::find()->joinWith(['obat as ob'])->where(['tanggal'=>$tanggal])->andWhere(['ob.idjenisobat'=>5])->orderBy(['stokakhir' => SORT_ASC])->all();
        $content = $this->renderPartial('reportharianbpjs',['stokyanmas'=>$stokyanmas]);
		
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
                'SetFooter'=>[$footer],
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
	 protected function findDbeli($id)
    {
        if (($model = Itembeli::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
