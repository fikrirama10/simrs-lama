<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Tindakandokter;
use common\models\RawatjalanSearch;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatjalanController implements the CRUD actions for Rawatjalan model.
 */
class CassaController extends Controller
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
		$where = ['between','status',3,3];
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
	public function actionKeybpjs(){
			$data = "29250";
			$secretKey = "5lQ5E30F4C";
         // Computes the timestamp
          date_default_timezone_set('UTC');
          $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
           // Computes the signature by hashing the salt with the secret key as the key
			$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
 
   // base64 encode…
   $encodedSignature = base64_encode($signature);
	 return $this->render('keybpjs', [
            'secretKey' => $secretKey,
            'encodedSignature' => $encodedSignature,
            'signature' => $signature,
			'tStamp'=>$tStamp,
			
        ]);
   }
   public function actionPrint($id) {
      //tampilkan bukti proses
	  $model = Transaksi::find()->where(['id'=>$id])->one();
	  $content = $this->renderPartial('printfaktur',['model'=>$model]);
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
		'format' => [210,148],
		'marginTop' => '4',
		'marginRight' => '4',
		'marginLeft' => '4',
		'marginBottom' => '4',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/faktur.css',
       // 'methods' => [ 
            // 'SetFooter'=>['RSAU dr. NORMAN T.LUBIS ,'],
        // ]
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
