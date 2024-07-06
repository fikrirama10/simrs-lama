<?php

namespace backend\controllers;

use Yii;
use common\models\Poli;
use common\models\Rawatjalan;
use common\models\RawatjalanSearch;
use common\models\PoliSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PoliController implements the CRUD actions for Poli model.
 */
class PoliController extends Controller
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

    /**
     * Lists all Poli models.
     * @return mixed
     */
    public function actionPdf() {
         
        $content = $this->renderPartial('index');
        
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, 
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Laporan Harian']
             
        ]);
        return $pdf->render();
    }
    public function actionIndex()
    {
        $searchModel = new PoliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPoligigi()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>1])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('poligigi', [
            'model' => $model,
        ]);
    }
    public function actionPolibedah()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>3])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('polibedah', [
            'model' => $model,
        ]);
    }
    public function actionPolianak()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>2])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('polianak', [
            'model' => $model,
        ]);
    }
    public function actionPolipenyakitdalam()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>4])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('polipenyakitdalam', [
            'model' => $model,
        ]);
    }
    public function actionPolikandungan()
    {
        
        $model = Rawatjalan::find()->where(['idpoli'=>5])->andwhere(['idjenisrawat'=>1])->andwhere(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => date('Y-m-d'),])->andwhere(['status'=> 1])->all();
        return $this->render('polikandungan', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Poli model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Poli model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Poli();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Poli model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
     public function actionDemopoli($start='', $end='',$cek='')
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
        $igd = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>3])->count();
        $polibedah = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>3])->count();
        $polikandungan = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>5])->count();
        $polianak = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>2])->count();
        $polidalam = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>4])->count();
        $poligigi = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>1])->count();
        $politukang = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>6])->count();
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
        
        return $this->render('demopoli', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'poligigi' => $poligigi,
            'polibedah' => $polibedah,
            'polianak' => $polianak,
            'polidalam' => $polidalam,
            'polikandungan' => $polikandungan,
            'politukang' => $politukang,
            
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
            $andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            $andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
        }else{
            $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
            $andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
            $andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
        
        
        }
      
        $igd = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>3])->groupby(['idrawat'])->count();
        $polik = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->groupby(['idrawat'])->count();
        $inap = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>2])->groupby(['idrawat'])->count();
        $polibedah = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>3])->groupby(['idrawat'])->count();
        $polikandungan = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>5])->groupby(['idrawat'])->count();
        $polianak = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>2])->groupby(['idrawat'])->count();
        $polidalam = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>4])->groupby(['idrawat'])->count();
        $poligigi = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>1])->count();
        $politukang = Rawatjalan::find()->where($where)->andWhere(['idjenisrawat'=>1])->andWhere(['idpoli'=>6])->groupby(['idrawat'])->count();
        $rrj = Rawatjalan::find()->all();
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
        
        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'poligigi' => $poligigi,
            'igd' => $igd,
            'polik' => $polik,
            'inap' => $inap,
            'polibedah' => $polibedah,
            'polianak' => $polianak,
            'polidalam' => $polidalam,
            'polikandungan' => $polikandungan,
            'politukang' => $politukang,
            'rrj' => $rrj,
            
        ]);
    }

    /**
     * Deletes an existing Poli model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Poli model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Poli the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Poli::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
