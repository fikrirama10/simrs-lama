<?php

namespace backend\controllers;

use Yii;
use common\models\Aidobc;
use common\models\AidobcSearch;
use yii\base\Model;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AidobcController implements the CRUD actions for Aidobc model.
 */
class VaksinController extends Controller
{
	public function get_content($url, $post = '') {
		
		// $data = "29250";
		// $secretKey = "5lQ5E30F4C";
		$data = "29855";
		$secretKey = "3rU307868B";
         // Computes the timestamp
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        // Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
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
    public function actionIndex()
    {
        return $this->render('index');
    }
	public function actionShow($tgl,$vaksin){
		$response = $this->get_content('https://daftarsulaiman.rsausulaiman.com/rest/peserta-vaksin?tgl='.$tgl.'&vaksin='.$vaksin);
		$kuota = json_decode($response, true);
		// return print_r($kuota);
		return $this->renderAjax('show',[
			'kuota'=>$kuota,
			'tgl'=>$tgl,
			'vaksin'=>$vaksin,
		]);
	}
	public function actionPrint($tgl,$vaksin){
		$response = $this->get_content('https://daftarsulaiman.rsausulaiman.com/rest/peserta-vaksin?tgl='.$tgl.'&vaksin='.$vaksin);
		$kuota = json_decode($response, true);
		$content = $this->renderPartial('print',[
			'kuota' => $kuota,
			'tgl'=>$tgl,
			'vaksin'=>$vaksin,
		]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4,
	   'marginTop' => '3',
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 
	   'marginLeft' => '4',
	   'marginRight' => '4',
	   'marginBottom' => '3',
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
	   //'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	}
}
