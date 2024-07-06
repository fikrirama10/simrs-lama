<?php

namespace backend\controllers;

use Yii;
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
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class RawatinapController extends Controller
{
	   
   
	 public function actionView($id)
    {
    	$model = $this->findModel($id);
    	if($model->status != 8){
    		return $this->redirect(['keperawatan/']);
    	}else{
		$tindakandokter = new Tindakandokter();
		//$model = Rawatjalan::find()->where(['id'])
        return $this->render('view', [
            'model' => $model,
            'tindakandokter' => $tindakandokter,
        ]);
    }
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
		$model->tglkeluar = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
		$kamar->masuk-- ;
		$model->status = 3;
		$kamar->save();
		$model->save();
		
        return $this->redirect(['keperawatan/index/']);
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
}