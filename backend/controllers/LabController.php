<?php

namespace backend\controllers;

use Yii;
use common\models\Lab;
use common\models\Orderlab;
use common\models\Daflab;
use common\models\Subkattindakanlab;
use common\models\Kattindakanlab;
//use app\models\Model;
use yii\base\Model;
//use app\base\Model;
use common\models\Pemriklab;
use common\models\LabSearch;
use common\models\OrderlabSearch;
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
		
        $searchModel = new OrderlabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
      // $where = ['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', date('Y-m-d',strtotime('-3 days ',strtotime(date('Y-m-d')))), date('Y-m-d')];
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

	public function actionLab($id)
    {

        $labid = new Orderlab;
        $model = $this->findRj($id);
        $pemriklab = [new Lab];


        if ($labid->load(Yii::$app->request->post())) {


            $pemriklab = Model::createMultiple(Lab::classname());

            Model::loadMultiple($pemriklab, Yii::$app->request->post());


            // validate all models

            $valid = $labid->validate();

            $valid = Model::validateMultiple($pemriklab) && $valid;


            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
				$labid->tgl_order = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
				$labid->idtkp = $model->idjenisrawat;

                try {

                    if ($flag = $labid->save(false)) {

                        foreach ($pemriklab as $pemriklab) {
							
							$pemriklab->tanggal_req = $labid->tgl_order;
							$pemriklab->kodelab = $labid->kodelab;
                            $labid->no_rekmed = $model->no_rekmed;
                            
							
                            if (! ($flag = $pemriklab->save(false))) {
								
                                $transaction->rollBack();

                                break;

                            }

                        }

                    }


                    if ($flag) {

                        $transaction->commit();

                       return $this->redirect(['/orderlab/'.$labid->id]);

                    }

                } catch (Exception $e) {

                    $transaction->rollBack();

                }

            }

        }


        return $this->render('create', [

            'labid' => $labid,
            'model'=>$model,
            'pemriklab' => (empty($pemriklab)) ? [new Lab] : $pemriklab

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
	 public function actionEditlab($id){
        $model = $this->findLab($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['pemriklab', 'id' => $model->labid]);
        }

        return $this->render('editlab', [
            'model' => $model,
        ]);
    }
	 public function actionPemriklabub($id)
    {
        $model = $this->findModel($id);

		$model->idjenisp = $model->katlab->kat0->id;
		if($model->save(false)){
			 return $this->redirect(['pemriklab', 'id' => $model->id]);
		}

   
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
        $this->findOl($id)->delete();

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
	  
	public function actionPemriklab($id)
    {
		$model = $this->findModel($id);
		$order = Orderlab::find()->where(['kodelab'=>$model->kodelab])->one();
        $aNilai=[];
        foreach (Subkattindakanlab::find()->where(['idkat' => $model->idkatjenisp])->andwhere(['status'=>1])->all() as $siswa) {
            $nilai = new Pemriklab([
                'idkatindakan'=>$siswa->id,
                'nama'=>$siswa->nama,
                'satuan'=>$siswa->satuan,
                'rujukan'=>$siswa->l,
            ]);
            $aNilai[$siswa->id] = $nilai;
        }

        if(Pemriklab::loadMultiple($aNilai,  Yii::$app->request->post()) && Pemriklab::validateMultiple($aNilai)){
            foreach ($aNilai as $nilai) {
				$nilai->labid = $model->id;
				$nilai->kodelab = $model->kodelab;
				//$nilai->no_ = $model->id;
                 $nilai->save(false);
            }
			$model->idpemeriksa = Yii::$app->user->identity->id ;
			$model->status = 1 ;
			$model->tgl_peniksa = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			$model->save(false);
                 return $this->redirect(['lab/pemriklab/'.$model->id]);
        }
        return $this->render('pemriklab',[
            'aNilai'=>$aNilai,
            'model'=>$model,
                   ]);

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
       'marginTop'=>'5mm',
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
	  protected function findLab($id)
    {
        if (($model = Pemriklab::findOne($id)) !== null) {
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
	protected function findOl($id)
    {
        if (($model = Orderlab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
