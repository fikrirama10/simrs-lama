<?php

namespace backend\controllers;

use Yii;
use \DateTime;
use common\models\Pradiologi;
use common\models\PradiologiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * PradiologiController implements the CRUD actions for Pradiologi model.
 */
class PradiologiController extends Controller
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
     * Lists all Pradiologi models.
     * @return mixed
     */
    public function actionIndex($start='', $end='',$cek='')
    {
		
		if($start !== '' && $end !== '' && $cek !== ''){
		if($cek == 'today'){ $title = 'Hari ini'; }
		else if($cek == 'this_month'){ $title = 'Bulan ini'; }
		else if($cek == 'this_year'){ $title = 'Tahun ini'; }
		// else if($cek == 'custom'){ $title = 'Periode'; }
		else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }

		$start = date('Y-m-d', strtotime($start));
		$end = date('Y-m-d', strtotime($end));
		$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $start, $end];
		$andWhere = ['sempel'=>'Y'];
		//$andWhere = ['IdStat'=>4];
		}else{
		$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
		$andWhere = ['sempel'=>'Y'];
		$title = 'Hari Ini';
		}
        $searchModel = new PradiologiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	    public function actionGetSearch($start='', $end='',$cek='',$search='')
    {
		
		if($start !== '' && $end !== '' && $cek !== ''){
		if($cek == 'today'){ $title = 'Hari ini'; }
		else if($cek == 'this_month'){ $title = 'Bulan ini'; }
		else if($cek == 'this_year'){ $title = 'Tahun ini'; }
		// else if($cek == 'custom'){ $title = 'Periode'; }
		else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }

		$start = date('Y-m-d', strtotime($start));
		$end = date('Y-m-d', strtotime($end));
		$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $start, $end];
		//$andWhere = ['sempel'=>'Y'];
		//$andWhere = ['IdStat'=>4];
		}else{
		$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
		//$andWhere = ['sempel'=>'Y'];
		$title = 'Hari Ini';
		}
		$rad = Pradiologi::find()->where($where)->all();
		$hitung = Pradiologi::find()->where($where)->count();
        $searchModel = new PradiologiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'rad' => $rad,
            'hitung' => $hitung,
        ]);
    }

    /**
     * Displays a single Pradiologi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$ambil = date('G:i:s', strtotime($model->jamdiambil));
		$hasil = date('h:i:s', strtotime($model->jamhasil));
		$first  = new DateTime( $ambil );
		$second = new DateTime( $hasil );
		$diff = $first->diff( $second );
		// waktu sekarang
	
		
        return $this->render('view', [
            'model' => $this->findModel($id),
            'diff' => $diff ,
        ]);
    }

    /**
     * Creates a new Pradiologi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pradiologi();
		if ($model->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$model])) {
			
			//$model->tanggal = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			 $diff =strtotime($model->jamhasil)-strtotime($model->jamdiambil);
                $hours= floor($diff/(60));
                $mins= floor(($diff-($hours*60*60))/60);
			$model->durasi = $hours;
			$model->dari = 3;
			if($hours < 60){
				$model->tepat = 1;
			}else{
				$model->tepat = 0;
			}
			if($model->save()){
			  
				 return $this->redirect(['/pradiologi']);
			}
			else
			{	
				return $this->render('create', ['model' => $model,]);
			}
			
		   
		} else {
			return $this->render('create', ['model' => $model,]);
		
		}
    }

    /**
     * Updates an existing Pradiologi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$model])) {
			//$model->tanggal = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			$diff =strtotime($model->jamhasil)-strtotime($model->jamdiambil);
            $hours= floor($diff/(60));
            $mins= floor(($diff-($hours*60*60))/60);
			$model->durasi = $hours;
			$model->dari = 3;
			if($hours < 60){
				$model->tepat = 1;
			}else{
				$model->tepat = 0;
			}
			if($model->save()){
			  
				 return $this->redirect(['/pradiologi']);
			}
			else
			{	
				return $this->render('create', ['model' => $model,]);
			}
			
		   
		} else {
			return $this->render('create', ['model' => $model,]);
		
		}
    }

    /**
     * Deletes an existing Pradiologi model.
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
     * Finds the Pradiologi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pradiologi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pradiologi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
