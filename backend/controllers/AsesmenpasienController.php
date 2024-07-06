<?php

namespace backend\controllers;

use Yii;
use common\models\Asesmenpasien;
use common\models\AsesmenpasienSearch;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Rawatjalan;
use yii\filters\VerbFilter;

/**
 * AsesmenpasienController implements the CRUD actions for Asesmenpasien model.
 */
class AsesmenpasienController extends Controller
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
     * Lists all Asesmenpasien models.
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
		
		$asesmen = Asesmenpasien::find()->where($where)->andWhere($andWhere)->all();
		$hitung = Asesmenpasien::find()->where($where)->andWhere($andWhere)->count();
        $searchModel = new AsesmenpasienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        // get your HTML raw content without any layouts or scripts
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'title'=>$title,
			'asesmen'=>$asesmen,
			'hitung'=>$hitung,
			
        ]);
    }
	 public function actionGetSearch($start='', $end='',$cek='',$search='',$search2='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			//else if($cek == 'custom'){ $title = 'Periode'; }
			else if($cek == 'custom'){ $title = '<br>'.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $start, $end];
			$andWhere = ['sempel'=>'Y'];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			if($search==''){
			$andFilterWhere = ['or',['like','sempel', 'Y'], ];		
			}else{
			$andFilterWhere = ['or',['like',$search, $search2], ];	
			}
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['sempel'=>'Y'];
			if($search==''){
			$andFilterWhere = ['or',['like','sempel', 'Y'], ];	
			}else{
			$andFilterWhere = ['or',['like',$search, $search2], ];	
			}
			
			//$andWhere = ['IdStat'=>4];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}

		$asesmen = Asesmenpasien::find()->where($where)->andWhere($andWhere)->all();
		$hitung = Asesmenpasien::find()->where($where)->andWhere($andWhere)->count();
        $searchModel = new AsesmenpasienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
		$rawat = Asesmenpasien::find()->where($where)->andWhere($andWhere)->all();
		$rawatc = Asesmenpasien::find()->where($where)->andWhere($andWhere)->count();
		$bybulan = Asesmenpasien::find()->select(['DATE_FORMAT(tanggal, "%u") AS tanggal'])->where($where)->andWhere($andWhere)->groupBy(['DATE_FORMAT(tanggal, "%u")','DATE_FORMAT(tanggal, "%M")'])->orderBy(['tanggal'=>SORT_ASC])->all();
		$bybulan2 = Asesmenpasien::find()->select(['DATE_FORMAT(tanggal, "%u") as tanggal', 'SUM(lengkap) as jumlah','COUNT(id) as Cnt'])->where($where)->andWhere($andWhere)->groupBy(['DATE_FORMAT(tanggal, "%u")','DATE_FORMAT(tanggal, "%M")'])->all();
        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'title'=>$title,
			'asesmen'=>$asesmen,
			'hitung'=>$hitung,
			'rawat'=>$rawat,
			'rawatc'=>$rawatc,
			'bybulan'=>$bybulan,
			'bybulan2'=>$bybulan2,
			
		
        ]);
    }
	 public function actionPasien()
    {
       $model = Asesmenpasien::find()->where(['idjenisrawat'=>3])->all();
	   return $this->render('pasien', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Asesmenpasien model.
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
     * Creates a new Asesmenpasien model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Asesmenpasien();
 	if ($model->load(Yii::$app->request->post())) {
			$model->sempel ='Y';
			$hitung =  $model->anamesisi + $model->ass_psiko + $model->rx_fisik + $model->penunjang+$model->diagnosis+$model->rencanaasuhan+$model->evaluasi+$model->ttd;
			if($hitung == 8){
				$model->lengkap = 1;
			}else{
				$model->lengkap = 0;
			}
			$model->verifikator = 2;
			if($model->save()){
		
				  return $this->redirect(['asesmenpasien/']);
			}
			else
			{	
				return $this->render('update', ['model' => $model,]);
			}
			
		   
		} else {
			return $this->render('update', ['model' => $model,]);
		
		}
		
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Asesmenpasien model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       	if ($model->load(Yii::$app->request->post())) {
			$model->sempel ='Y';
			$hitung =  $model->anamesisi + $model->ass_psiko + $model->rx_fisik + $model->penunjang+$model->diagnosis+$model->rencanaasuhan+$model->evaluasi+$model->ttd;
			if($hitung == 8){
				$model->lengkap = 1;
			}else{
				$model->lengkap = 0;
			}
			if($model->save()){
		
				  return $this->redirect(['asesmenpasien/']);
			}
			else
			{	
				return $this->render('update', ['model' => $model,]);
			}
			
		   
		} else {
			return $this->render('update', ['model' => $model,]);
		
		}
		
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Asesmenpasien model.
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
	public function actionReport($start='', $end='', $cek='', $search='')
	{
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			//else if($cek == 'custom'){ $title = 'Periode'; }
			else if($cek == 'custom'){ $title = '<br>'.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $start, $end];
			$andWhere = ['sempel'=>'Y'];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			if($search==''){
			$andFilterWhere = ['or',['like','sempel', 'Y'], ];		
			}else{
			$andFilterWhere = ['or',['like',$search, $search2], ];	
			}
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['sempel'=>'Y'];
			if($search==''){
			$andFilterWhere = ['or',['like','sempel', 'Y'], ];	
			}else{
			$andFilterWhere = ['or',['like',$search, $search2], ];	
			}
			
			//$andWhere = ['IdStat'=>4];
			//$andWhere = ['or',['like', 'pasien.nama_pasien', $search2], ];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}
		
		$dataProvider = Asesmenpasien::find()->where($where)->orderBy(['tanggal'=>SORT_ASC])->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report', ['dataProvider' => $dataProvider,  'title'=>$title, 'search'=>$search,]);
		
		$footer = '
		<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top:3mm !important; margin-top:-50px !imporatnt">
		Page {PAGENO} of {nb}
		</div>';
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content, 
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@frontend/web/css/paper.css',
             // call mPDF methods on the fly
            'methods' => [
                // 'SetHeader'=>['THIS IS REPORT'],
                'SetFooter'=>[$footer],
            ]
        ]);
 
        // http response
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
 
        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    /**
     * Finds the Asesmenpasien model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asesmenpasien the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asesmenpasien::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
