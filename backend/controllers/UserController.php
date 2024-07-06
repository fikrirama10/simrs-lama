<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use kartik\mpdf\Pdf;
use common\models\Petugas;
use common\models\UserSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->identity->idpriv == 1 || Yii::$app->user->identity->idpriv == 22){
			$searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->where('statas = "Petugas"');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
				
		}else{
        return $this->redirect(['/']);
		}
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionDokteruser()
    {
		
        $model = new User();
	
        if ($model->load(Yii::$app->request->post())) {
			
			// if ($model->validate()) {
							
				//$model->LastIP=$_SERVER['SERVER_ADDR'];
				$model->setPassword($model->password);
				$model->generateAuthKey();
				$model->statas = "Dokter";
				if($model->save(false)){
					
					return $this->redirect(['index']);
				} else {
					return $this->render('dokteruser', ['model' => $model,]);
				}
							
        } else {
			return $this->render('dokteruser', ['model' => $model,]);
		}
    }
    public function actionCreate()
    {
		if(Yii::$app->user->identity->priviledges->idpriv < 22){
				return $this->redirect(['index']);
		}else{
		
        $model = new User();
		$petugas = new Petugas();
		
        if ($model->load(Yii::$app->request->post()) 
			&& $petugas->load(Yii::$app->request->post())
			&& Model::validateMultiple([$petugas])) {
			
			// if ($model->validate()) {
								
				$petugas->genKodeu();
				$model->kode_petugas=$petugas->kode_petugas;
				//$model->LastIP=$_SERVER['SERVER_ADDR'];
				$model->setPassword($model->password);
				$model->generateAuthKey();
				$model->statas = "Petugas";
				if($petugas->save()){
					$model->save(false);
					return $this->redirect(['index']);
				} else {
					return $this->render('create', ['model' => $model,'petugas' => $petugas,]);
				}
							
        } else {
			return $this->render('create', ['model' => $model,'petugas' => $petugas,]);
			}
			}
    }
	public function actionGantipass()
    {
		$model = $this->findModel(Yii::$app->user->identity->id);
		
        if ($model->load(Yii::$app->request->post())) {
			$current = Yii::$app->request->post('current-password');
			$old = Yii::$app->request->post('old-password');
			if($current !== $old){
				\Yii::$app->getSession()->setFlash('danger', 'Password lama yang Anda masukan salah');
				return $this->redirect(['gantipass']);
			}else{
				$model->updated_at=strtotime(date('Y-m-d h:i:s'));
				//$model->LastIP=$_SERVER['SERVER_ADDR'];
				$model->setPassword($model->password);
				// $model->generateAuthKey();
				
				if($model->save(false)){
					\Yii::$app->getSession()->setFlash('success', 'Password Anda berhasil diganti');
					return $this->redirect(['gantipass']);
				}
			}
		}else{
			return $this->render('gantipass', [
				'model' => $model,
			]);
		}
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionReport()
	{
		
		$dataProvider = User::find()->all();
       
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
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
           'orientation' => Pdf::ORIENT_PORTRAIT,
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
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
