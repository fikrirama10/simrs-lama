<?php

namespace backend\controllers;

use Yii;
use kartik\mpdf\Pdf;
use common\models\Rawatjalan;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KlpcmController implements the CRUD actions for Klpcm model.
 */
class BorlostoiController extends Controller
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
   	 public function actionIndex($start='', $end='',$cek='',$search='')
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
			//$andWhere = ['IdStat'=>4];
			//$andWhere = ['idjenisrawat'=>1];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			// $andWhere = ['idjenisrawat'=>1];
			// $andWhere2 = ['idjenisrawat'=>1];
			//$andWhere = ['IdStat'=>4];
			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		
		
		}
		 $bor = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere($where)->count();
		$diff = strtotime($end) - strtotime($start) ;
        return $this->render('index', [
            'bor' => $bor,
            'diff' => $diff,
            //'dataProvider' => $dataProvider,
			
			
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
			$where = ['between', 'DATE_FORMAT(tglkeluar,"%Y-%m-%d")', $start, $end];
			$lamarawat = strtotime($end) - strtotime($start);
			
			//$andWhere = ['IdStat'=>4];
			//$andWhere = ['idjenisrawat'=>1];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tglkeluar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			// $andWhere = ['idjenisrawat'=>1];
			// $andWhere2 = ['idjenisrawat'=>1];
			//$andWhere = ['IdStat'=>4];
			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		
		
		}
		$lamarawatan = Rawatjalan::find()->select(['SUM(lamarawat) as jumlahllama'])->where($where)->all();
			$lamarawatan2 = Rawatjalan::find()->where($where)->sum('lamarawat');
       $bor = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere($where)->count();
       $alos = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere($where)->andwhere(['status'=>1])->sum('lamarawat');
       $alos2 = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere($where)->andwhere(['status'=>1])->count();
		$periode  = floor($lamarawat/86400)+1;
       $aalos = Rawatjalan::find()->where(['idjenisrawat'=>2])->andwhere($where)->andwhere(['status'=>1])->count();
		$diff = strtotime($end) - strtotime($start);
		$rawat = Rawatjalan::find()->where($where)->andwhere(['idjenisrawat'=>2])->orderBy(['tglkeluar'=>SORT_DESC])->all();
		$rawat2 = Rawatjalan::find()->where($where)->andwhere(['idjenisrawat'=>2])->andwhere(['status'=>1])->orderBy(['tglkeluar'=>SORT_ASC])->all();
	
		$bybulan = Rawatjalan::find()->select(['DATE_FORMAT(tglkeluar, "%M") AS tglkeluar'])->where($where)->andwhere(['idjenisrawat'=>2])->groupBy(['DATE_FORMAT(tglkeluar, "%M")','DATE_FORMAT(tglkeluar, "%Y")'])->orderBy(['tglkeluar'=>SORT_DESC])->all();
		$bybulan2 = Rawatjalan::find()->select(['DATE_FORMAT(tglkeluar, "%M") as tglkeluar','COUNT(id) as Cnt',])->where($where)->andwhere(['idjenisrawat'=>2])->orderBy(['tglkeluar'=>SORT_DESC])->groupBy(['DATE_FORMAT(tglkeluar, "%M")','DATE_FORMAT(tglkeluar, "%Y")'])->all();
		$bybulan3 = Rawatjalan::find()->select(['DATE_FORMAT(tglkeluar, "%M") AS tglkeluar'])->where($where)->andwhere(['idjenisrawat'=>2])->andwhere(['status'=>1])->groupBy(['DATE_FORMAT(tglkeluar, "%M")','DATE_FORMAT(tglkeluar, "%Y")'])->orderBy(['tglkeluar'=>SORT_DESC])->all();
		$bybulan4 = Rawatjalan::find()->select(['DATE_FORMAT(tglkeluar, "%M") as tglkeluar','COUNT(id) as Cnt','SUM(lamarawat) as jumlah'])->where($where)->andwhere(['idjenisrawat'=>2])->andwhere(['status'=>1])->orderBy(['tglkeluar'=>SORT_DESC])->groupBy(['DATE_FORMAT(tglkeluar, "%M")','DATE_FORMAT(tglkeluar, "%Y")'])->all();
        return $this->renderAjax('search', [
            'bor' => $bor,
            'lamarawatan' => $lamarawatan,
            'lamarawatan2' => $lamarawatan2,
            'alos' => $alos,
            'alos2' => $alos2,
            'periode' => $periode,
            'aalos' => $aalos,
            'diff' => $diff,
			'rawat'=> $rawat,
			'rawat2'=> $rawat2,
			'bybulan'=> $bybulan,
			'bybulan2'=> $bybulan2,
			'bybulan3'=> $bybulan3,
			'bybulan4'=> $bybulan4,
			'title'=>$title,
			
		
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
			//$andWhere = ['IdStat'=>4];	
			
		}else{
			$title = 'Hari Ini';
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
		
			
			
		}
		
		$dataProvider = Klpcm::find()->where($where)->all();
       
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
    public function actionCreate()
    {
        $model = new Klpcm();
		$post = Yii::$app->request->post();

        if($model->load(Yii::$app->request->post())){
			$postMo = $post['Klpcm'];
			$postForm = $postMo['jform'];
			$postTdk = $postMo['tdklengkap'];
		
			if($model->jform == '""' ){
			$model->jform = '';
			
			}else if($model->tdklengkap == '""' ){
			$model->tdklengkap = '';
			
			}
			else{
			$model->jform = json_encode($postForm);
			$model->tdklengkap = json_encode($postTdk);
			
			}
			
				
			if($model->save()){
				return $this->redirect(['index']);
            } else {
                return $this->render('create', ['model' => $model,]);
            }
		
		}
		else 
		{
            return $this->render('create', [
                'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
