<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

use common\models\RawatjalanSearch;

class TesController extends Controller
{
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
	
	public function actionPeserta(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$time = date('Y-m-d');
		$nokartu ='00';
		$response=$this->get_content('https://api.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$data_json=json_decode($response, true);
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		return $data_json;
	}
	public function actionPasien($id){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$response=$this->get_content('https://simrs.rsausulaiman.com/api/pasien?id='.$id);
		$data_json=json_decode($response, true);
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		return $data_json;
	}
	public function actionPolii($id){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$time = date('Y-m-d');
		
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/poli/'.$id.'');
		$data_json=json_decode($response, true);
		$dd = $data_json['response']['poli'];
		return $data_json;
		// echo"<option value='0'>- Pilih Poli -</option>";
		// for($a=0; $a < count($dd); $a++)
		// {
	     // echo"<option value='".$dd[$a]['kode']."'>".$dd[$a]['nama']."</option>";
   
		// }
	}
	public function actionSep(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$time = date('Y-m-d');
		$noSEP ='0120R0121118V000044';
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/SEP/'.$noSEP.'');
		$data_json=json_decode($response, true);
		return $data_json;
	}
	public function actionPpkpel($id){
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$time = date('Y-m-d');
		
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/faskes/'.$id.'/1');
		$data_json=json_decode($response, true);
		$dd = $data_json['response']['faskes'];
		echo"<option value='0'>- Pilih Faskes -</option>";
		for($a=0; $a < count($dd); $a++)
		{
	     echo"<option value='".$dd[$a]['kode']."'>".$dd[$a]['nama']."</option>";
   
		}
	}
	public function actionRujukan(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$norujuk ='0001260192778';
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest//Rujukan/List/Peserta/0001003754294');
		$data_json=json_decode($response, true);
		//$rujukan = $data_json['response'];
	
		return $data_json ;
	}
	public function actionRujukanlist(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$noka ='0000053066182';
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/monitoring/HistoriPelayanan/NoKartu/0000053066182/tglMulai/2018-10-01/tglAkhir/2018-11-07');
		$data_json=json_decode($response, true);
		//$rujukan = $data_json['response'];
		return $data_json ;
	}
	public function actionKelasrawat(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$noka ='0000053066182';
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/kelasrawat');
		$data_json=json_decode($response, true);
		return $data_json['response']['list'];
	}

	public function actionDpjp(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$time = date('Y-m-d');
		$response=$this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/dokter/pelayanan/1/tglPelayanan/'.$time.'/Spesialis/');
		$data_json=json_decode($response, true);
		return $data_json['response']['list'];
	}

	public function actionDiagnosa(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$diagnosa = 'B00';
		$response = $this->get_content('http://icd10api.com/?s=a01&desc=short&r=json');
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['Search'];
		$nama = $diagnosa;
		return $diagnosa;
	}
	
	public function actionTindakan(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$diagnosa = '21.1';
		$response = $this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/procedure/'.$diagnosa.'');
		$data_json = json_decode($response, true);
		$tindakan = $data_json['response'];
		$tind = $tindakan['procedure'];
		return $tind;
	}
	
	public function actionLda($id)
	  {
		$response = $this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/diagnosa/'.$id.'');
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['response'];
		$dd= $diagnosa['diagnosa'];
		echo"<option value='0'>- Pilih Diagnosa -</option>";
		for($a=0; $a < count($dd); $a++)
		{
	     echo"<option value='".$dd[$a]['nama']."'>".$dd[$a]['nama']."</option>";
   
		}
	  }
	
	public function actionListdiagnosa($id)
	  {
		$response = $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/referensi/diagnosa/'.$id.'');
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['response'];
		$dd= $diagnosa['diagnosa'];
		echo"<option value='0'>- Pilih Diagnosa -</option>";
		for($a=0; $a < count($dd); $a++)
		{
	     echo"<option value='".$dd[$a]['nama']."'>".$dd[$a]['nama']."</option>";
   
		}
	  }
	  public function actionListicd($id)
	  {
		// $response = $this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/diagnosa/'.$id.'');
		$response = $this->get_content('https://simrs.rsausulaiman.com/api/icd?id='.$id);
		$data_json = json_decode($response, true);
		$dd= $data_json;
		echo"<option value='0'>- Pilih Diagnosa -</option>";
		for($a=0; $a < count($dd); $a++)
		{
	     echo"<option value='".$dd[$a]['Kode']."'>".$dd[$a]['Kode'].' - '.$dd[$a]['Icd']."</option>";
   
		}
	  }
	  	public function actionTabdig($id)
	  {
		$response = $this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/diagnosa/'.$id);
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['response'];
		$dd= $diagnosa['diagnosa'];
		
		for($a=0; $a < count($dd); $a++)
		{
		echo $dd[$a]['nama'];
	   
		}
	
	  }
	  public function actionListdiag($id)
	  {
		$response = $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/referensi/diagnosa/'.$id.'');
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['response'];
		$dd= $diagnosa['diagnosa'];
		echo"<option value='0'>- Pilih Diagnosa -</option>";
		for($a=0; $a < count($dd); $a++)
		{
	     echo"<option value='".$dd[$a]['nama']."'>".$dd[$a]['nama']."</option>";
   
		}
	  }
	   public function actionListdiagranap($id)
	  {
		$response = $this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/diagnosa/'.$id.'');
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['response'];
		$dd= $diagnosa['diagnosa'];
		echo"<option value='0'>- Pilih Diagnosa -</option>";
		for($a=0; $a < count($dd); $a++)
		{
	     echo"<option value='".$dd[$a]['nama']."'>".$dd[$a]['nama']."</option>";
   
		}
	  }
	  public function actionListtindakan($id)
	  {
		$response = $this->get_content('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/referensi/procedure/'.$id.'');
		$data_json = json_decode($response, true);
		$tindakan = $data_json['response'];
		$tind = $tindakan['procedure'];
		echo"<option value='0'>- Pilih Tindakan -</option>";
		for($a=0; $a < count($tind); $a++)
		{
	     echo"<option value='".$tind[$a]['nama']."'>".$tind[$a]['nama']."</option>";
   
		}
	  }
	
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
}