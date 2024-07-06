<?php

namespace backend\controllers;

use Yii;
use common\models\Rawatjalan;
use common\models\Pasien;
use common\models\Tb;
use common\models\PasienSearch;
use common\models\RawatjalantbSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AidobcController implements the CRUD actions for Aidobc model.
 */
class TbController extends Controller
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
     * Lists all Aidobc models.
     * @return mixed
     */
     public function actionTbx(){
		$searchModel = new RawatjalantbSearch();
		$where = ['diagket'=>'TB+'];
		$andwhere = ['between','YEAR(tgldaftar)',2021,2022];
		
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where,$andwhere);

        return $this->render('tbx', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
    public function actionIndex()
    {
        $searchModel = new RawatjalantbSearch();
		$where = ['diagket'=>'TB+'];
		
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aidobc model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInput($id){
		$model = Rawatjalan::find()->where(['id'=>$id])->one();
		return $this->render('input',[
			'model'=>$model,
		]);
	}
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
        return $this->render('view', [
            'model' => $model,
            'pasien' => $pasien,
        ]);
    }

    /**
     * Creates a new Aidobc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aidobc();

      if ($model->load(Yii::$app->request->post()) 
			&& Model::validateMultiple([$model])) {
			$jumlah = $model->cukurclipper + $model->waktucukur + $model->mandi + $model->antibiotic + $model->tdkinfeksi + $model->kontrolgula;	
			$model->tanggal = date('Y-m-d h:i:s',strtotime('+5 hour',strtotime(date('Y-m-d h:i:s'))));
			$model->validator = Yii::$app->user->identity->id;
			$model->jumlah = $jumlah;
			if($model->save()){
			  
				 return $this->redirect(['view', 'id' => $model->id]);
			}
			else
			{	
				return $this->render('create', ['model' => $model,]);
			}
			
		   
		} else {
			return $this->render('create', ['model' => $model,]);
		
		}
    }

    /**
     * Updates an existing Aidobc model.
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
     * Deletes an existing Aidobc model.
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
	public function actionShowAll($id){
		$baca = 'http://localhost/simrs/api/pasien/'.$id;
		$response=file_get_contents($baca);
		$kelas=json_decode($response, true);
		
		$model = new Tb();

		return $this->renderAjax('_showAll', [
            'model' => $model,
            'kelas' => $kelas,
        ]);

	}
	public function get_content($url, $post = '') {
		
         // Computes the timestamp
        date_default_timezone_set('UTC');
       
		$encodedSignature = base64_encode($signature);
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$usecookie = __DIR__ . "/cookie.txt";
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
     * Finds the Aidobc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aidobc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
