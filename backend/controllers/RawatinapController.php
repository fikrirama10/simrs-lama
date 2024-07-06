<?php

namespace backend\controllers;

use Yii;
use common\models\PemeriksaanIgd;
use common\models\PemeriksaanawalRanap;
use common\models\Rawatjalan;
use common\models\Lab;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Tindakandokter;
use common\models\Rxfisik;
use common\models\Rxlabor;
use common\models\Diagnosa;
use common\models\Pekerjaan;
use common\models\Pasien;
use common\models\Kamar;
use kartik\mpdf\Pdf;
use common\models\RawatjalanSearch;
use common\models\Diagnosaranap;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class RawatinapController extends Controller
{
	   
	 public function actionPulang($id){
		 $model = $this->findModel($id);
		 if ($model->load(Yii::$app->request->post())) {
			
			if($model->save(false)){
			  
				 return $this->redirect(['rawatinap/keluarkamar/'.$id]);
			}
			else
			{	
				return $this->render('pulang', ['model' => $model]);
			}
			
		   
		} else {
			return $this->render('pulang', ['model' => $model]);
		
		}
		  return $this->render('pulang', [
            'model' => $model,
        ]);
		 
	 }
   
	public function actionView($id)
    {
		//$rrr = Rawatjalan::find()->where(['id'=>$id])->one();
		$model = $this->findModel($id);
		$dranap = new Diagnosaranap();
		
		
		if ($dranap->load(Yii::$app->request->post())) {
			$dranap->tgl =  date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			$dranap->pemeriksa = $model->iddokter;
			$dranap->idjenisrawat = 2;
			if($dranap->save(false)){
			  
				 return $this->redirect(['rawatinap/'.$id]);
			}
			else
			{	
				return $this->render('view', ['model' => $this->findModel($id),'dranap'=>$dranap,]);
			}
			
		   
		} else {
			return $this->render('view', ['model' => $this->findModel($id),'dranap'=>$dranap,]);
		
		}
		
		//$model = Rawatjalan::find()->where(['id'])
        return $this->render('view', [
            'model' => $model,
			'dranap'=> $dranap,
            
        ]);
		
    
    }
    	public function actionView2($id)
    {
		//$rrr = Rawatjalan::find()->where(['id'=>$id])->one();
		$model = $this->findModel($id);
		$dranap = new Diagnosaranap();
		
		
		if ($dranap->load(Yii::$app->request->post())) {
			$dranap->tgl =  date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			$dranap->pemeriksa = $model->iddokter;
			$dranap->idjenisrawat = 2;
			if($dranap->save(false)){
			  
				 return $this->redirect(['rawatinap/'.$id]);
			}
			else
			{	
				return $this->render('view2', ['model' => $this->findModel($id),'dranap'=>$dranap,]);
			}
			
		   
		} else {
			return $this->render('view2', ['model' => $this->findModel($id),'dranap'=>$dranap,]);
		
		}
		
		//$model = Rawatjalan::find()->where(['id'])
        return $this->render('view2', [
            'model' => $model,
			'dranap'=> $dranap,
            
        ]);
		
    
    }
    public function actionLabinap($id)
    {
		$model = $this->findModel($id);
		
		$labora = new Lab();
		//$resepdokter = new Resepdokter();
		
		if ($labora->load(Yii::$app->request->post())) {
			$labora->tanggal_req =  date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$labora->idtkp = 2;
			if($labora->save()){
			  
				 return $this->redirect(['rawatinap/labinap/'.$id]);
			}
			else
			{	
				return $this->render('labinap', ['labora' => $labora,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('labinap', ['labora' => $labora,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('labinap', [
            'model' => $this->findModel($id),
			'labora'=>$labora,
        ]);
    }	
	public function actionCreateresep($id)
    {
		$model = $this->findModel($id);
		$resepdokter = new Resepdokter();
		
		if ($resepdokter->load(Yii::$app->request->post())) {
			$resepdokter->tanggal = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			$resepdokter->idtkp = 2 ;
			$resepdokter->no_rekmed = $model->no_rekmed;
			if($resepdokter->save()){
			  
				 return $this->redirect(['rawatinap/createresep/'.$id]);
			}
			else
			{	
				return $this->render('createresep', ['model' => $this->findModel($id),'resepdokter'=>$resepdokter,]);
			}
			
		   
		} else {
			return $this->render('createresep', ['model' => $this->findModel($id),'resepdokter'=>$resepdokter,]);
		
		}
		
        return $this->render('createresep', [
            'model' => $this->findModel($id),
			'resepdokter'=>$resepdokter,
        ]);
    }
          public function actionKeluarkamar($id)
    {
        $model = $this->findModel($id);
		$kamar = Kamar::find()->where(['id' => $model->idruangan])->one();
		
		$lamarawat = strtotime($model->tglkeluar) - strtotime($model->tglmasuk);
		$model->lamarawat = floor($lamarawat/86400) + 1;
		//$kamar->masuk-- ;
		$model->status = 7;
		//$kamar->save();
		if($model->save(false)){
			$ht = Rawatjalan::find()->where(['idruangan'=>$kamar->id])->andwhere(['status'=>8])->andwhere(['idjenisrawat'=>2])->count();
			$tersedia = $kamar->tempattidur - $ht;
			if($tersedia < 1){
				$tersedia = 0;
			}
			
			if($kamar->gender == 2){
				$arrdip= json_encode(array(			  
					"kodekelas"=>$kamar->kodekelas, 
					"koderuang"=>$kamar->kodekamar, 
					"namaruang"=>"Ruang ". $kamar->namaruangan, 
					"kapasitas"=>$kamar->tempattidur, 
					"tersedia"=>$tersedia,
					"tersediapria"=>"0", 
					"tersediawanita"=>$tersedia, 
					"tersediapriawanita"=>"0"
				));
			}else if($kamar->gender == 3){
				
				$arrdip= json_encode(array(			  
					"kodekelas"=>$kamar->kodekelas, 
					"koderuang"=>$kamar->kodekamar, 
					"namaruang"=>"Ruang ". $kamar->namaruangan, 
					"kapasitas"=>$kamar->tempattidur, 
					"tersedia"=>$tersedia,
					"tersediapria"=>$tersedia, 
					"tersediawanita"=>"0", 
					"tersediapriawanita"=>"0"
				));
			}else{
				$arrdip= json_encode(array(			  
					"kodekelas"=>$kamar->kodekelas, 
					"koderuang"=>$kamar->kodekamar, 
					"namaruang"=>"Ruang ". $kamar->namaruangan, 
					"kapasitas"=>$kamar->tempattidur, 
					"tersedia"=>$tersedia,
					"tersediapria"=>"0", 
					"tersediawanita"=>"0", 
					"tersediapriawanita"=>$tersedia
				));
			}
		$data_string = \yii\helpers\Json::encode($arrdip);
		$data = "29855";
		$secretKey = "3rU307868B";
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
		$header[] = 'Content-Type: application/json;charset=utf-8';
		// $header[] = "Accept-Encoding: gzip, deflate";
		// $header[] = "Cache-Control: max-age=0";
		// $header[] = "Connection: keep-alive";
		// $header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		// $header[] = "Content-Length: " . strlen($data_string) ." ";
    
		
		$ch = curl_init("https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/0120R012");
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
		$result=json_decode($result, true);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		//$data_string = json_encode($arrdip, true);
		// echo print_r($result);
		// echo print_r($arrdip);
        return $this->redirect(['keperawatan/index/']);
    }
	}
	public function actionCreatetindakan($id)
    {
       
       $model = $this->findModel($id);
		$tindakandokter = new Tindakandokter();
		if ($tindakandokter->load(Yii::$app->request->post())) {
			$tindakandokter->tgl = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			$tindakandokter->idtkp = 2 ;
			$tindakandokter->no_rekmed = $model->no_rekmed;
			if($tindakandokter->save()){
				
				$model->save();
				if(!Yii::$app->request->isAjax){
					return $this->redirect(['createtindakan', 'id' => $model->id]);
				}
			}
			else
			{	
				return $this->render('createtindakan', ['tindakandokter' => $tindakandokter, 'model'=>$model,]);
			}
			
		   
		} else {
			return $this->render('createtindakan', ['tindakandokter' => $tindakandokter, 'model'=>$model,]);
		
		}
		
        return $this->render('createtindakan', [
			'model'=>$model,
            'tindakandokter' => $tindakandokter,
        ]);
    }
	 public function actionDelete($id)
    {
        $tindakan = $this->findTindakan($id);
		$tindakan->delete();
        return $this->redirect(['rawatinap/createtindakan/'.$tindakan->rawatja->id]);
		
    }
	 public function actionDeletediag($id)
    {
        $diagnosa = $this->findDiag($id);
		$diagnosa->delete();
        return $this->redirect(Yii::$app->request->referrer);
		
    }
	 public function actionDeleteobat($id)
    {
        $tindakan = $this->findResep($id);
		$tindakan->delete();
        return $this->redirect(['rawatinap/createresep/'.$tindakan->rawatja->id]);
		
    }
	
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
        if (($model = Tindakandokter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findResep($id)
    {
        if (($model = Resepdokter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findDiag($id)
    {
        if (($model = Diagnosaranap::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}