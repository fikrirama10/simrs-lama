<?php

namespace backend\controllers;

use Yii;
use common\models\Diagnosa;
use common\models\Diagnosapasien;
use common\models\DiagnosapasienSearch;
use common\models\DiagnosaSearch;
use common\models\RawatjalanSearch;
use common\models\Rawatjalan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DiagnosaController implements the CRUD actions for Diagnosa model.
 */
class DiagnosaController extends Controller
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
     * Lists all Diagnosa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DiagnosaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 public function actionDpasien()
    {
        $searchModel = new DiagnosapasienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dpasien', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDemodiag($start='', $end='',$cek='')
    {
        if($start !== '' && $end !== '' && $cek !== ''){
            if($cek == 'today'){ $title = 'Hari ini'; }
            else if($cek == 'this_month'){ $title = 'Bulan ini'; }
            else if($cek == 'this_year'){ $title = 'Tahun ini'; }
            // else if($cek == 'custom'){ $title = 'Periode'; }
            else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
            
            $start = date('Y-m-d', strtotime($start));
            $end = date('Y-m-d', strtotime($end));
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            //$andWhere = ['IdStat'=>4];
        }else{
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
            //$andWhere = ['jenis_kelamin'=>'L'];
            $title = 'Hari Ini';
        }

        $searchModel = new RawatjalanSearch();
        $hitungrj = Rawatjalan::find()
       ->select(['rawatjalan.*', 'COUNT(kdiagnosa) AS hitung'])
       ->groupBy('kdiagnosa')
       ->orderBy(['hitung' => SORT_DESC])
       ->limit(10);
        $datadiag = $hitungrj->where($where)->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
        
        return $this->render('demodiag', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'datadiag'=>$datadiag,
            
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
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            $andWhere2 =['<','status',20];
            $andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            $andFilterWhere = ['or',['like', 'idjenisrawat',3], ];
        }else{
			 $andWhere2 =['<','status',20];
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
            $andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            $andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
        
        
        }
      
        $hitungrj = Rawatjalan::find()
       ->select(['rawatjalan.*', 'COUNT(kdiagnosa) AS hitung'])
       ->groupBy('kdiagnosa')
       ->orderBy(['hitung' => SORT_DESC])
       ->limit(10);
        $datadiag = $hitungrj->where($where)->andWhere($andWhere2)->all();
        
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere2,$andFilterWhere);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'datadiag'=>$datadiag,

        ]);
    }
    /**
     * Displays a single Diagnosa model.
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
     * Creates a new Diagnosa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Diagnosa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Diagnosa model.
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
     * Deletes an existing Diagnosa model.
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
     * Finds the Diagnosa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Diagnosa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Diagnosa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
