<?php

namespace backend\controllers;

use Yii;
use common\models\Csep;
use common\models\Pasien;
use common\models\CsepSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
/**
 * CsepController implements the CRUD actions for Csep model.
 */
class CsepController extends Controller
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
     * Lists all Csep models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CsepSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Csep model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$pasien = Pasien::find()->where(['nobpjs'=>$model->noKartu])->one();
		$time = $model->tglSEP;
		$nokartu = $model->noKartu;
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$response2=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/faskes/'.$model->ppkPelayanan.'/1');
		$data_json=json_decode($response, true);
		$data_json2 = json_decode($response2, true);
		$ppk1 = $data_json2['response'];
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		$kelas2 = $ppk1['faskes'];
		if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				return $this->redirect(['/csep/seprajal/'.$model->id]);
			}
			else
			{	
			return $this->render('view', [  
			'model' => $model,
			'kelas' => $kelas,
			'kelas2' => $kelas2,
			'pasien' => $pasien,]);
			}  
		} else {
			return $this->render('view', [
            'model' => $model,
			'kelas' => $kelas,
			'pasien' => $pasien,
			'kelas2' => $kelas2,
        ]);
		}
       
    }
	  public function actionMenuranap($id)
    {
		$model = $this->findModel($id);
		$pasien = Pasien::find()->where(['nobpjs'=>$model->noKartu])->one();
		$time = $model->tglSEP;
		$nokartu = $model->noKartu;
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$response2=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/faskes/'.$model->ppkPelayanan.'/1');
		$data_json=json_decode($response, true);
		$data_json2 = json_decode($response2, true);
		$ppk1 = $data_json2['response'];
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		$kelas2 = $ppk1['faskes'];
		if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				return $this->redirect(['/csep/sepranap/'.$model->id]);
			}
			else
			{	
			return $this->render('menuranap', [  
			'model' => $model,
			'kelas2' => $kelas2,
			'kelas' => $kelas,
			'pasien' => $pasien,]);
			}  
		} else {
			return $this->render('menuranap', [
            'model' => $model,
			'kelas2' => $kelas2,
			'kelas' => $kelas,
			'pasien' => $pasien,
        ]);
		}
       
    }
	public function actionSeprajal($id)
    {
		$model = $this->findModel($id);
		$arrdip=array(
			   
            "request" => array(
              "t_sep" => array(
                 "noKartu"=> $model->noKartu,
                 "tglSep"=> $model->tglSEP,
                 "ppkPelayanan"=> "0120R012",
                 "jnsPelayanan"=> $model->jnsPelayanan,
                 "klsRawat"=> $model->kelas,
                 "noMR"=> $model->noMR,
                 "rujukan"=>array(
                    "asalRujukan"=> "1",
                    "tglRujukan"=> $model->tglRujukan,
                    "noRujukan"=> $model->norujukan,
                    "ppkRujukan"=> $model->ppkPelayanan
                 ),
                 "catatan"=> $model->catatan,
                 "diagAwal"=> $model->dignosa,
                 "poli"=> array(
                    "tujuan"=> $model->spesialis,
                    "eksekutif"=> "0"
                 ),
                 "cob"=>array(
                    "cob"=> "0"
                 ),
                 "katarak"=> array(
                    "katarak"=> "0"
                 ),
                 "jaminan"=> array(
                 	"lakaLantas"=> "0",
                    "penjamin"=>array( 
                        "penjamin"=> "",
                        "tglKejadian"=> "",
                        "keterangan"=> "",
                        "suplesi"=>array( 
                            "suplesi"=> "0",
                            "noSepSuplesi"=> "0",
                            "lokasiLaka"=>array (
                                "kdPropinsi"=> "",
                                "kdKabupaten"=> "",
                                "kdKecamatan"=> ""
                                )
                        )
                    )
                 ),
                 "skdp"=>array(
                    "noSurat"=> $model->noSpri,
                    "kodeDPJP"=> $model->dpjp
                 ),
                 "noTelp"=> $model->noTlp,
                 "user"=> "Fikri "
              )
           )
        );

		
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$data_string = \yii\helpers\Json::encode($arrdip);
		//$data_string = json_encode($arrdip, true);
		$data = "29250";
		$secretKey = "5lQ5E30F4C";
         // Computes the timestamp
        date_default_timezone_set("UTC");
        $tStamp = strval(time()-strtotime("1970-01-01 00:00:00"));
        // Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac("sha256", $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		//$header[] = "Content-Length: " . strlen($data_string) ." ";
    
		
		$ch = curl_init("https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/1.1/insert");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		$data_json=json_decode($result, true);
		//$dd = print_r($data_json['response']['sep']['noSep']);
		// echo  ;
		// return $result;
		
		if($data_json['response'] == null){
			// return;
			$model = $this->findModel($id);
			$pasien = Pasien::find()->where(['nobpjs'=>$model->noKartu])->one();
			$time = $model->tglSEP;
			$nokartu = $model->noKartu;
			$respon=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
			$data_js=json_decode($respon, true);
			$peserta = $data_js['response'];
			$kelas = $peserta['peserta'];
			\Yii::$app->getSession()->setFlash('danger', $data_json['metaData']['message'] );
			return $this->render('view', [  
			'model' => $model,
			'kelas' => $kelas,
			'pasien' => $pasien,]);
		}else{
		$model->noSEP = $data_json['response']['sep']['noSep'];
		$model->save();
		return $this->redirect(['/csep/sep/'.$model->id]);
		}  
    }
	public function actionSepranap($id)
    {
		$model = $this->findModel($id);
		$arrdip=array(
			   
            "request" => array(
              "t_sep" => array(
                 "noKartu"=> $model->noKartu,
                 "tglSep"=> $model->tglSEP,
                 "ppkPelayanan"=> "0120R012",
                 "jnsPelayanan"=> "1",
                 "klsRawat"=> $model->kelas,
                 "noMR"=> $model->noMR,
                 "rujukan"=>array(
                    "asalRujukan"=> '1',
                    "tglRujukan"=> $model->tglRujukan,
                    "noRujukan"=> $model->norujukan,
                    "ppkRujukan"=> $model->ppkPelayanan
                 ),
                 "catatan"=> $model->catatan,
                 "diagAwal"=> $model->dignosa,
                 "poli"=> array(
                    "tujuan"=> "",
                    "eksekutif"=> "0"
                 ),
                 "cob"=>array(
                    "cob"=> "0"
                 ),
                 "katarak"=> array(
                    "katarak"=> "0"
                 ),
                 "jaminan"=> array(
                 	"lakaLantas"=> "0",
                    "penjamin"=>array( 
                        "penjamin"=> "",
                        "tglKejadian"=> "",
                        "keterangan"=> "",
                        "suplesi"=>array( 
                            "suplesi"=> "0",
                            "noSepSuplesi"=> "0",
                            "lokasiLaka"=>array (
                                "kdPropinsi"=> "",
                                "kdKabupaten"=> "",
                                "kdKecamatan"=> ""
                                )
                        )
                    )
                 ),
                 "skdp"=>array(
                    "noSurat"=> $model->noSpri,
                    "kodeDPJP"=> $model->dpjp
                 ),
                 "noTelp"=> $model->noTlp,
                 "user"=> "Fikri "
              )
           )
        );

		
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$data_string = \yii\helpers\Json::encode($arrdip);
		//$data_string = json_encode($arrdip, true);
		$data = "29250";
		$secretKey = "5lQ5E30F4C";
         // Computes the timestamp
        date_default_timezone_set("UTC");
        $tStamp = strval(time()-strtotime("1970-01-01 00:00:00"));
        // Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac("sha256", $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		//$header[] = "Content-Length: " . strlen($data_string) ." ";
    
		
		$ch = curl_init("https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/1.1/insert");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		$data_json=json_decode($result, true);
		//$dd = print_r($data_json['response']['sep']['noSep']);
		// echo  ;
		// return $result;
		
		if($data_json['response'] == null){
			// return;
			$model = $this->findModel($id);
			$pasien = Pasien::find()->where(['nobpjs'=>$model->noKartu])->one();
			$time = $model->tglSEP;
			$nokartu = $model->noKartu;
			$respon=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
			$data_js=json_decode($respon, true);
			$peserta = $data_js['response'];
			$kelas = $peserta['peserta'];
			\Yii::$app->getSession()->setFlash('danger', $data_json['metaData']['message'] );
			return $this->render('menuranap', [  
			'model' => $model,
			'kelas' => $kelas,
			'pasien' => $pasien,]);
		}else{
		$model->noSEP = $data_json['response']['sep']['noSep'];
		$model->save();
		return $this->redirect(['/csep/sep/'.$model->id]);
		}  
    }
	

    /**
     * Creates a new Csep model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	 public function get_content($url, $post = '') {
		
		$data = "29250";
		$secretKey = "5lQ5E30F4C";
         // Computes the timestamp
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        // Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
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
	public function actionDeletesep($id){
		$model = $this->findModel($id);
		$arrdel=array(
			"request"=>array(
			  "t_sep"=>array(
				 "noSep"=> $model->noSEP,
				 "user"=> "Coba Ws"
			  )
		   )
        );

		
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$data_string = \yii\helpers\Json::encode($arrdel);
		//$data_string = json_encode($arrdip, true);
		$data = "29250";
		$secretKey = "5lQ5E30F4C";
         // Computes the timestamp
        date_default_timezone_set("UTC");
        $tStamp = strval(time()-strtotime("1970-01-01 00:00:00"));
        // Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac("sha256", $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		//$header[] = "Content-Length: " . strlen($data_string) ." ";
    
		
		$ch = curl_init("https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/Delete");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		$data_json=json_decode($result, true);
		//$dd = print_r($data_json['response']['sep']['noSep']);
		// echo  ;
		if($data_json['response'] == $model->noSEP){
			\Yii::$app->getSession()->setFlash('success', 'Data Terhapus');
			$this->findModel($id)->delete();
			return $this->redirect(['index']);
		}else{
			echo"error";
		}
		return $result;
		
	
	}
    public function actionCreate($id='')
    {
        $model = new Csep();
		$pasien = Pasien::find()->where(['id'=>$id])->one();
      if($model->load(Yii::$app->request->post())){
		$time = $model->tglSEP;
		$nokartu = $model->noKartu;
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$data_json=json_decode($response, true);
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		if($data_json['response'] == null){
			\Yii::$app->getSession()->setFlash('danger', 'Data Tidak Di Temukan');
        return $this->render("create",['model'=>$model,'kelas'=>$kelas]);
		}else{
		
			if($model->save(false)){
				if($model->jnsPelayanan == 2){
				 return $this->redirect(['view', 'id' => $model->id]);
				}else{
				return $this->redirect(['menuranap', 'id' => $model->id]);	
				}
			}
			else
			{	
				return $this->render('create', ['model' => $model,'pasien'=>$pasien]);
			}
		}
		   
		} else {
			return $this->render('create', ['model' => $model,'pasien'=>$pasien]);
		
		}
	  
    }

    /**
     * Updates an existing Csep model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSep($id)
    {
        $model = $this->findModel($id);
		//$time = $model->tglSEP;
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$noSEP = $model->noSEP;
		$time = $model->tglSEP;
		$nokartu = $model->noKartu;
		$poli = $model->spesialis;
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/'.$noSEP.'');
		$responsekartu=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$responsespesial=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/poli/'.$poli);
		$data_json=json_decode($response, true);
		$data_json2=json_decode($responsekartu, true);
		$data_json3=json_decode($responsespesial, true);
		$repo = $data_json['response'];
		$kelas =  $data_json2['response']['peserta'];
		$spesial =  $data_json3['response']['poli'][0];
		return $this->render('sep', ['model' => $model,'repo'=>$repo,'kelas'=>$kelas,'spesial'=>$spesial['nama']]);
		
	}
	 public function actionPrintsep($id) {
	  //tampilkan bukti proses
		$model = $this->findModel($id);
		//$time = $model->tglSEP;width: 813px; height: 368px;
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$noSEP = $model->noSEP;
		$time = $model->tglSEP;
		$nokartu = $model->noKartu;
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/'.$noSEP.'');
		$responsekartu=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$data_json=json_decode($response, true);
		$data_json2=json_decode($responsekartu, true);
		$repo = $data_json['response'];
		$kelas =  $data_json2['response']['peserta'];
		$content = $this->renderPartial('cetak',['model' => $model,'repo'=>$repo,'kelas'=>$kelas]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'marginTop' => '5mm',
	    'marginLeft' => '10mm',
	   'marginRight' => '10mm',
	   'marginBottom' => '0mm',
	   'format' => [215,97],
	   'orientation' => Pdf::ORIENT_PORTRAIT, 
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/sep.css',
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
     * Deletes an existing Csep model.
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
     * Finds the Csep model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Csep the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Csep::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
