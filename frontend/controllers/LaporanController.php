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
use common\models\PemriklabSearch;
use common\models\Doktertindakan;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class LaporanController extends Controller
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

	 public function actionLaporanrawat($start='', $end='',$cek='')
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
			$andWhere = ['idjenisrawat'=>1];
			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
			$andWhere = ['idjenisrawat'=>1];
			$title = 'Hari Ini';
		}

        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere);
        // get your HTML raw content without any layouts or scripts
		
        return $this->render('laporanrawat', [
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
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			//$andWhere = ['IdStat'=>4];
			$andWhere = ['idjenisrawat'=>1];
			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['idjenisrawat'=>1];
			$andWhere2 = ['idjenisrawat'=>1];
			//$andWhere = ['IdStat'=>4];
			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		
		
		}

        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere,$andFilterWhere);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
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
			else if($cek == 'custom'){ $title = '<br>'.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
		
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			//$andWhere = ['IdStat'=>4];	
			$andWhere = ['idjenisrawat'=>1];

			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		}else{
			$title = 'Hari Ini';
			$where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['idjenisrawat'=>1];
			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
			
			
		}
		$bpjs = Rawatjalan::find()->where($where)->andWhere($andWhere)->andWhere(['idbayar'=>5])->andWhere($andFilterWhere)->count();
		$umum = Rawatjalan::find()->where($where)->andWhere($andWhere)->andWhere(['idbayar'=>4])->andWhere($andFilterWhere)->count();
		$dataProvider = Rawatjalan::find()->where($where)->andWhere($andWhere)->andWhere($andFilterWhere)->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report', ['dataProvider' => $dataProvider,  'title'=>$title, 'search'=>$search,'bpjs'=>$bpjs,'umum'=>$umum]);
		
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
            'orientation' => Pdf::ORIENT_PORTRAIT,
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
	
}

?>