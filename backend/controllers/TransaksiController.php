<?php

namespace backend\controllers;

use Yii;
use kartik\mpdf\Pdf;
use common\models\Rawatjalan;
use common\models\Trandetail;
use common\models\Transaksi;
use common\models\Tarif;
use common\models\TransaksiSearch;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Tindakandokter;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class TransaksiController extends Controller
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


public function actionRajal($start='', $end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];			
		}else{
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
		}
		$transaksi = Transaksi::find()->where($where)->andwhere(['idjenisrawat'=>1])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->all();
		return $this->render('rajal',[
			'transaksi'=>$transaksi,
			'tar'=>$tar,
		]);
	}
	public function actionGetLihatUmum($start='', $end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];	
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi?awal='.$start.'&akhir='.$end.'&jbayar='.$search;			
			$andWhere = ['idbayar'=>$search];			
		}else{
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi?awal='.$start.'&akhir='.$end.'&jbayar='.$search;
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
		}
		
        $content2 = Yii::$app->kazo->fetchApiData($url2);
        $transaksi = json_decode($content2, true);
        // return $transaksi;
		//$transaksi = Transaksi::find()->where($where)->andwhere($andWhere)->andwhere(['idjenisrawat'=>1])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->all();
		 return $this->renderAjax('searchlihat', [
			'transaksi'=>$transaksi,
			'tar'=>$tar,
		]);
	}
    public function actionReport($start='', $end='', $cek='', $search='')
	{
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];	
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi?awal='.$start.'&akhir='.$end.'&jbayar='.$search;			
			$andWhere = ['idbayar'=>$search];	
			
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = $jp.' Periode '.$start.' s/d '.$end;			
		}else{
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi?awal='.$start.'&akhir='.$end.'&jbayar='.$search;
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = $jp.' <br> '.$start.'s/d'.$end;			
		}
		
        $content2 = Yii::$app->kazo->fetchApiData($url2);
        $transaksi = json_decode($content2, true);
		//$transaksi = Transaksi::find()->where($where)->andwhere($andWhere)->andwhere(['idjenisrawat'=>1])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->orderBy(['jenistarif'=>SORT_ASC])->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report', 
		[
			'transaksi'=>$transaksi,
			'tar'=>$tar,
			'title'=>$title,
		]);
		
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
	
	public function actionUgd($start='', $end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];			
		}else{
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
		}
		$transaksi = Transaksi::find()->where($where)->andwhere(['idjenisrawat'=>3])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->all();
		return $this->render('ugd',[
			'transaksi'=>$transaksi,
			'tar'=>$tar,
		]);
	}
	public function actionGetLihatugdUmum($start='', $end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];	
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi-ugd?awal='.$start.'&akhir='.$end.'&jbayar='.$search;			
			$andWhere = ['idbayar'=>$search];			
		}else{
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi-ugd?awal='.$start.'&akhir='.$end.'&jbayar='.$search;
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
		}
		
        $content2 = Yii::$app->kazo->fetchApiData($url2);
        $transaksi = json_decode($content2, true);
		//$transaksi = Transaksi::find()->where($where)->andwhere($andWhere)->andwhere(['idjenisrawat'=>1])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->all();
		 return $this->renderAjax('searchugd', [
			'transaksi'=>$transaksi,
			'tar'=>$tar,
		]);
		
	}
	public function actionReportUgd($start='', $end='', $cek='', $search='')
	{
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];	
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi-ugd?awal='.$start.'&akhir='.$end.'&jbayar='.$search;			
			$andWhere = ['idbayar'=>$search];	
			
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = $jp.' Periode '.$start.' s/d '.$end;			
		}else{
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi-ugd?awal='.$start.'&akhir='.$end.'&jbayar='.$search;
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = $jp.' <br> '.$start.'s/d'.$end;			
		}
		
        $content2 = Yii::$app->kazo->fetchApiData($url2);
        $transaksi = json_decode($content2, true);
		//$transaksi = Transaksi::find()->where($where)->andwhere($andWhere)->andwhere(['idjenisrawat'=>1])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report-ugd', 
		[
			'transaksi'=>$transaksi,
			'tar'=>$tar,
			'title'=>$title,
		]);
		
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
	
	
	public function actionRanap($start='', $end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];			
		}else{
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
		}
		$transaksi = Transaksi::find()->where($where)->andwhere(['idjenisrawat'=>2])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->all();
		return $this->render('ranap',[
			'transaksi'=>$transaksi,
			'tar'=>$tar,
		]);
	}
		public function actionGetLihatranapUmum($start='', $end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];	
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi-ranap?awal='.$start.'&akhir='.$end.'&jbayar='.$search;			
			$andWhere = ['idbayar'=>$search];			
		}else{
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi-ranap?awal='.$start.'&akhir='.$end.'&jbayar='.$search;
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
		}
		
        $content2 = Yii::$app->kazo->fetchApiData($url2);
        $transaksi = json_decode($content2, true);
		//$transaksi = Transaksi::find()->where($where)->andwhere($andWhere)->andwhere(['idjenisrawat'=>1])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->all();
		 return $this->renderAjax('searchranap', [
			'transaksi'=>$transaksi,
			'tar'=>$tar,
		]);
	}
	
	public function actionReportRanap($start='', $end='', $cek='', $search='')
	{
		if($start !== '' && $end !== '' && $cek !== ''){
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'tglbayar', $start, $end];	
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi-ranap?awal='.$start.'&akhir='.$end.'&jbayar='.$search;			
			$andWhere = ['idbayar'=>$search];	
			
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = $jp.' Periode '.$start.' s/d '.$end;			
		}else{
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/transaksi-ranap?awal='.$start.'&akhir='.$end.'&jbayar='.$search;
			$where = ['between', 'tglbayar', date('Y-m-d'), date('Y-m-d')];		
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = $jp.' <br> '.$start.'s/d'.$end;			
		}
		
        $content2 = Yii::$app->kazo->fetchApiData($url2);
        $transaksi = json_decode($content2, true);
		//$transaksi = Transaksi::find()->where($where)->andwhere($andWhere)->andwhere(['idjenisrawat'=>1])->all();
		$tar = Tarif::find()->groupBy('jenistarif')->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report-ranap', 
		[
			'transaksi'=>$transaksi,
			'tar'=>$tar,
			'title'=>$title,
		]);
		
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
	public function get_content($url, $post = '') {
		
		
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = 'Content-Type: application/json;charset=utf-8';
		$header[] = "Accept-Encoding: gzip, deflate";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		// curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

		if ($post)
		{
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$rs = curl_exec($ch);
		
		if(empty($rs)){
			//var_dump($rs, curl_error($ch));
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return $rs;
	}
    protected function findModel($id)
    {
        if (($model = Transaksi::findOne($id)) !== null) {
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
