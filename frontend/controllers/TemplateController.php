<?php

namespace frontend\controllers;

use Yii;
use common\models\Template;
use common\models\TemmplateSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TemplateController implements the CRUD actions for Template model.
 */
class TemplateController extends Controller
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
     * Lists all Template models.
     * @return mixed
     */
    // public function actionIndex()
    // {
        // $searchModel = new TemmplateSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        // ]);
    // }

    /**
     * Displays a single Template model.
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
     * Creates a new Template model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
      
        // $model = new Template();

        // if ($model->load(Yii::$app->request->post())) {
			// $model->Created = date('Y-m-d H:i:s');
			// $model->SEO=Yii::$app->algo->genSEO($model->Nama);
			// $image=UploadedFile::getInstance($model,'Gambar');
			
			// if (!$image == null) {
				// $model->Gambar=$image->name;
				// $path = Yii::$app->params['imageProductPath'] .'/template/'.$model->Gambar; 
				// $image->saveAs($path);
			// }
			// else{
				// $model->Gambar = 'dummy.png';
			// }
			// if($model->save()){
            // return $this->redirect(['view', 'id' => $model->Id]);
			// }else{
				// echo"gagal";
			// }
        // } else {
            // return $this->render('create', [
                // 'model' => $model,
            // ]);
        // }
    
    // }

    /**
     * Updates an existing Template model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
        // $model = $this->findModel($id);
 // if ($model->load(Yii::$app->request->post())) {
			// $model->Created = date('Y-m-d H:i:s');
			// $model->SEO=Yii::$app->algo->genSEO($model->Nama);
			// $image=UploadedFile::getInstance($model,'Gambar');
			
			// if (!$image == null) {
				// $model->Gambar=$image->name;
				// $path = Yii::$app->params['imageProductPath'] .'/template/'.$model->Gambar; 
				// $image->saveAs($path);
			// }
			// else{
				// $model->Gambar = 'dummy.png';
			// }
			// if($model->save()){
            // return $this->redirect(['view', 'id' => $model->Id]);
			// }else{
				// echo"gagal";
			// }
        // } else {
            // return $this->render('create', [
                // 'model' => $model,
            // ]);
        // }
    
    // }

    // /**
     // * Deletes an existing Template model.
     // * If deletion is successful, the browser will be redirected to the 'index' page.
     // * @param integer $id
     // * @return mixed
     // */
    // public function actionDelete($id)
    // {
        // $this->findModel($id)->delete();

        // return $this->redirect(['index']);
    // }

    /**
     * Finds the Template model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Template the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Template::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
