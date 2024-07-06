<?php

namespace backend\controllers;

use Yii;
use kartik\mpdf\Pdf;
use common\models\Klpcm;
use common\models\Pasien;
use yii\web\UploadedFile;
use common\models\Rawatjalan;
use common\models\KlpcmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KlpcmController implements the CRUD actions for Klpcm model.
 */
class KlpcmrajalController extends Controller
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
    public function actionShowAll($id){
		$rekmed = Rawatjalan::find()->where(['no_rekmed'=>$id])->andwhere(['klpcm'=>1])->andwhere(['idjenisrawat'=>1])->all();
		return $this->renderAjax('_showAll', [
            'rekmed' => $rekmed,
        ]);

	}
	public function actionGetPasien()
    {
		$kode = Yii::$app->request->post('id');	
		if($kode){
			$model = Rawatjalan::find()->where(['id'=>$kode])->one();
		}else{
			$model = "";
		}
		return \yii\helpers\Json::encode($model);
    }
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
			$andWhere = ['jenisrawat'=>1];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
		}else{
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			//$andFilterWhere = ['or',['like', 'idpoli', $search], ];
			$andWhere = ['jenisrawat'=>1];
			$title = 'Hari Ini';
		}

        $searchModel = new KlpcmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere);
        // get your HTML raw content without any layouts or scripts
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
        ]);
    }
	 public function actionGetSearch($start='', $end='',$cek='',$search='')
    {
    	$start = date('Y-m-d', strtotime($start));
		$end = date('Y-m-d', strtotime($end));
		$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', $start, $end];
		$andWhere = ['idpoli'=>4];
        $searchModel = new KlpcmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where,$andWhere);
     

        return $this->renderAjax('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
			
		
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
			$andWhere = ['lengkap'=>0];	
			$andWhere2 = ['jenisrawat'=>1];	
			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
			
		}else{
			$title = 'Hari Ini';
			$where = ['between', 'DATE_FORMAT(tanggal,"%Y-%m-%d")', date('Y-m-d'), date('Y-m-d')];
			$andFilterWhere = ['or',['like', 'idpoli', $search], ];
			$andWhere = ['lengkap'=>0];	
			$andWhere2 = ['jenisrawat'=>1];	
		
			
			
		}
		
		$dataProvider = Klpcm::find()->where($where)->andWhere($andWhere)->andWhere($andWhere2)->andFilterWhere($andFilterWhere)->all();
       
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
		$model = $this->findModel($id);
		$rajal = Rawatjalan::find()->where(['id'=>$model->idrajal])->one();
		if($model->load(Yii::$app->request->post())){
		
			$doc=UploadedFile::getInstance($model,'dokumen');
			if (!$doc == null) {				
				$model->dokumen=$model->idrajal.'-'.$model->no_rekmed.'('.$model->jenisrawat.')'.'_'.Yii::$app->algo->cleanFileName($doc->name);
								
				//upload dokumen dulu, baru simpan data kalau berhasil
				$path = Yii::$app->params['documentPath'] .'/'.$model->dokumen; 
				$doc->saveAs($path);				
			}else{				
				$model->dokumen = '';
			}
			if($model->save(false)){
				$rajal->dokumen = $model->dokumen;
				$rajal->save(false);
				return $this->redirect(['index']);
			}else{
				return $this->render('view', [
					'model' => $model,
				]);
			}			
		
		}
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Klpcm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionListdiagnosa($id)
	  {
		$response = $this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/referensi/diagnosa/'.$id.'');
		$data_json = json_decode($response, true);
		$diagnosa = $data_json['response'];
		$dd= $diagnosa['diagnosa'];
		//print_r($dd);
		echo"<option value='0'>- Pilih Diagnosa -</option>";
		for($a=0; $a < count($dd); $a++)
		{
		 echo"<option value='".$dd[$a]['nama']."'>".$dd[$a]['nama']."</option>";

		}
	  }
	  public function get_content($url, $post = '') {
		
		// $data = "29250";
		// $secretKey = "5lQ5E30F4C";
		$data = "29855";
		$secretKey = "3rU307868B";
         // Computes the timestamp
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        // Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		$header[] = 'Content-Type: application/json;charset=utf-8';
		$header[] = "Accept-Encoding: gzip, deflate";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		// curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

		if ($post)
		{
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$rs = curl_exec($ch);
		
		if(empty($rs)){
			//var_dump($rs, curl_error($ch));
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return $rs;
	}
    public function actionCreate()
    {
        $model = new Klpcm();
		$post = Yii::$app->request->post();
		$dataTemplate = Rawatjalan::find()->where(['idjenisrawat'=>1])->andwhere(['klpcm'=>1])->orderby(['idpoli'=>SORT_DESC,'idrawat'=>SORT_DESC])->all();
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
			$model->jenisrawat = 1;
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
				return $this->redirect(['view', 'id' => $model->id]);
				}
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$dataTemplate = Rawatjalan::find()->where(['idjenisrawat'=>1])->andwhere(['klpcm'=>1])->orderby(['idpoli'=>SORT_DESC])->all();
		$post = Yii::$app->request->post();
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
            'dataTemplate' => $dataTemplate,
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
