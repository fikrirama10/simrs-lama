<?php

namespace backend\controllers;

use Yii;
use common\models\Usg;
use common\models\Usgdetail;
use common\models\UsgSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsgController implements the CRUD actions for Usg model.
 */
class UsgController extends Controller
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
     * Lists all Usg models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usg model.
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
     * Creates a new Usg model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usg();
		
        if ($model->load(Yii::$app->request->post())) {
			$model->genKode();
			if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
			}else{
				return $this->render('create', [
				'model' => $model,
				]);
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
	public function actionShowAll($id){
		$baca = 'https://simrs.rsausulaiman.com/api/pasien/'.$id;
		$response=file_get_contents($baca);
		$kelas=json_decode($response, true);
		
		$model = new Usg();

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
     * Updates an existing Usg model.
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
     * Deletes an existing Usg model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$model->delete();
        
    }

    /**
     * Finds the Usg model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usg the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usg::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
