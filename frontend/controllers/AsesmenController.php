<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Tindakandokter;
use common\models\Rxfisik;
use common\models\Rxlabor;
use common\models\Diagnosa;
use common\models\Asesmenpasien;
use common\models\Pekerjaan;
use common\models\Pasien;
use common\models\Kamar;
use common\models\Rawat;
use common\models\Diagnosapasien;
use common\models\Lograwat;
use kartik\mpdf\Pdf;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class AsesmenController extends Controller
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

	public function actionCreateBrigging(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return array('status'=>true); 
	}
    /**
     * Lists all Rawatjalan models.
     * @return mixed
     */
    public function actionAwalkandungan($id)
    {
		$keluhan = new Keluhan();
		$rxfisik = new Rxfisik();
		$diagnosa = new Diagnosapasien();
		$model = $this->findModel($id);
		if ($keluhan->load(Yii::$app->request->post())
			&&$rxfisik->load(Yii::$app->request->post())

			&&$model->load(Yii::$app->request->post())
			)
			{
			$diagnosa->idrawat = $model->idrawat;
			$diagnosa->rm = $model->no_rekmed;
			$diagnosa->jenis_kelamin = $model->pasien->jenis_kelamin;
			$diagnosa->iddokter = $model->iddokter;
			$diagnosa->idjenisrawat = $model->idjenisrawat;
			$diagnosa->idkel = $model->pasien->idkel;
			$diagnosa->koddiagnosa = $model->kdiagnosa;
			$keluhan->idpemeriksa = $model->iddokter ;
			$model->status = 2 ;	
			$keluhan->idtkp = 1 ;	
			$rxfisik->idtkp = 1 ;	
			if($keluhan->save()){
				$diagnosa->save(false);
				$model->save();
				$rxfisik->save();
						  
				 return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
			}
			else
			{	
				return $this->render('awalkandungan', ['keluhah' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
			}
			
		   
		} else {
			return $this->render('awalkandungan', ['keluhan' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
		
		}
		
        return $this->render('awalkandungan', [
            'model' => $this->findModel($id),
            'keluhan' => $keluhan,
			'rxfisik'=>$rxfisik,
			
        ]);
	}

		public function actionAwaldalam($id)
    {
		$keluhan = new Keluhan();
		$rxfisik = new Rxfisik();
		$diagnosa = new Diagnosapasien();
		$model = $this->findModel($id);
		if ($keluhan->load(Yii::$app->request->post())
			&&$rxfisik->load(Yii::$app->request->post())

			&&$model->load(Yii::$app->request->post())
			)
			{
			$diagnosa->idrawat = $model->idrawat;
			$diagnosa->rm = $model->no_rekmed;
			$diagnosa->jenis_kelamin = $model->pasien->jenis_kelamin;
			$diagnosa->iddokter = $model->iddokter;
			$diagnosa->idjenisrawat = $model->idjenisrawat;
			$diagnosa->idkel = $model->pasien->idkel;
			$diagnosa->koddiagnosa = $model->kdiagnosa;
			$keluhan->idpemeriksa = $model->iddokter ;
			$model->status = 2 ;	
			$keluhan->idtkp = 1 ;	
			$rxfisik->idtkp = 1 ;	
			if($keluhan->save()){
				$diagnosa->save(false);
				$model->save();
				$rxfisik->save();
						  
				 return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
			}
			else
			{	
				return $this->render('awaldalam', ['keluhah' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
			}
			
		   
		} else {
			return $this->render('awaldalam', ['keluhan' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
		
		}
		
        return $this->render('awaldalam', [
            'model' => $this->findModel($id),
            'keluhan' => $keluhan,
			'rxfisik'=>$rxfisik,
			
        ]);
	}
	
	public function actionAwalanak($id)
    {
		$keluhan = new Keluhan();
		$rxfisik = new Rxfisik();
		$diagnosa = new Diagnosapasien();
		$model = $this->findModel($id);
		if ($keluhan->load(Yii::$app->request->post())
			&&$rxfisik->load(Yii::$app->request->post())

			&&$model->load(Yii::$app->request->post())
			)
			{
			$diagnosa->idrawat = $model->idrawat;
			$diagnosa->rm = $model->no_rekmed;
			$diagnosa->jenis_kelamin = $model->pasien->jenis_kelamin;
			$diagnosa->iddokter = $model->iddokter;
			$diagnosa->idjenisrawat = $model->idjenisrawat;
			$diagnosa->idkel = $model->pasien->idkel;
			$diagnosa->koddiagnosa = $model->kdiagnosa;
			$keluhan->idpemeriksa = $model->iddokter ;
			$model->status = 2 ;	
			$keluhan->idtkp = 1 ;	
			$rxfisik->idtkp = 1 ;	
			if($keluhan->save()){
				$diagnosa->save(false);
				$model->save();
				$rxfisik->save();
						  
				 return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
			}
			else
			{	
				return $this->render('awalanak', ['keluhah' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
			}
			
		   
		} else {
			return $this->render('awalanak', ['keluhan' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
		
		}
		
        return $this->render('awalanak', [
            'model' => $this->findModel($id),
            'keluhan' => $keluhan,
			'rxfisik'=>$rxfisik,
			
        ]);
	}
	

	 public function actionAwalgigi($id)
    {
		$keluhan = new Keluhan();
		$rxfisik = new Rxfisik();
		$model = $this->findModel($id);
		if ($keluhan->load(Yii::$app->request->post())
			&&$rxfisik->load(Yii::$app->request->post())

			&&$model->load(Yii::$app->request->post())
			)

			{
			$keluhan->idtkp = 1 ;	
			$rxfisik->idtkp = 1 ;	
			$model->status = 2 ;	
			if($keluhan->save()){
				
				$model->save();
				$rxfisik->save();
						  
				 return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
			}
			else
			{	
				return $this->render('awalgigi', ['keluhah' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
			}
			
		   
		} else {
			return $this->render('awalgigi', ['keluhan' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
		
		}
		
        return $this->render('awalgigi', [
            'model' => $this->findModel($id),
            'keluhan' => $keluhan,
			'rxfisik'=>$rxfisik,
			
        ]);
	}
	
	public function actionAwalbedah($id)
    {
		$keluhan = new Keluhan();
		$rxfisik = new Rxfisik();
		$diagnosa = new Diagnosapasien();
		$model = $this->findModel($id);
		if ($keluhan->load(Yii::$app->request->post())
			&&$rxfisik->load(Yii::$app->request->post())

			&&$model->load(Yii::$app->request->post())
			)
			{
			$diagnosa->idrawat = $model->idrawat;
			$diagnosa->rm = $model->no_rekmed;
			$diagnosa->jenis_kelamin = $model->pasien->jenis_kelamin;
			$diagnosa->iddokter = $model->iddokter;
			$diagnosa->idjenisrawat = $model->idjenisrawat;
			$diagnosa->idkel = $model->pasien->idkel;
			$diagnosa->koddiagnosa = $model->kdiagnosa;
			$keluhan->idpemeriksa = $model->iddokter ;
			$model->status = 2 ;
			$keluhan->idtkp = 1 ;	
			$rxfisik->idtkp = 1 ;	
			if($keluhan->save()){
				$diagnosa->save(false);
				$model->save();
				$rxfisik->save();
						  
				 return $this->redirect(['rawatjalan/tindakdokter/'.$id]);
			}
			else
			{	
				return $this->render('awalbedah', ['keluhah' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
			}
			
		   
		} else {
			return $this->render('awalbedah', ['keluhan' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
		
		}
		
        return $this->render('awalbedah', [
            'model' => $this->findModel($id),
            'keluhan' => $keluhan,
			'rxfisik'=>$rxfisik,
			
        ]);
	}
	
	public function actionAwalranap($id)
    {
		$keluhan = new Keluhan();
		$rxfisik = new Rxfisik();
		$diagnosa = new Diagnosapasien();
		$model = $this->findModel($id);
		if ($keluhan->load(Yii::$app->request->post())
			&&$rxfisik->load(Yii::$app->request->post())

			&&$model->load(Yii::$app->request->post())
			)
			{
			$diagnosa->idrawat = $model->idrawat;
			$diagnosa->rm = $model->no_rekmed;
			$diagnosa->jenis_kelamin = $model->pasien->jenis_kelamin;
			$diagnosa->iddokter = $model->iddokter;
			$diagnosa->idjenisrawat = $model->idjenisrawat;
			$diagnosa->idkel = $model->pasien->idkel;
			$diagnosa->koddiagnosa = $model->kdiagnosa;
			$keluhan->idpemeriksa = $model->iddokter ;
			$keluhan->idtkp = 2 ;	
			$rxfisik->idtkp = 2 ;	
			if($keluhan->save()){
				$diagnosa->save(false);
				$model->save();
				$rxfisik->save();
						  
				 return $this->redirect(['rawatinap/'.$id]);
			}
			else
			{	
				return $this->render('awalranap', ['keluhah' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
			}
			
		   
		} else {
			return $this->render('awalranap', ['keluhan' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
		
		}
		
        return $this->render('awalranap', [
            'model' => $this->findModel($id),
            'keluhan' => $keluhan,
			'rxfisik'=>$rxfisik,
			
        ]);
	}
	

	public function actionAwaligd($id)
    {
		$keluhan = new Keluhan();
		$rxfisik = new Rxfisik();
		$asesmenpasien = new Asesmenpasien();
		$diagnosa = new Diagnosapasien();
		$model = $this->findModel($id);
		if ($keluhan->load(Yii::$app->request->post())
			&&$rxfisik->load(Yii::$app->request->post())
			&&$model->load(Yii::$app->request->post())
			&& Model::validateMultiple([$model,$keluhan,$rxfisik])
			)
			
			{
			$model->status = 2 ;
			$keluhan->idpemeriksa = $model->iddokter ;
			$model->jampemeriksaan = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			$diagnosa->idrawat = $model->idrawat;
			$diagnosa->rm = $model->no_rekmed;
			$diagnosa->jenis_kelamin = $model->pasien->jenis_kelamin;
			$diagnosa->iddokter = $model->iddokter;
			$diagnosa->idjenisrawat = $model->idjenisrawat;
			$diagnosa->idkel = $model->pasien->idkel;
			$model->idverived = Yii::$app->user->identity->id;
			$diagnosa->koddiagnosa = $model->kdiagnosa;
			$keluhan->idtkp = 1 ;	
			$rxfisik->idtkp = 1 ;	
			$asesmenpasien->no_rekmed = $model->no_rekmed;
			$asesmenpasien->tanggal = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			$asesmenpasien->save(false);
			if($keluhan->save()){
				$diagnosa->save(false);
				$model->save();
				$rxfisik->save();
						  
				 return $this->redirect(['rawatjalan/tindakandokter/'.$id]);
			}
			else
			{	
				return $this->render('awaligd', ['keluhah' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
			}
			
		   
		} else {
			return $this->render('awaligd', ['keluhan' => $keluhan,'model' => $model,'rxfisik'=>$rxfisik,]);
		
		}
		
        return $this->render('awaligd', [
            'model' => $this->findModel($id),
            'keluhan' => $keluhan,
			'rxfisik'=>$rxfisik,
			
        ]);
	}
	public function actionIgdrawat($id)
    {
		$rawat = new Rawat;
		$model = $this->findModel($id);
		if ($rawat->load(Yii::$app->request->post())		
			){
			$rawat->idp = 3;
			$rawat->waktudikirim = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			$rawat->status = "Pending"; 
			
		
			if($rawat->save(false)){
				  
				 return $this->redirect(['asesmen/logg/'.$id]);
			}
			else
			{	
				return $this->render('igdrawat', ['rawat' => $rawat,'model' => $model,]);
			}
			
		   
		} else {
			return $this->render('igdrawat', ['rawat' => $rawat,'model' => $model,]);
		
		}
		
        return $this->render('igdrawat', [
            'model' => $this->findModel($id),
            'rawat' => $rawat,
			
			
			
        ]);
	}
	public function actionPolirawat($id)
    {
		$rawat = new Rawat;
		$model = $this->findModel($id);
		if ($rawat->load(Yii::$app->request->post())		
			){
			$rawat->idp = 2;
			$rawat->idpoli = $model->idpoli ;
			$rawat->waktudikirim = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			$rawat->status = "Pending"; 
			
		
			if($rawat->save(false)){
				  
				 return $this->redirect(['asesmen/logg/'.$id]);
			}
			else
			{	
				return $this->render('polirawat', ['rawat' => $rawat,'model' => $model,]);
			}
			
		   
		} else {
			return $this->render('polirawat', ['rawat' => $rawat,'model' => $model,]);
		
		}
		
        return $this->render('polirawat', [
            'model' => $this->findModel($id),
            'rawat' => $rawat,
			
			
			
        ]);
	}
	public function actionLogg($id){
		$model = $this->findModel($id);
		$lograwat = new Lograwat;
		$lograwat->idrawat = $model->idrawat;
		$lograwat->rm = $model->no_rekmed;
		if($model->idpoli == null){
			$lograwat->jenis = $model->jerawat->jenisrawat;
		}else{
		$lograwat->jenis = $model->polii->namapoli;
		}
		$lograwat->waktu = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
		$lograwat->save();
		return $this->redirect(['rawatjalan/igd']);
	}
	 public function actionUpdate($id)
    {
       
	   $model = $this->findModel($id);
	   $keluhan = Keluhan::find()->where(['kode_p' => $model->idrawat])->one();
	   $rxfisik = Rxfisik::find()->where(['no_rawat' => $model->idrawat])->one();
		
        if ($model->load(Yii::$app->request->post()) 
			&& $keluhan->load(Yii::$app->request->post())
			&& $rxfisik->load(Yii::$app->request->post())
		) {
			$model->idverived = Yii::$app->user->identity->id;
			if($model->save(false)){
			   $keluhan->save(false);
			   $rxfisik->save(false);
				if($model->status == 2){
					return $this->redirect(['/rawatjalan/tindakandokter/'.$model->id.'']);
				}else{
				 return $this->redirect(['/rawatjalan/terapi/'.$model->id.'']);
				}
			}
			else
			{
				
				return $this->render('update', ['model' => $model,'keluhan' => $keluhan,'rxfisik'=>$rxfisik,]);
			 }
			
			
			
           
        } else {
			return $this->render('update', ['model' => $model,'keluhan' => $keluhan,'rxfisik'=>$rxfisik,]);
        
		}
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
}
