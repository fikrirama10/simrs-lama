<?php

namespace backend\controllers;

use Yii;
use common\models\Pasien;
use common\models\Keluhan;
use common\models\Kunjungan;
use common\models\Resepdokter;
use common\models\Tindakandokter;
use common\models\RawatjalanSearch;
use common\models\Rawatjalan;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class PengunjungController extends Controller
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
     * Lists all Rawatjalan models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new PasienSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		//$dataProvider->query->where('status = 3');
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rawatjalan model.
     * @param integer $id
     * @return mixed
     */
    public function actionKunjungan($start='', $end='',$cek='')
    {
		if($start !== '' && $end !== '' && $cek !== ''){
		if($cek == 'today'){ $title = 'Hari ini'; }
		else if($cek == 'this_month'){ $title = 'Bulan ini'; }
		else if($cek == 'this_year'){ $title = 'Tahun ini'; }
		// else if($cek == 'custom'){ $title = 'Periode'; }
		else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F  	Y', strtotime($end)); }
		
		$start = date('Y-m-d', strtotime($start));
		$end = date('Y-m-d', strtotime($end));
		$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', $start, $end];
		$where2 = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
		//$andWhere = ['IdStat'=>4];
		}else{
		$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
		$where2 = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'),  date('Y-m-d')];
		//$andWhere = ['jenis_kelamin'=>'L'];
		$title = 'Hari Ini';
		}
		$pasien = Pasien::find()->where($where)->all();
		$ptni = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andWhere(['idjenisrawat'=>1])->count();
		$ptni2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['between','pasien.idpekerjaan',3,4])->andWhere(['idjenisrawat'=>1])->count();
		$patni = $ptni + $ptni2;
		$aubaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan < 2 ')->count();
		$aulama = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan > 2 ')->count();
		$ausemua = $aulama + $aubaru ;
		$kelaubaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['>','pasien.idpekerjaan',1])->andwhere('kunjungan < 2 ')->count();
		$kelaulama = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['>','pasien.idpekerjaan',1])->andwhere('kunjungan > 2 ')->count();
		$kelausemua = $kelaulama + $kelaubaru ;
		
		$yanmasbaru = Rawatjalan::find()->where($where2)->andwhere('kunjungan < 2')->andWhere(['idbayar'=>4])->count();
		$yanmaslama = Rawatjalan::find()->where($where2)->andwhere('kunjungan > 1')->andWhere(['idbayar'=>4])->count();
		$yanmas = $yanmasbaru + $yanmaslama ;
		
		$bpjsbaru = Rawatjalan::find()->where($where2)->andwhere('kunjungan < 2')->andWhere(['idbayar'=>5])->count();
		$bpjslama = Rawatjalan::find()->where($where2)->andwhere('kunjungan > 1')->andWhere(['idbayar'=>5])->count();
		$bpjs = $bpjsbaru + $bpjslama ;
		
		$jumlahbaru = Pasien::find()->where($where)->andwhere(['stpasien'=>'Baru'])->count();
		$jumlahlama = Kunjungan::find()->where($where)->count();
		$jumlah = $jumlahbaru + $jumlahlama;
		$pur = Pasien::find()->where(['idpekerjaan'=>12])->count();
		$purbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['stpasien'=>'Baru'])->count();
		$purlama = Kunjungan::find()->where(['idpekerjaan'=>12])->andwhere($where)->count();
		//TNI AU
		// $tniaumilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->count();
		// $tniausipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->count();
		// $tniaukelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->count();
		
		$tniaumilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaumillama = Kunjungan::find()->where(['idpekerjaan'=>1])->andwhere($where)->count();
		$tniaumilall = $tniaumilbaru + $tniaumillama;
		
		$tniausipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniausiplama = Kunjungan::find()->where(['idpekerjaan'=>1])->andwhere(['sebagai'=>'Sipil'])->count();
		$tniausipall = $tniausipbaru + $tniausiplama ;
		
		$tniaukelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaukellama = Kunjungan::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tniaukelall = $tniaukelbaru + $tniaukellama ;
		//TNI AD
		$tniadsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadsiplama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Sipil'])->count();
		$tniadsipall = $tniadsipbaru + $tniadsiplama ;
			
		$tniadmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Mil'])->count();
		$tniadmilall = $tniadmilbaru + $tniadmillama ;
		
		$tniadkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tniadkelall = $tniadkelbaru + $tniadmillama ;
		
			//TNI AL
		$tnialsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialsiplama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Sipil'])->count();
		$tnialsipall = $tnialsipbaru + $tnialsiplama ;
			
		$tnialmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Mil'])->count();
		$tnialmilall = $tnialmilbaru + $tnialmillama ;
		
		$tnialkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Kunjungan::find()->where(['idpekerjaan'=>4])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tnialkelall = $tnialkelbaru + $tnialmillama ;
		//polri
		$polrimilall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->count();
		$polrisipall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sipil'])->count();
		$polrikelall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->count();
		$polrimilbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrisipbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrikelbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrimillama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$polrisiplama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$polrikellama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
		 return $this->render('kunjungan', [
       'jumlah'=>$jumlah,
		'jumlahbaru'=>$jumlahbaru,
		'jumlahlama'=>$jumlahlama,
		
		'pur'=>$pur,
		'purbaru'=>$purbaru,
		'purlama'=>$purlama,
		
		'yanmas'=>$yanmas,
		'yanmasbaru'=>$yanmasbaru,
		'yanmaslama'=>$yanmaslama,
		
		'kelaulama'=>$kelaulama,
		'aulama'=>$aulama,
		'kelubaru'=>$kelaubaru,
		'ubaru'=>$aubaru,
		'kelausemua'=>$kelausemua,
		'ausemua'=>$ausemua,
		
		'bpjs'=>$bpjs,
		'bpjsbaru'=>$bpjsbaru,
		'bpjslama'=>$bpjslama,
		
		'tniaumilall'=>$tniaumilall,
		'tniausipall'=>$tniausipall,
		'tniaukelall'=>$tniaukelall,
		'tniaumilbaru'=>$tniaumilbaru,
		'tniausipbaru'=>$tniausipbaru,
		'tniaukelbaru'=>$tniaukelbaru,
		'tniaumillama'=>$tniaumillama,
		'tniausiplama'=>$tniaumillama,
		'tniaukellama'=>$tniaumillama,
		
		'tniadmilall'=>$tniadmilall,
		'tniadsipall'=>$tniadsipall,
		'tniadkelall'=>$tniadkelall,
		'tniadmilbaru'=>$tniadmilbaru,
		'tniadsipbaru'=>$tniadsipbaru,
		'tniadkelbaru'=>$tniadkelbaru,
		'tniadmillama'=>$tniadmillama,
		'tniadsiplama'=>$tniadmillama,
		'tniadkellama'=>$tniadmillama,
		
		'tnialmilall'=>$tnialmilall,
		'tnialsipall'=>$tnialsipall,
		'tnialkelall'=>$tnialkelall,
		'tnialmilbaru'=>$tnialmilbaru,
		'tnialsipbaru'=>$tnialsipbaru,
		'tnialkelbaru'=>$tnialkelbaru,
		'tnialmillama'=>$tnialmillama,
		'tnialsiplama'=>$tnialmillama,
		'tnialkellama'=>$tnialmillama,
		
		'polrimilall'=>$polrimilall,
		'polrisipall'=>$polrisipall,
		'polrikelall'=>$polrikelall,
		'polrimilbaru'=>$polrimilbaru,
		'polrisipbaru'=>$polrisipbaru,
		'polrikelbaru'=>$polrikelbaru,
		'polrimillama'=>$polrimillama,
		'polrisiplama'=>$polrimillama,
		'polrikellama'=>$polrimillama,
		
			
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
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', $start, $end];
			$where2 = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$where2 = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}
		$pasien = Pasien::find()->where($where)->all();
		
		$aubaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan < 2 ')->count();
		$aulama = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan > 2 ')->count();
		$ausemua = $aulama + $aubaru ;
		
		$yanmasbaru = Rawatjalan::find()->where($where2)->andwhere('kunjungan < 2')->andWhere(['idbayar'=>4])->count();
		$yanmaslama = Rawatjalan::find()->where($where2)->andwhere('kunjungan > 1')->andWhere(['idbayar'=>4])->count();
		$yanmas = $yanmasbaru + $yanmaslama ;
		
		$bpjsbaru = Rawatjalan::find()->where($where2)->andwhere('kunjungan < 2')->andWhere(['idbayar'=>5])->count();
		$bpjslama = Rawatjalan::find()->where($where2)->andwhere('kunjungan > 1')->andWhere(['idbayar'=>5])->count();
		$bpjs = $bpjsbaru + $bpjslama ;
		$ptni = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andWhere(['idjenisrawat'=>1])->count();
		$ptni2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['between','pasien.idpekerjaan',3,4])->andWhere(['idjenisrawat'=>1])->count();
		$patni = $ptni + $ptni2;
		
		$jumlahbaru = Pasien::find()->where($where)->andwhere(['stpasien'=>'Baru'])->count();
		$jumlahlama = Kunjungan::find()->where($where)->count();
		$jumlah = $jumlahbaru + $jumlahlama;
		$pur = Pasien::find()->where(['idpekerjaan'=>12])->count();
		$purbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['stpasien'=>'Baru'])->count();
		$purlama = Kunjungan::find()->where(['idpekerjaan'=>12])->count();
		//TNI AU
		// $tniaumilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->count();
		// $tniausipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->count();
		// $tniaukelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->count();
		
	
		$tniaumilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaumillama = Kunjungan::find()->where(['idpekerjaan'=>1])->andwhere($where)->count();
		$tniaumilall = $tniaumilbaru + $tniaumillama;
		
		
		$tniausipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniausiplama = Kunjungan::find()->where(['idpekerjaan'=>1])->andwhere(['sebagai'=>'Sipil'])->count();
		$tniausipall = $tniausipbaru + $tniausiplama ;
		
		$tniaukelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaukellama = Kunjungan::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tniaukelall = $tniaukelbaru + $tniaukellama ;
		//TNI AD
		$tniadsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadsiplama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Sipil'])->count();
		$tniadsipall = $tniadsipbaru + $tniadsiplama ;
			
			
			$kelaubaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['>','pasien.idpekerjaan',1])->andwhere('kunjungan < 2 ')->count();
		$kelaulama = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['>','pasien.idpekerjaan',1])->andwhere('kunjungan > 2 ')->count();
		$kelausemua = $kelaulama + $kelaubaru ;
			
		$tniadmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Mil'])->count();
		$tniadmilall = $tniadmilbaru + $tniadmillama ;
		
		$tniadkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tniadkelall = $tniadkelbaru + $tniadmillama ;
		
			//TNI AL
		$tnialsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialsiplama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Sipil'])->count();
		$tnialsipall = $tnialsipbaru + $tnialsiplama ;
			
		$tnialmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Mil'])->count();
		$tnialmilall = $tnialmilbaru + $tnialmillama ;
		
		$tnialkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Kunjungan::find()->where(['idpekerjaan'=>4])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tnialkelall = $tnialkelbaru + $tnialmillama ;
		//polri
		$polrimilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->count();
		$polrisipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Sipil'])->count();
		$polrikelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->count();
		$polrimilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrisipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrikelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrimillama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$polrisiplama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$polrikellama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();

        return $this->renderAjax('search', [

		'jumlah'=>$jumlah,
		'jumlahbaru'=>$jumlahbaru,
		'jumlahlama'=>$jumlahlama,
		
		'aulama'=>$aulama,
		'ubaru'=>$aubaru,
		'ausemua'=>$ausemua,
		
		'bpjs'=>$bpjs,
		'patni'=>$patni,
		'bpjsbaru'=>$bpjsbaru,
		'bpjslama'=>$bpjslama,
		
		'yanmas'=>$yanmas,
		'yanmasbaru'=>$yanmasbaru,
		'yanmaslama'=>$yanmaslama,
		
		'tniaumilall'=>$tniaumilall,
		'tniausipall'=>$tniausipall,
		'tniaukelall'=>$tniaukelall,
		'tniaumilbaru'=>$tniaumilbaru,
		'tniausipbaru'=>$tniausipbaru,
		'tniaukelbaru'=>$tniaukelbaru,
		'tniaumillama'=>$tniaumillama,
		'tniausiplama'=>$tniausiplama,
		'tniaukellama'=>$tniaukellama,
		
		'tniadmilall'=>$tniadmilall,
		'tniadsipall'=>$tniadsipall,
		'tniadkelall'=>$tniadkelall,
		'tniadmilbaru'=>$tniadmilbaru,
		'tniadsipbaru'=>$tniadsipbaru,
		'tniadkelbaru'=>$tniadkelbaru,
		'tniadmillama'=>$tniadmillama,
		'tniadsiplama'=>$tniadmillama,
		'tniadkellama'=>$tniadmillama,
		
		'tnialmilall'=>$tnialmilall,
		'tnialsipall'=>$tnialsipall,
		'tnialkelall'=>$tnialkelall,
		'tnialmilbaru'=>$tnialmilbaru,
		'tnialsipbaru'=>$tnialsipbaru,
		'tnialkelbaru'=>$tnialkelbaru,
		'tnialmillama'=>$tnialmillama,
		'tnialsiplama'=>$tnialmillama,
		'tnialkellama'=>$tnialmillama,
		
		'polrimilall'=>$polrimilall,
		'polrisipall'=>$polrisipall,
		'polrikelall'=>$polrikelall,
		'polrimilbaru'=>$polrimilbaru,
		'polrisipbaru'=>$polrisipbaru,
		'polrikelbaru'=>$polrikelbaru,
		'polrimillama'=>$polrimillama,
		'polrisiplama'=>$polrimillama,
		'polrikellama'=>$polrimillama,
		
        ]);
    }

    /**
     * Creates a new Rawatjalan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rawatjalan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	 public function actionTindakan($id)
	  {
		$models=Tindakandokter::find()->where(['idtindakan' => $id])->all();
		
		foreach($models as $k){
		  echo "<input value='".$k->tindakan->tarif."'></input>";
		}
	  }
	  public function actionReport($start='', $end='', $cek='') {
	  //tampilkan bukti proses
	if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
			else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', $start, $end];
			$where2 = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$where2 = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$title = 'Hari Ini';
			//$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}
		
		
			$pasien = Pasien::find()->where($where)->all();
		$pnstni = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>2])->andWhere(['pasien.subid' => 'Mil'])->count();
		$aubaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan < 2 ')->count();
		
		$aulama = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andwhere('kunjungan > 1 ')->count();
		$ausemua = $aulama + $aubaru ;
			
			$kelaubaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['>','pasien.idpekerjaan',1])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan < 2 ')->count();
		$kelaulama = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['>','pasien.idpekerjaan',1])->andwhere(['rawatjalan.anggota'=>1])->andwhere('kunjungan > 2 ')->count();
		$kelausemua = $kelaulama + $kelaubaru ;
		$yanmasbaru = Rawatjalan::find()->where($where2)->andwhere('kunjungan < 2')->andWhere(['idbayar'=>4])->count();
		$yanmaslama = Rawatjalan::find()->where($where2)->andwhere('kunjungan > 1')->andWhere(['idbayar'=>4])->count();
		$yanmas = $yanmasbaru + $yanmaslama ;
		$ptniri = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andWhere(['idjenisrawat'=>2])->count();
		$ptniri2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['>','pasien.idpekerjaan',4])->andWhere(['idjenisrawat'=>2])->count();
		$pkelri = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['rawatjalan.anggota'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andWhere(['idjenisrawat'=>2])->count();
		$muri = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['rawatjalan.anggota'=>null])->andwhere(['>','pasien.idpekerjaan',4])->andWhere(['idjenisrawat'=>2])->count();
		$ppurnri = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>12])->andWhere(['idjenisrawat'=>2])->count();
		$tniri = $ptniri + $ptniri2 ;
		$ptni = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>1])->andWhere(['idjenisrawat'=>1])->count();
		$ppns = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>2])->andWhere(['idjenisrawat'=>1])->count();
		$ppnsri = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>2])->andWhere(['idjenisrawat'=>2])->count();
		$ppns2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>2])->andWhere(['idjenisrawat'=>3])->count();
		$pkel = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['rawatjalan.anggota'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andWhere(['idjenisrawat'=>3])->count();
		$pkel2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['rawatjalan.anggota'=>1])->andwhere(['>','pasien.idpekerjaan',4])->andWhere(['idjenisrawat'=>1])->count();
		$mu = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['rawatjalan.anggota'=>null])->andwhere(['>','pasien.idpekerjaan',4])->andWhere(['idjenisrawat'=>1])->count();
		$mu2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['rawatjalan.anggota'=>null])->andwhere(['>','pasien.idpekerjaan',4])->andWhere(['idjenisrawat'=>3])->count();
		$ppurn = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>12])->andWhere(['idjenisrawat'=>3])->count();
		$ppurn2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>12])->andWhere(['idjenisrawat'=>3])->count();
		$tniigd = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>12])->andWhere(['idjenisrawat'=>1])->count();
		$tniigd2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['between','pasien.idpekerjaan',3,4])->andWhere(['idjenisrawat'=>3])->count();
		$ptni2 = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['between','pasien.idpekerjaan',3,4])->andWhere(['idjenisrawat'=>1])->count();
		$patni = $ptni + $ptni2 + $tniigd + $tniigd2;
		$papns = $ppns + $ppns2;
		$pakel = $pkel + $pkel2;
		$pmu = $mu + $mu2;
		$papurn = $ppurn + $ppurn2;
		$bpjsbaru = Rawatjalan::find()->where($where2)->andwhere('kunjungan < 2')->andWhere(['idbayar'=>5])->count();
		$bpjslama = Rawatjalan::find()->where($where2)->andwhere('kunjungan > 1')->andWhere(['idbayar'=>5])->count();
		$bpjs = $bpjsbaru + $bpjslama ;
		$semua = $ausemua + $yanmas + $bpjs +67 +78;
		$semuabaru = $aubaru + $yanmasbaru + $bpjsbaru +29 +35;
		$semualama = $aulama + $yanmaslama + $bpjslama +38 +43;
		
		$jumlahbaru = Pasien::find()->where($where)->andwhere(['stpasien'=>'Baru'])->count();
		$jumlahlama = Kunjungan::find()->where($where)->count();
		$jumlah = $jumlahbaru + $jumlahlama;
		
		$purbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['stpasien'=>'Baru'])->count();
		$purlama = Kunjungan::find()->where(['idpekerjaan'=>12])->count();
		$pur = $purlama + $purbaru;
		$tni = $jumlah - $yanmas - $pur;
		$tnibaru = $jumlahbaru - $yanmasbaru - $purbaru;
		$tnilama = $jumlahlama - $yanmaslama - $purlama;
		//TNI AU
		// $tniaumilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->count();
		// $tniausipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->count();
		// $tniaukelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->count();
		
		$tniaumilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaumillama = Kunjungan::find()->where(['idpekerjaan'=>1])->andwhere($where)->count();
		$tniaumilall = $tniaumilbaru + $tniaumillama;
		
		$bpjsanggota = Rawatjalan::find()->where($where2)->andwhere(['anggota'=>1])->count();
		$tniaumillama = Kunjungan::find()->where(['idpekerjaan'=>1])->andwhere($where)->count();
		$tniaumilall = $tniaumilbaru + $tniaumillama;
		
		$tniausipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniausiplama = Kunjungan::find()->where(['idpekerjaan'=>1])->andwhere(['sebagai'=>'Sipil'])->count();
		$tniausipall = $tniausipbaru + $tniausiplama ;
		
		$tniaukelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaukellama = Kunjungan::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tniaukelall = $tniaukelbaru + $tniaukellama ;
		//TNI AD
		$tniadsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadsiplama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Sipil'])->count();
		$tniadsipall = $tniadsipbaru + $tniadsiplama ;
			
		$tniadmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Mil'])->count();
		$tniadmilall = $tniadmilbaru + $tniadmillama ;
		
		$tniadkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tniadkelall = $tniadkelbaru + $tniadmillama ;
		
			//TNI AL
		// $tnialsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialsipbaru = Rawatjalan::find()->joinWith(['pasien as pasien'])->where($where2)->andwhere(['pasien.idpekerjaan'=>4])->andwhere(['pasien.subid'=>'Sipil'])->andwhere('kunjungan < 2 ')->count();
		$tnialsiplama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Sipil'])->count();
		$tnialsipall = $tnialsipbaru + $tnialsiplama ;
			
		$tnialmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Kunjungan::find()->where(['idpekerjaan'=>3])->andwhere(['sebagai'=>'Mil'])->count();
		$tnialmilall = $tnialmilbaru + $tnialmillama ;
		
		$tnialkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Kunjungan::find()->where(['idpekerjaan'=>4])->andwhere(['sebagai'=>'Keluarga'])->count();
		$tnialkelall = $tnialkelbaru + $tnialmillama ;
		//polri
		$polrimilall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->count();
		$polrisipall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sipil'])->count();
		$polrikelall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->count();
		$polrimilbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrisipbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrikelbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$polrimillama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$polrisiplama = Pasien::find()->where(['idpekerjaan'=>182])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$polrikellama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();

	  $content  = $this->renderPartial('printkunjungan',[
		'jumlah'=>$jumlah,
		'jumlahbaru'=>$jumlahbaru,
		'jumlahlama'=>$jumlahlama,
		'tni'=>$tni,
		'pmu'=>$pmu,
		'tniri'=>$tniri,
		'papurn'=>$papurn,
		'tnibaru'=>$tnibaru,
		'tnilama'=>$tnilama,
		'ppurnri'=>$ppurnri,
		'pnstni'=>$pnstni,
		'patni'=>$patni,
		'ppnsri'=>$ppnsri,
		'muri'=>$muri,
		'pkelri'=>$pkelri,
		'pakel'=>$pakel,
		
		'kelaulama'=>$kelaulama,
		'aulama'=>$aulama,
		'kelubaru'=>$kelaubaru,
		'aubaru'=>$aubaru,
		'kelausemua'=>$kelausemua,
		'ausemua'=>$ausemua,
		
		'semua'=>$semua,
		'semuabaru'=>$semuabaru,
		'semualama'=>$semualama,
		'title'=>$title,
		
		'bpjs'=>$bpjs,
		'bpjsbaru'=>$bpjsbaru,
		'bpjslama'=>$bpjslama,
		
		'ppns'=>$ppns,
		'yanmas'=>$yanmas,
		'yanmasbaru'=>$yanmasbaru,
		'yanmaslama'=>$yanmaslama,
		
		'tniaumilall'=>$tniaumilall,
		'tniausipall'=>$tniausipall,
		'tniaukelall'=>$tniaukelall,
		'tniaumilbaru'=>$tniaumilbaru,
		'tniausipbaru'=>$tniausipbaru,
		'kelaubaru'=>$kelaubaru,
		'kelaulama'=>$kelaulama,
		'kelausemua'=>$kelausemua,
		
		'tniadmilall'=>$tniadmilall,
		'tniadsipall'=>$tniadsipall,
		'tniadkelall'=>$tniadkelall,
		'tniadmilbaru'=>$tniadmilbaru,
		'tniadsipbaru'=>$tniadsipbaru,
		'tniadkelbaru'=>$tniadkelbaru,
		'tniadmillama'=>$tniadmillama,
		'tniadsiplama'=>$tniadmillama,
		'tniadkellama'=>$tniadmillama,
		
		'tnialmilall'=>$tnialmilall,
		'tnialsipall'=>$tnialsipall,
		'tnialkelall'=>$tnialkelall,
		'tnialmilbaru'=>$tnialmilbaru,
		'tnialsipbaru'=>$tnialsipbaru,
		'tnialkelbaru'=>$tnialkelbaru,
		'tnialmillama'=>$tnialmillama,
		'tnialsiplama'=>$tnialmillama,
		'tnialkellama'=>$tnialmillama,
		'title' => $title,
		'polrimilall'=>$polrimilall,
		'polrisipall'=>$polrisipall,
		'polrikelall'=>$polrikelall,
		'polrimilbaru'=>$polrimilbaru,
		'polrisipbaru'=>$polrisipbaru,
		'polrikelbaru'=>$polrikelbaru,
		'polrimillama'=>$polrimillama,
		'polrisiplama'=>$polrimillama,
		'polrikellama'=>$polrimillama,
		
       
	  
	  ]);
	  
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_LEGAL, 
	   'marginTop' => '10 mm',
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 
	   'marginLeft' => '3mm',
	   'marginRight' => '3mm',
	   'marginBottom' => '3mm',
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
	   //'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }

    /**
     * Updates an existing Rawatjalan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */


	
    /**
     * Deletes an existing Rawatjalan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
  

    /**
     * Finds the Rawatjalan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rawatjalan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
