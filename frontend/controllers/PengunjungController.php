<?php

namespace backend\controllers;

use Yii;
use common\models\Pasien;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Tindakandokter;
use common\models\RawatjalanSearch;
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
		//$andWhere = ['IdStat'=>4];
		}else{
		$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
		//$andWhere = ['jenis_kelamin'=>'L'];
		$title = 'Hari Ini';
		}
		$pasien = Pasien::find()->where($where)->all();
		$yanmas = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->count();
		$yanmasbaru = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Baru'])->count();
		$yanmaslama = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Old'])->count();
		$jumlah = Pasien::find()->where($where)->count();
		$jumlahbaru = Pasien::find()->where($where)->andwhere(['stpasien'=>'Baru'])->count();
		$jumlahlama = Pasien::find()->where($where)->andwhere(['stpasien'=>'Old'])->count();
		$pur = Pasien::find()->where(['idpekerjaan'=>13])->count();
		$purbaru = Pasien::find()->where(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Baru'])->count();
		$purlama = Pasien::find()->where(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Old'])->count();
		//TNI AU
		$tniaumilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->count();
		$tniausipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->count();
		$tniaukelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->count();
		$tniaumilbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniausipbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaukelbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaumillama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniausiplama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniaukellama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
		//TNI AD
		$tniadmilall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->count();
		$tniadsipall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->count();
		$tniadkelall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->count();
		$tniadmilbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadsipbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadkelbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniadsiplama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniadkellama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
			//TNI AL
		$tnialmilall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->count();
		$tnialsipall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->count();
		$tnialkelall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->count();
		$tnialmilbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialsipbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialkelbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tnialsiplama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tnialkellama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
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
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}
		$pasien = Pasien::find()->where($where)->all();
		$yanmas = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->count();
		$yanmasbaru = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Baru'])->count();
		$yanmaslama = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Old'])->count();
		$jumlah = Pasien::find()->where($where)->count();
		$jumlahbaru = Pasien::find()->where($where)->andwhere(['stpasien'=>'Baru'])->count();
		$jumlahlama = Pasien::find()->where($where)->andwhere(['stpasien'=>'Old'])->count();
		$pur = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>13])->count();
		$purbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Baru'])->count();
		$purlama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Old'])->count();
		//TNI AU
		$tniaumilall = Pasien::find()->where($where)->andwhere($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->count();
		$tniausipall = Pasien::find()->where($where)->andwhere($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->count();
		$tniaukelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->count();
		$tniaumilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniausipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaukelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaumillama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniausiplama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniaukellama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
		//TNI AD
		$tniadmilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->count();
		$tniadsipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->count();
		$tniadkelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->count();
		$tniadmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniadsiplama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniadkellama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
			//TNI AL
		$tnialmilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->count();
		$tnialsipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->count();
		$tnialkelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->count();
		$tnialmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tnialsiplama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tnialkellama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
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
		
		'pur'=>$pur,
		'purbaru'=>$purbaru,
		'purlama'=>$purlama,
		
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
	  public function actionReport($start='', $end='', $cek='', $search='') {
	  //tampilkan bukti proses
	  if($start !== '' && $end !== '' && $cek !== ''){
			if($cek == 'today'){ $title = 'Hari ini'; }
			else if($cek == 'this_month'){ $title = 'Bulan ini'; }
			else if($cek == 'this_year'){ $title = 'Tahun ini'; }
		else if($cek == 'custom'){ $title = date('F', strtotime($start)); }
			
			// else if($cek == 'custom'){ $title = 'Periode '.date('d F Y', strtotime($start)).' - '.date('d F Y', strtotime($end)); }
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', $start, $end];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(created_at,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andWhere = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $start, $end];
			$andFilterWhere = ['or',['like', 'idjenisrawat', $search], ];
		
		
		}
		$pasien = Pasien::find()->where($where)->all();
		$yanmas = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->count();
		$yanmasbaru = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Baru'])->count();
		$yanmaslama = Pasien::find()->where($where)->andwhere(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Old'])->count();
		$jumlah = Pasien::find()->where($where)->count();
		$jumlahbaru = Pasien::find()->where($where)->andwhere(['stpasien'=>'Baru'])->count();
		$jumlahlama = Pasien::find()->where($where)->andwhere(['stpasien'=>'Old'])->count();
		$pur = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>13])->count();
		$purbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Baru'])->count();
		$purlama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Old'])->count();
		//TNI AU
		$tniaumilall = Pasien::find()->where($where)->andwhere($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->count();
		$tniausipall = Pasien::find()->where($where)->andwhere($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->count();
		$tniaukelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->count();
		$tniaumilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniausipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaukelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniaumillama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniausiplama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniaukellama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>1])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
		//TNI AD
		$tniadmilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->count();
		$tniadsipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->count();
		$tniadkelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->count();
		$tniadmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tniadmillama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniadsiplama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tniadkellama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>3])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
			//TNI AL
		$tnialmilall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->count();
		$tnialsipall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->count();
		$tnialkelall = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->count();
		$tnialmilbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialsipbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialkelbaru = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Baru'])->count();
		$tnialmillama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
		$tnialsiplama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Sipil'])->andwhere(['stpasien'=>'Old'])->count();
		$tnialkellama = Pasien::find()->where($where)->andwhere(['idpekerjaan'=>4])->andwhere(['subid'=>'Keluarga'])->andwhere(['stpasien'=>'Old'])->count();
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

	  $content  = $this->renderPartial('printkunjungan',[
	  'jumlah'=>$jumlah,
		'jumlahbaru'=>$jumlahbaru,
		'jumlahlama'=>$jumlahlama,
		'title'=>$title,
		'pur'=>$pur,
		'purbaru'=>$purbaru,
		'purlama'=>$purlama,
		
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
