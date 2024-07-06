<?php

namespace backend\controllers;

use Yii;
use common\models\Rencanaok;
use common\models\Rawatjalan;
use common\models\Oprasi;
use common\models\Tindakandokter;
use common\models\TindakandokterSearch;
use yii\web\Controller;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TindakandokterController implements the CRUD actions for Tindakandokter model.
 */
class OkController extends Controller
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
     * Lists all Tindakandokter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TindakandokterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionRencanaoprasi()
    {
		$rencana = Rencanaok::find()->where(['status'=>1])->orderby(['jadwaloprasi'=>SORT_DESC])->all();
        return $this->render('rencanaoprasi',[
			'rencana'=>$rencana,
		]);
    }
	public function actionOprasi($id)
    {
		$pasien = $this->findPasien($id);
		$oprasi = new Oprasi();
		 if($oprasi->load(Yii::$app->request->post())){
		 
		  $oprasi->tanggal = date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
		   if( $oprasi->save()){return $this->redirect(['/']);} else {return $this->render('view', ['oprasi' => $oprasi,'pasien'=>$pasien]);}
		}

		else {
			 return $this->render('oprasi',[
			'pasien'=>$pasien,
			'oprasi'=>$oprasi,
		]);
		
		}
		
       
    }

    /**
     * Displays a single Tindakandokter model.
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
     * Creates a new Tindakandokter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tindakandokter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tindakandokter model.
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
     * Deletes an existing Tindakandokter model.
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
     * Finds the Tindakandokter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tindakandokter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tindakandokter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	 protected function findPasien($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
