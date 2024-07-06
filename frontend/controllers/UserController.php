<?php

namespace backend\controllers;

use Yii;
use common\models\User;
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
		if(Yii::$app->user->identity->priviledges->idpriv >= 2){
				return $this->redirect(['/']);
		}else{
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->where('statas = "Petugas"');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
		if(Yii::$app->user->identity->priviledges->idpriv >= 2){
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
