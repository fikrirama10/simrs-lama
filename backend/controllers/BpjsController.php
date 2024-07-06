<?php

namespace backend\controllers;
use kartik\mpdf\Pdf;
use Yii;
use common\models\Dokumen;
use common\models\DokumenSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DokumenController implements the CRUD actions for Dokumen model.
 */
class BpjsController extends Controller
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
     * Lists all Dokumen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DokumenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Displays a single Dokumen model.
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
	
	public function actionCekPeserta()
    {
        return $this->render('cekpeserta');
    }
	
	public function actionShowAll($id){
		$time = date('Y-m-d');
		$nokartu =$id;
		$response=$this->get_content('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Peserta/nokartu/'.$nokartu.'/tglSEP/'.$time.'');
		$data_json=json_decode($response, true);
		$peserta = $data_json['response'];
		$kelas = $peserta['peserta'];
		
		if($data_json['response'] == null ){
		\Yii::$app->getSession()->setFlash('danger', 'Data Tidak Di Temukan');
		   return $this->renderAjax('_showAll', [
				'kelas' => $kelas,
				
			]);
		}
		return $this->renderAjax('_showAll', [
            'kelas' => $kelas,
            
        ]);

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
    /**
     * Creates a new Dokumen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
      public function actionCreate()
    {
        
		
		$model = new Dokumen();
		
		if($model->load(Yii::$app->request->post())){
			
			//generate kode dulu, ini akan digunakan untuk penamaan file dokumen
			$model->genKode();	
			$doc=UploadedFile::getInstance($model,'FileName');
						
			//echo $model->IdSKPD;
			//file handling...first
			if (!$doc == null) {
				
				$model->FileName=$model->Kode.'_'.Yii::$app->algo->cleanFileName($doc->name);
				$model->FileSize=$doc->size;
				$model->FileExt=$doc->extension;
				
				//upload dokumen dulu, baru simpan data kalau berhasil
				$path = Yii::$app->params['documentPath'] .'/'.$model->FileName; 
				$doc->saveAs($path);
				
				
			}
			else{
				
				$model->FileName = '';
				$model->FileSize=0;
				$model->FileExt='';
			}
						
			$model->UserId=Yii::$app->user->identity->id;
			$model->PublishDate=date('Y-m-d h:i:s');
												
			if($model->save(false)){return $this->redirect(['index']);} else {return $this->render('create', ['model' => $model,]);}
		
		
		}
		else 
		{
            return $this->render('create', ['model' => $model,]);
        }
		
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       if($model->load(Yii::$app->request->post())){
		   
		   $doc=UploadedFile::getInstance($model,'FileName');
		  
		  if (!$doc == null) {
				$model->FileName=$model->Kode.'_'.Yii::$app->algo->cleanFileName($doc->name);
				$model->FileSize=$doc->size;
				$model->FileExt=$doc->extension;
				
				//upload dokumen dulu, baru simpan data kalau berhasil
				$path = Yii::$app->params['documentPath'] .'/'.$model->FileName; 
				$doc->saveAs($path);
			}
			else{
				$doc->FileName = $model::findOne($model->Id)->FileName;
			}
		   		   
		   if( $model->save()){return $this->redirect(['index']);} else {return $this->render('update', ['model' => $model,]);}
		}

		else {
			return $this->render('update', ['model' => $model,]);
		
		}



    }
	public function actionReport()
	{
		
		$dataProvider = Dokumen::find()->all();
       
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report', ['dataProvider' => $dataProvider,  ]);
		
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
     * Finds the Dokumen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dokumen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dokumen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	 
    public function actionDelete($id)
    {
		$data = $this->findModel($id);
		unlink(Yii::$app->params['documentPath'].'/'.$data->FileName);
		$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
}
