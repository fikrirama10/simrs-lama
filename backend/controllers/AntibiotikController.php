<?php

namespace backend\controllers;

use Yii;
use common\models\Antibiotik;
use common\models\AntibiotikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AntibiotikController implements the CRUD actions for Antibiotik model.
 */
class AntibiotikController extends Controller
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
     * Lists all Antibiotik models.
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
			$where = ['between', 'DATE_FORMAT(tangal,"%Y-%m-%d")', $start, $end];
			//$andWhere = ['IdStat'=>4];
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['IdStat'=>4];
			$title = 'Hari Ini';
		}
        $searchModel = new AntibiotikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
	
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
			else if($cek == 'custom'){ $title = 'Periode'; }
			
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $start, $end];
			//$andWhere = ['IdStat'=>4];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andWhere = ['IdStat'=>4];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}

		$searchModel = new AntibiotikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
		$rawat = Antibiotik::find()->where($where)->all();
		$bybulan = Antibiotik::find()->select(['DATE_FORMAT(tanggal, "%d") AS tanggal'])->where($where)->groupBy(['DATE_FORMAT(tanggal, "%d")','DATE_FORMAT(tanggal, "%M")'])->orderBy(['tanggal'=>SORT_ASC])->all();
		$bybulan2 = Antibiotik::find()->select(['DATE_FORMAT(tanggal, "%d") as tanggal', 'SUM(dilakukan) as jumlah','COUNT(id) as Cnt'])->where($where)->groupBy(['DATE_FORMAT(tanggal, "%d")','DATE_FORMAT(tanggal, "%M")'])->all();
        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'title'=>$title,
			'rawat'=>$rawat,
			'bybulan'=>$bybulan,
			'bybulan2'=>$bybulan2,
		
			//'tanggal'=> $tanggal,
        ]);
    }

    /**
     * Displays a single Antibiotik model.
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

    /**
     * Creates a new Antibiotik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
     {
        $model = new Antibiotik();

      if ($model->load(Yii::$app->request->post()) )
		  {
			
			$model->validator = Yii::$app->user->identity->id;
			
			if($model->save()){
			  
				 return $this->redirect(['/antibiotik']);
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
     * Updates an existing Antibiotik model.
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
     * Deletes an existing Antibiotik model.
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
     * Finds the Antibiotik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Antibiotik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Antibiotik::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
