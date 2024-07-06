<?php

namespace backend\controllers;

use Yii;
use common\models\TransaksiSearch;
use common\models\AidobcSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AidobcController implements the CRUD actions for Aidobc model.
 */
class YanmasController extends Controller
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
    public function actionIndex()
    {
		$where = ['status'=>1];
		$andWhere = ['idbayar'=>4];
        $searchModel = new TransaksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where,$andWhere);
      
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			
        ]);
    }
	public function actionDetail($start='',$end='')
    {
		$where = ['status'=>1];
		if($start !== '' && $end !== ''){			
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$response=$this->get_content('https://simrs.rsausulaiman.com/apites/kasir-yanmas-m?awal='.$start.'&akhir='.$end);
		}else{
			$start = date('Y-m-d');
			$end = date('Y-m-d');
			$response=$this->get_content('https://simrs.rsausulaiman.com/apites/kasir-yanmas-m?awal='.$start.'&akhir='.$end);
		
		}
	
		$data_json=json_decode($response, true);
		$json = $data_json['response'];
		return $this->render('detail', [
            'json' => $json,			
        ]);
    }
	public function actionGetSearch($start='',$end='')
    {
		$where = ['status'=>1];
		if($start !== '' && $end !== ''){			
			$start = date('Y-m-d', strtotime($start));
			$end = date('Y-m-d', strtotime($end));
			$response=$this->get_content('https://simrs.rsausulaiman.com/apites/kasir-yanmas-m?awal='.$start.'&akhir='.$end);
		}else{
			$start = date('Y-m-d');
			$end = date('Y-m-d');
			$response=$this->get_content('https://simrs.rsausulaiman.com/apites/kasir-yanmas-m?awal='.$start.'&akhir='.$end);
		
		}
	
		$data_json=json_decode($response, true);
		$json = $data_json['response'];
		return $this->renderAjax('search', [
            'json' => $json,			
        ]);
    }
	
	public function get_content($url, $post = '') {
		
		
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
     * Displays a single Aidobc model.
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

    /**
     * Finds the Aidobc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aidobc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aidobc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
