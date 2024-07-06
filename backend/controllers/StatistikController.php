<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Trxresep;
use common\models\BarangMasuk;
use common\models\Obat;
use common\models\BarangMasukSearch;
use common\models\BarangMasukdetailSearch;
class StatistikController extends Controller
{
    public function actionObatEd(){
		$obat = Obat::find()->where(['<>','kadaluarsa','0'])->orderBy(['kadaluarsa'=>SORT_ASC])->all();
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/sisa-ed';
		$content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);		
		return $this->render('barang-sisa-ed',['json2'=>$json2,'obat'=>$obat]);
	}
	
    public function actionStatistikKunjungan($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest?tahun='.$start;			
			$bulan = date('Y',strtotime($start));
		}else{
			$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest?tahun='.date('Y');
			$bulan = date('Y');
		}
		$content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);		
		return $this->render('statistik-kunjungan',['json2'=>$json2,'bulan'=>$bulan]);
	}
	public function actionGetStkunjungan($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest?tahun='.$start;			
			$bulan = date('Y',strtotime($start));
		}else{
			$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest?tahun='.date('Y');
			$bulan = date('Y');
		}
		$content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);		
		return $this->renderAjax('get-stkunjungan',['json2'=>$json2,'bulan'=>$bulan]);
	}
    public function actionBarangView($id)
    {
        $searchModel = new BarangMasukdetailSearch();
        $model = $this->findBarang($id);
		 $where = ['idtrx'=>$model->idtrx];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
	
		return $this->render('barang-view',[
			'model'=>$model,
			'dataProvider'=>$dataProvider,
			'searchModel'=>$searchModel,
		]);
	}
	 public function actionBarangmasuk()
    {
        $searchModel = new BarangMasukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('barang-masuk', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionMinimalStok($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/minimal-stok?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/minimal-stok?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->render('obat-habis',['json'=>$json,'bulan'=>$bulan]);
	}
    public function actionPendapatanFarmasi($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pendapatan-farmasi?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pendapatan-farmasi?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->render('income-farmasi',['json'=>$json,'bulan'=>$bulan]);
	}
	public function actionGetIncomeFarmasi($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pendapatan-farmasi?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pendapatan-farmasi?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->renderAjax('get-income-farmasi',['json'=>$json,'bulan'=>$bulan]);
	}
    public function actionIncomeBulanan($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url2 =  Yii::$app->params['baseUrl'].'/dashboard/rest/income-bulanan?tahun='.$start;	
			$title = $start;
		}else{
			$url2 =  Yii::$app->params['baseUrl'].'/dashboard/rest/income-bulanan?tahun='.date('Y');
			$title = date('Y');
		}
		$content2 = file_get_contents($url2);
		$json2 = json_decode($content2, true);
		return $this->render('income-bulanan',['json2'=>$json2,'title'=>$title]);
	}
	public function actionGetIncomeBulanan($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url2 =  Yii::$app->params['baseUrl'].'/dashboard/rest/income-bulanan?tahun='.$start;	
			$title = $start;
		}else{
			$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/income-bulanan?tahun='.date('Y');
			$title = date('Y');
		}
		$content2 = file_get_contents($url2);
		$json2 = json_decode($content2, true);
		return $this->renderAjax('get-income-bulanan',['json2'=>$json2,'title'=>$title]);
	}
	
	public function actionIncomeHarian($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = 'Grafik Pemasukan Pasien '.$jp.' - '.$start.'/'.$end;
			$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian?b='.$start.'&y='.$end.'&bayar='.$search;
			$content2 = file_get_contents($url2);
			$urlrajal = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-rajal?b='.$start.'&y='.$end.'&bayar='.$search;
			$contentrajal = file_get_contents($urlrajal);
			$urlugd = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-ugd?b='.$start.'&y='.$end.'&bayar='.$search;
			$contentugd = file_get_contents($urlugd);
			$urlranap = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-ranap?b='.$start.'&y='.$end.'&bayar='.$search;
			$contentranap = file_get_contents($urlranap);
		}else{
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = 'Grafik Pemasukan Pasien '.$jp.' - '.date('m').'/'.date('Y');
			$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian?b='.date('m').'&y='.date('Y').'&bayar=4';
			$content2 = file_get_contents($url2);
			$urlrajal = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-rajal?b='.date('m').'&y='.date('Y').'&bayar=4';
			$contentrajal = file_get_contents($urlrajal);
			$urlugd = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-ugd?b='.date('m').'&y='.date('Y').'&bayar=4';
			$contentugd = file_get_contents($urlugd);
			$urlranap = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-ranap?b='.date('m').'&y='.date('Y').'&bayar=4';
			$contentranap = file_get_contents($urlranap);
		}
        
        $json_rajal = json_decode($contentrajal, true);	
        $json_ugd = json_decode($contentugd, true);	
        $json_ranap = json_decode($contentranap, true);	
        $json2 = json_decode($content2, true);	
		
		return $this->render('income-harian',[
			'json_rajal'=>$json_rajal,
			'json_ugd'=>$json_ugd,
			'json_ranap'=>$json_ranap,
			'json2'=>$json2,
			'title'=>$title,
		]);
	}
	public function actionGetIncome($start='',$end='',$cek='',$search=''){
			if($start !== '' && $end !== '' && $cek !== ''){
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = 'Grafik Pemasukan Pasien '.$jp.' - '.$start.'/'.$end;
			$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian?b='.$start.'&y='.$end.'&bayar='.$search;
			$content2 = file_get_contents($url2);
			$urlrajal = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-rajal?b='.$start.'&y='.$end.'&bayar='.$search;
			$contentrajal = file_get_contents($urlrajal);
			$urlugd = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-ugd?b='.$start.'&y='.$end.'&bayar='.$search;
			$contentugd = file_get_contents($urlugd);
			$urlranap = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-ranap?b='.$start.'&y='.$end.'&bayar='.$search;
			$contentranap = file_get_contents($urlranap);
		}else{
			if($search == 5){
				$jp = 'BPJS';
			}else{
				$jp = 'Yanmasum';
			}
			$title = 'Grafik Pemasukan Pasien '.$jp.' - '.date('m').'/'.date('Y');
			$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian?b='.date('m').'&y='.date('Y').'&bayar=4';
			$content2 = file_get_contents($url2);
			$urlrajal = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-rajal?b='.date('m').'&y='.date('Y').'&bayar=4';
			$contentrajal = file_get_contents($urlrajal);
			$urlugd = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-ugd?b='.date('m').'&y='.date('Y').'&bayar=4';
			$contentugd = file_get_contents($urlugd);
			$urlranap = 'https://simrs.rsausulaiman.com/dashboard/rest/income-harian-ranap?b='.date('m').'&y='.date('Y').'&bayar=4';
			$contentranap = file_get_contents($urlranap);
		}
        
        $json_rajal = json_decode($contentrajal, true);	
        $json_ugd = json_decode($contentugd, true);	
        $json_ranap = json_decode($contentranap, true);	
        $json2 = json_decode($content2, true);	
		
		return $this->renderAjax('search-income',[
			'json_rajal'=>$json_rajal,
			'json_ugd'=>$json_ugd,
			'json_ranap'=>$json_ranap,
			'json2'=>$json2,
			'title'=>$title,
		]);
	}
    public function actionObatHarianAll($start='',$end='',$cek='',$search=''){
		$obat = Trxresep::find()->joinWith(['obat as obt'])->where(['obt.idjenisobat'=>$search])->count();
		if($start !== '' && $end !== '' && $cek !== ''){
		
		$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/obat-harian?awal='.$start.'&akhir='.$end.'&jobat='.$search.'&limit='.$obat;
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}else{	
		$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/obat-harian?awal='.date('Y-m-d').'&akhir='.date('Y-m-d').'&jobat='.$search.'&limit='.$obat;
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}
		return $this->render('obat-harian-detail',['json2'=>$json2]);
	}
	
	public function actionGetObatHarianAll($start='',$end='',$cek='',$search=''){
		$obat = Trxresep::find()->joinWith(['obat as obt'])->where(['obt.idjenisobat'=>$search])->count();
		if($start !== '' && $end !== '' && $cek !== ''){
		
		$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/obat-harian?awal='.$start.'&akhir='.$end.'&jobat='.$search.'&limit='.$obat;
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}else{	
		$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/obat-harian?awal='.date('Y-m-d').'&akhir='.date('Y-m-d').'&jobat='.$search.'&limit='.$obat;
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}
		return $this->renderAjax('get-obat-harian-detail',['json2'=>$json2]);
	}
	public function actionObatKeluarHarian($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){			
		$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/obat-harian?awal='.$start.'&akhir='.$end.'&jobat='.$search.'&limit=10';
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}else{	
		$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/obat-harian?awal='.date('Y-m-d').'&akhir='.date('Y-m-d').'&jobat='.$search.'&limit=10';
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}
		return $this->render('obat-harian',['json2'=>$json2]);
	}
	
	public function actionGetObatHarian($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){			
		$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/obat-harian?awal='.$start.'&akhir='.$end.'&jobat='.$search.'&limit=10';
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}else{	
		$url2 = Yii::$app->params['baseUrl'].'/dashboard/rest/obat-harian?awal='.date('Y-m-d').'&akhir='.date('Y-m-d').'&jobat='.$search.'&limit=10';
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}
		return $this->renderAjax('search-obat-harian',['json2'=>$json2]);
	}
	public function actionDiagnosa($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){			
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/icd10?bulan='.$start.'&tahun='.$end;
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}else{	
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/icd10?bulan='.date('m').'&tahun='.date('Y');
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}
		return $this->render('diagnosa',['json2'=>$json2]);
	}
    public function actionGetSearch($start='', $end='',$cek='',$search='',$search2='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){			
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/icd10?bulan='.$start.'&tahun='.$end;
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}else{	
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/icd10?bulan='.date('m').'&tahun='.date('Y');
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);	
		}
		return $this->renderAjax('search',['json2'=>$json2]);
	
	}
    protected function findModel($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findBarang($id)
    {
        if (($model = BarangMasuk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
