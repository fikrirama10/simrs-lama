<?php

namespace backend\controllers;

use Yii;
use common\models\Lab;
use common\models\Subkattindakanlab;
use common\models\Kattindakanlab;
//use app\models\Model;
use yii\base\Model;
//use app\base\Model;
use common\models\Pemriklab;
use common\models\LabSearch;
use common\models\RawatjalanSearch;
use common\models\PemriklabSearch;
use common\models\Rawatjalan;
use common\models\Idlab;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * LabController implements the CRUD actions for Lab model.
 */
class LabController extends Controller
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
     * Lists all Lab models.
     * @return mixed
     */
    public function actionIndex()
    {
		
        $searchModel = new LabSearch();
		$where = ['status'=>0] ;
		$groupBy = ['idrawat'] ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionDetaillab($id)
    {

        $model=  $this->findRj($id);
        $searchModel = new PemriklabSearch();
        $where = ['idrawat'=> $model->idrawat] ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);

        return $this->render('detaillab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
        public function actionOrderlab()
    {
        
        $searchModel = new RawatjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('orderlab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	   
	   public function actionListlab()
    {
		
        $searchModel = new LabSearch();
		$where = ['status'=>0] ;
		$groupBy = ['idrawat'] ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listlab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lab model.
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
     * Creates a new Lab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $rj = $this->findRj($id);
        $model = new Lab();
        if ($model->load(Yii::$app->request->post())) {
            $model->tanggal_req =  date('Y-m-d G:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s'))));
            if($model->save()){
              
                 return $this->redirect(['lab/create/'.$id]);
            }
            else
            {   
                return $this->render('create', ['model' => $model,'rj' => $rj,]);
            }
            
           
        } else {
            return $this->render('create', ['model' => $model,'rj' =>$rj,]);
        
        }
        

        return $this->render('create', [
            'model' => $model,
            'rj' => $rj,
        ]);
    }

    /**
     * Updates an existing Lab model.
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
	    public function actionPemriklab($id)
    {

        $labid = new Idlab;
        $model = $this->findModel($id);
        $pemriklab = [new Pemriklab];


        if ($labid->load(Yii::$app->request->post())) {


            $pemriklab = Model::createMultiple(Pemriklab::classname());

            Model::loadMultiple($pemriklab, Yii::$app->request->post());


            // validate all models

            $valid = $labid->validate();

            $valid = Model::validateMultiple($pemriklab) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();


                try {

                    if ($flag = $labid->save(false)) {

                        foreach ($pemriklab as $pemriklab) {

                            $pemriklab->labid = $labid->id;
                            $pemriklab->idrawat = $labid->idrawat;
                            $pemriklab->rm = $labid->rm;
                            $pemriklab->idtindakan = $model->idkatjenisp;
                            $pemriklab->idjenisp = $model->idjenisp;
                            $pemriklab->idlab = $model->id;

                            if (! ($flag = $pemriklab->save(false))) {

                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                        return $this->redirect(['pemriklab', 'id' => $model->id]);

                    }

                } catch (Exception $e) {

                    $transaction->rollBack();

                }

            }

        }


        return $this->render('pemriklab', [

            'labid' => $labid,
            'model'=>$model,
            'pemriklab' => (empty($pemriklab)) ? [new Pemriklab] : $pemriklab

        ]);

    }
    
    
	public function actionSubtindakan($id)
	  {
		$models=Subkattindakanlab::find()->where(['idkat' => $id])->orderBy('nama')->all();
		echo"<option value='0'>- Pilih -</option>";
		foreach($models as $k){
		  echo "<option value='".$k->id."'>".$k->nama."</option>";
		}
	  }

    /**
     * Deletes an existing Lab model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	 public function actionBeres($id)
    {

        $model = $this->findModel($id);
         if($model->status == 1){
          return $this->redirect(['rawatjalan/periksalab/'.$model->rawatja->id]);   
        }else{
		$model->tgl_peniksa = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
		$model->idpemeriksa = Yii::$app->user->identity->id ;
		$model->status = 1;
		$model->save();
        return $this->redirect(['rawatjalan/periksalab/'.$model->rawatja->id]);
        }
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
     public function actionLablist($id)
      {
        $models=Kattindakanlab  ::find()->where(['kat' => $id])->orderBy('nama')->all();
        echo"<option value='0'>- Pilih -</option>";
        foreach($models as $k){
          echo "<option value='".$k->id."'>".$k->nama."</option>";
        }
      }
        public function actionPrintlab($id) {
      //tampilkan bukti proses
      $pemriklab = Lab::find()->where(['id' => $id])->one();
      if($pemriklab->katlab->jenis == 1){
         $content = $this->renderPartial('formlab',['pemriklab' => $pemriklab,]);
      }else if($pemriklab->katlab->jenis == 2){
         $content = $this->renderPartial('formlab2',['pemriklab' => $pemriklab,]);
      }else if($pemriklab->katlab->jenis == 3){
         $content = $this->renderPartial('formlab3',['pemriklab' => $pemriklab,]);
      }
      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
       'mode' => Pdf::MODE_CORE,
       'destination' => Pdf::DEST_BROWSER,
       'format' =>  [148.5,210], 
       'marginBottom'=>'0mm',
       'content' => $content,  
       'cssFile' => '@frontend/web/css/paper.css',
       'methods' => [ 
            'SetFooter'=>['RSAU LANUD SULAIMAN ,'.$pemriklab->tanggal_req],
        ]
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
     * Finds the Lab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findRj($id)
    {
        if (($model = Rawatjalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
