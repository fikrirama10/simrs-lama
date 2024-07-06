<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Pekerjaan;
use common\models\Kelurahan;
use common\models\Kecamatan;
use common\models\Kabupaten;
use yii\base\Model;
use common\models\Lograwat;
use common\models\Pasienonline;
use common\models\Pasien;
use common\models\Kunjungan;
use common\models\PasienonlineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PasienonlineController implements the CRUD actions for Pasienonline model.
 */
class PasienonlineController extends Controller
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
     * Lists all Pasienonline models.
     * @return mixed
     */
    public function actionIndex()
    {
		$where = ['verived'=> 0] ;
        $searchModel = new PasienonlineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionStatistik()
    {
		
        $searchModel = new PasienonlineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('statistik', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pasienonline model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

	public function actionBatal($id)
    {
		$model = $this->findModel($id);
		$model->verived = 2;
		$model->save(false);
        return $this->redirect(['index']);
    }
	 public function actionVerivikasi($id)
    {
		$model = $this->findModel($id);
		if($model->jenispasien == "Baru"){
			return $this->redirect(['pasienonline/create/'.$id]);
		}else{
			$rawatjalan = new Rawatjalan();
		$lograwat = new Lograwat();
		
		$cekpa = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		$hrj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
		$kunjungan = new Kunjungan();
		if ($rawatjalan->load(Yii::$app->request->post()) 
			&& $lograwat->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$rawatjalan])) {
			$tkunjungan = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
			if($tkunjungan == null ){
			$rawatjalan->kunjungan = 1;
			}else{
			$rawatjalan->kunjungan = $tkunjungan + 1 ;
			}
			$rawatjalan->genKode();
			$rawatjalan->idverifed = Yii::$app->user->identity->id ;
			//$rawatjalan->tgldaftar = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			
			($rawatjalan->antrian)? $rawatjalan->antrian : $rawatjalan->genAntri($rawatjalan->idpoli);
			$rawatjalan->status = 1 ;
			$rawatjalan->klpcm = 1 ;
			$rawatjalan->idjenisrawat = 1 ;
			$pasien->stpasien = 'Old';
			$rawatjalan->usia = $pasien->usia ;
			$rawatjalan->idkb = 1;
			$lograwat->idrawat = $rawatjalan->idrawat;
			//$lograwat->jenis = $rawatjalan->polii->namapoli;
			
			$lograwat->waktu = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			$kunjungan->no_rekmed = $model->no_rekmed;
			$kunjungan->idrawat = $rawatjalan->idrawat;
			$kunjungan->idpekerjaan = $pasien->idpekerjaan;
			$kunjungan->sebagai = $pasien->subid;
			$kunjungan->created_at = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d'))));
			if($cekpa > 0){
				$kunjungan->save(false); 
			}else{"";}
			$model->verived = 1 ;
			if($rawatjalan->save(false)){
				$lograwat->save(false);
				$model->save(false);
				return $this->redirect(['rawatjalan/previewpasien/'.$rawatjalan->id]);
			}
			else
			{	
				return $this->render('verivikasi', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('verivikasi', ['lograwat'=>$lograwat,'rawatjalan' => $rawatjalan,'model' => $this->findModel($id),]);
		
		}
		}
		
        
    }

    /**
     * Creates a new Pasienonline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
      
		$model = new Pasien();
		$pekerjaan = new Pekerjaan();
		$kelas = '';
		$pasienonline = $this->findModel($id);
		if ($model->load(Yii::$app->request->post()) 
			&& $pekerjaan->load(Yii::$app->request->post())
			&& Model::validateMultiple([$pekerjaan])) {
			$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
			if($pasien != null){
				$norm = (substr($model->no_rekmed,1));
			$anom = $norm + 1;
			$r = 0;
			$model->no_rekmed = $r.$anom;
			$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			$model->idverifed = Yii::$app->user->identity->id ;
			$model->tanggal_lahir = date('Y-m-d', strtotime($model->tanggal_lahir));
			$model->created_at = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$pekerjaan->idpasien = $model->no_rekmed ;
			$model->idpekerjaan = $pekerjaan->idjenis ;
			$model->stpasien = 'Baru';
			}else{
			$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
			$model->idverifed = Yii::$app->user->identity->id ;
			$model->tanggal_lahir = date('Y-m-d', strtotime($model->tanggal_lahir));
			$model->created_at = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
			$pekerjaan->idpasien = $model->no_rekmed ;
			$model->idpekerjaan = $pekerjaan->idjenis ;
			$model->stpasien = 'Baru';
			}
			
			//if($model->usia < 2 ){
			//	$model->sbb = 'By';
			//}else if($model->usia > 2 || $model->usia < 15){
			//	$model->sbb = 'An';
			//}else if($model->usia > 16 ){
			//	if($model->jenis_kelamin == 'L'){
			//		$model->sbb = 'Tn';
			//	}else if($model->jenis_kelamin == 'P'){
			//		if($model->idstatus == 2){
			//			$model->sbb = 'Nn';
			//		}else{
			//			$model->sbb = 'Ny';
			//		}
			//	}
			//}
			if($model->save(false)){
				
			   $pekerjaan->save();
			   $kec = Kelurahan::find()->where(['id_kel'=>$model->idkel])->one();
				$kab = Kecamatan::find()->where(['id_kec'=>$kec->id_kec])->one();
				$prov = Kabupaten::find()->where(['id_kab'=>$kab->id_kab])->one();
				$model->idkec = $kec->id_kec;
				$model->idkab = $kab->id_kab;
				$model->idprov = $prov->id_prov;
			if($model->usia < 1 ){
				$model->sbb = 'By';
			}else if($model->usia >= 1 && $model->usia < 17){
				$model->sbb = 'An';
			}else if($model->usia > 17 ){
				if($model->jenis_kelamin == 'L'){
					$model->sbb = 'Tn';
				}else if($model->jenis_kelamin == 'P'){
					if($model->id_status == 2){
						$model->sbb = 'Nn';
					}else{
						$model->sbb = 'Ny';
					}
				}
			}
			$model->save(false);
				 return $this->redirect(['pasien/sbb', 'id' => $model->id]);
			}
			else
			{	
				return $this->render('create', ['model' => $model,'pekerjaan' => $pekerjaan,'kelas'=>$kelas,'pasienonline'=>$pasienonline]);
			}
			
		   
		} else {
			return $this->render('create', ['model' => $model,'pekerjaan' => $pekerjaan,'kelas'=>$kelas,'pasienonline'=>$pasienonline]);
		
		}
	
    }

    /**
     * Updates an existing Pasienonline model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pasienonline model.
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
     * Finds the Pasienonline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pasienonline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pasienonline::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
