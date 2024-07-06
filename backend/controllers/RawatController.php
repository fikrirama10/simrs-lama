<?php

namespace backend\controllers;

use Yii;
use common\models\Rawat;
use common\models\Kamar;
use yii\base\Model;
use common\models\RawatSearch;
use yii\web\Controller;
use common\models\Rawatjalan;
use common\models\Lograwat;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RawatController implements the CRUD actions for Rawat model.
 */
class RawatController extends Controller
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
     * Lists all Rawat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RawatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->where(['status' => 'Pending']);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rawat model.
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
     * Creates a new Rawat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionRawatinap($id)
    {
		$model = $this->findModel($id);
		$rawatinap = new Rawatjalan();
		$lograwat = new Lograwat();
		
		
		if ($rawatinap->load(Yii::$app->request->post()) 
			
			&& Model::validateMultiple([$rawatinap])) {
			$rawatinap->idverifed = Yii::$app->user->identity->id ;
			$rawatinap->tgldaftar = $model->waktudikirim;
			//$rawatinap->tglmasuk = $model->waktudikirim;
			$rawatinap->status = 8 ;
			$rawatinap->idjenisrawat = 2 ;
			$lograwat->idrawat = $rawatinap->idrawat;
			//$lograwat->jenis = $rawatinap->polii->namapoli;
			// $lograwat->waktu = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			// $lograwat->kelas = $model->idruangan;
			$model->status = 'Rawat' ;
		
			if($rawatinap->save(false)){
			$model->save();  
			$lograwat->save();  
				  return $this->redirect(['/rawatjalan/isikamar/'.$rawatinap->id]);
			}
			else
			{	
				return $this->render('rawatinap', ['rawatinap' => $rawatinap,'model' => $this->findModel($id),]);
			}
			
		   
		} else {
			return $this->render('rawatinap', ['rawatinap' => $rawatinap,'model' => $this->findModel($id),]);
		
		}
		
        return $this->render('rawatinap', [
            'model' => $this->findModel($id),
            'rawatinap' => $rawatinap,
        ]);
    }
	public function actionIsikamar($id)
    {
        $model = $this->findModel($id);
		$kamar = Kamar::find()->where(['id' => $model->idruangan])->one();
		$kamar->masuk =+ 1;
		//$kamar->status = 0;
		$kamar->save();
		
        return $this->redirect(['rawatjalan/previewpasien/'.$model->id]);
    }
    public function actionCreate()
    {
        $model = new Rawat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rawat model.
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
     * Deletes an existing Rawat model.
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
     * Finds the Rawat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rawat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rawat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
