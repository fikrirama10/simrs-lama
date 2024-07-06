<?php

namespace backend\controllers;

use Yii;
use kartik\mpdf\Pdf;
use common\models\Klpcm;
use common\models\Rawatjalan;
use common\models\KlpcmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KlpcmController implements the CRUD actions for Klpcm model.
 */
class KlpcmugdController extends Controller
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
     * Lists all Klpcm models.
     * @return mixed
     */
     public function actionGetPasien()
    {
		$kode = Yii::$app->request->post('id');
	
		if($kode){
		$model = Rawatjalan::find()->joinWith(['pasien as pasien'])->where(['rawatjalan.no_rekmed'=>$kode])->andwhere(['klpcm'=>1])->andwhere(['idjenisrawat'=>3])->orderby(['tgldaftar'=>SORT_DESC])->one();
		}else{
			$model = "";
		}
		return \yii\helpers\Json::encode($model);
    }
   	 public function actionIndex($start='', $end='',$cek='',$search='')
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
			$andWhere = ['jenisrawat'=>3];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
			$andWhere = ['jenisrawat'=>3];
			$title = 'Hari Ini';
		}

        $searchModel = new KlpcmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere);
        // get your HTML raw content without any layouts or scripts
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'title'=>$title,
			
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
			$andWhere = ['jenisrawat'=>3];
			//$andWhere2 = ['lengkap'=>0];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			// $andWhere = ['idjenisrawat'=>1];
			$andWhere = ['jenisrawat'=>3];
			//$andWhere2 = ['lengkap'=>0];
			//$andWhere = ['IdStat'=>4];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		
		
		}
		$lengkap = Klpcm::find()->where($where)->andWhere($andWhere)->andWhere(['lengkap'=>1])->count();
		$tidak = Klpcm::find()->where($where)->andWhere($andWhere)->andWhere(['lengkap'=>0])->count();
        $searchModel = new KlpcmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
			'title'=>$title,
			'lengkap'=>$lengkap,
			'tidak'=>$tidak,
			
		
        ]);
    }
	
	public function actionReport($start='', $end='', $cek='', $search='')
	{
		if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			// else if($cek == 'custom'){ $title = 'Periode'; }
			else if($cek == 'custom'){ $title =  date('d F Y', strtotime($start)); }
		
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $start, $end];
			$andWhere = ['jenisrawat'=>3];	
			$andWhere2 = ['lengkap'=>0];	
			
		}else{
			$title = 'Hari Ini';
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
		$andWhere = ['jenisrawat'=>3];
		$andWhere2 = ['lengkap'=>0];
			
			
		}
		
		$dataProvider = Klpcm::find()->where($where)->andWhere($andWhere2)->andWhere($andWhere)->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report', ['dataProvider' => $dataProvider,  'title'=>$title, 'search'=>$search]);
		
		$footer = '
		<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top:3mm !important; margin-top:-50px !imporatnt">
		Page {PAGENO} of {nb}
		</div>';
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
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
     * Displays a single Klpcm model.
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
     * Creates a new Klpcm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
		public function actionGetrajal()
    {
		$kode = Yii::$app->request->post('id');
		if($kode){
			$model = Rawatjalan::find()->where(['id'=>$kode])->one();
		}else{
			$model = "";
		}
		return \yii\helpers\Json::encode($model);
    }
   public function actionCreate()
    {
        $model = new Klpcm();
		$post = Yii::$app->request->post();
		$dataTemplate = Rawatjalan::find()->where(['idjenisrawat'=>3])->andwhere(['klpcm'=>1])->orderby(['tgldaftar'=>SORT_DESC])->all();
        if($model->load(Yii::$app->request->post())){
			$postMo = $post['Klpcm'];
			$postForm = $postMo['jform'];
			$postTdk = $postMo['tdklengkap'];
			
			if($model->jform == '""' ){
			$model->jform = '[""]';
			
			}else if($model->tdklengkap == '""' ){
			$model->tdklengkap ='[""]';
			
			}
			else{
			$model->jform = json_encode($postForm);
			$model->tdklengkap = json_encode($postTdk);
			
			}
			
			$model->tanggal = date('Y-m-d',strtotime($model->tanggal));
			$model->jenisrawat = 3;
			if($model->save(false)){
				$rawatjalan = Rawatjalan::find()->where(['id'=>$model->idrajal])->one();
				if($rawatjalan->klpcm == 2){
					return $this->redirect(['index']);
				}else{
				$rawatjalan->klpcm = 2;
				$rawatjalan->diagket = $model->ketdiag;
				$rawatjalan->kdiagnosa = $model->icd10;
				$rawatjalan->jenispenyakit = $model->jenispenyakit;
				$rawatjalan->save();
				return $this->redirect(['index']);}
            } else {
                return $this->render('create', ['model' => $model,]);
            }
		
		}
		else 
		{
            return $this->render('create', [
                'model' => $model,
                'dataTemplate' => $dataTemplate,
            ]);
        }
    }

    /**
     * Updates an existing Klpcm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$post = Yii::$app->request->post();
		$dataTemplate = Rawatjalan::find()->where(['idjenisrawat'=>3])->andwhere(['klpcm'=>1])->orderby(['tgldaftar'=>SORT_DESC])->all();
        if($model->load(Yii::$app->request->post())){
			$postMo = $post['Klpcm'];
			$postForm = $postMo['jform'];
			$postTdk = $postMo['tdklengkap'];
			$model->jform = json_encode($postForm);
			$model->tdklengkap = json_encode($postTdk);
			if($model->save(false)){
				$rawatjalan = Rawatjalan::find()->where(['id'=>$model->idrajal])->one();
				$rawatjalan->klpcm = 2;
				$rawatjalan->diagket = $model->ketdiag;
				$rawatjalan->kdiagnosa = $model->icd10;
				$rawatjalan->jenispenyakit = $model->jenispenyakit;
				$rawatjalan->save(false);
				return $this->redirect(['index']);
            } else {
                return $this->render('update', ['model' => $model,]);
            }
		}else{

        return $this->render('update', [
            'model' => $model,
            'dataTemplate'=>$dataTemplate,
        ]);
		}
    }

    /**
     * Deletes an existing Klpcm model.
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
     * Finds the Klpcm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Klpcm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Klpcm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
