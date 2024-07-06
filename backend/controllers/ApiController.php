<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ApitesController extends \yii\rest\Controller
{
    
 
	
	public function actionLapbul(){
		$rajal = Rawatjalan::find()->where(['idpoli'=>$poli])->andwhere(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end])->all();
		
		return [
			'data'=>$rajal,
		];
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
			'tStamp'=>$tStamp,
			
        ]);
   }

}