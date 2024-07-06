<?php

namespace backend\controllers;

use Yii;
use common\models\Prlab;
use common\models\PrlabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * PrlabController implements the CRUD actions for Prlab model.
 */
class PrlabController extends Controller
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
     * Lists all Prlab models.
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
			//$andWhere = ['sempel'=>'Y'];
			//$andWhere = ['IdStat'=>4];
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
		//	$andWhere = ['sempel'=>'Y'];
			$title = 'Hari Ini';
		}
		
		// $asesmen = Asesmenpasien::find()->where($where)->andWhere($andWhere)->all();
		// $hitung = Asesmenpasien::find()->where($where)->andWhere($andWhere)->count();
        $searchModel = new PrlabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'title'=>$title,
			// 'asesmen'=>$asesmen,
			// 'hitung'=>$hitung,
			
        ]);
    }
	 public function actionGetSearch($start='', $end='',$cek='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			else if($cek == 'custom'){ $title = 'Periode'; }
			
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $start, $end];
			//$andWhere = ['sempel'=>'Y'];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['sempel'=>'Y'];
			//$andWhere = ['IdStat'=>4];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}

		// $asesmen = Asesmenpasien::find()->where($where)->andWhere($andWhere)->all();
		// $hitung = Asesmenpasien::find()->where($where)->andWhere($andWhere)->count();
        $searchModel = new PrlabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'title'=>$title,
			// 'asesmen'=>$asesmen,
			// 'hitung'=>$hitung,
			
		
        ]);
    }

    /**
     * Creates a new Prlab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
    {
        $model = new Prlab();
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
			if($model->save(false)){
			  
				 return $this->redirect(['/prlab']);
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
     * Updates an existing Prlab model.
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
			if($model->save(false)){
			  
				 return $this->redirect(['/prlab']);
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
     * Deletes an existing Prlab model.
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
     * Finds the Prlab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prlab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prlab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
