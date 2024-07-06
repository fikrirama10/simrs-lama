<?php

namespace backend\controllers;
use Yii;
use common\models\Pasien;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SepController extends Controller
{
	
	public function actionSep()
    {
        
		$query = Pasien::find()->all();
		$arrdip= json_encode(array(
			   
           "request" => array(
              "t_sep" => array(
                 "noKartu"=> "0000053066182",
                 "tglSep"=> "2018-11-02",
                 "ppkPelayanan"=> "0120R012",
                 "jnsPelayanan"=> "2",
                 "klsRawat"=> "",
                 "noMR"=> "069817",
                 "rujukan"=>array(
                    "asalRujukan"=> "1",
                    "tglRujukan"=> "2018-10-17",
                    "noRujukan"=> "103018",
                    "ppkRujukan"=> "0120B114"
                 ),
                 "catatan"=> "test",
                 "diagAwal"=> "A00.1",
                 "poli"=> array(
                    "tujuan"=> "INT",
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
                    "noSurat"=> "000002",
                    "kodeDPJP"=> "31661"
                 ),
                 "noTelp"=> "00898928992",
                 "user"=> "Fikri "
              )
           )
        ));

		
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
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
		curl_setopt($ch, CURLOPT_POSTFIELDS, $arrdip);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
       // $data_json=json_decode($result, true);
		$dd = print_r($data_json['response']['sep']['noSep']);
         //echo $dd;
         return $this->redirect(['tes/'.$dd]);
		    }
		}


?>