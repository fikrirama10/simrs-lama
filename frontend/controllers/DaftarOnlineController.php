<?php

namespace frontend\controllers;

use Yii;
use common\models\Articles;
use common\models\Daftaronline;
use common\models\Pasienonline;
use common\models\Poli;
use common\models\Pasien;
use common\models\DokumenJenis;
use common\models\DokumenKategori;
use common\models\ArticlesSearch;
use common\models\StaticContent;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;
/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class DaftarOnlineController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    
    public function actionIndex()
    {
       
		return $this->render('index');
    }

	 public function actionCreatebaru()
    {
       	$pasien = new Pasienonline();
        return $this->render('createbaru', [
            'pasien' => $pasien,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view',[
            'model' => $this->findModel($id),
        ]);
    }
	public function actionBerhasil($id)
    {
		$model = $this->findOnline($id);
        return $this->render('berhasil',[
            'model' => $model,
        ]);
    }
	 public function actionDaftar()
    {
		$pasien = new Pasienonline();
        return $this->render('daftar', [
          //  'model' => $this->findPoli($id),
            'pasien' => $pasien,
        ]);
    }
	public function actionPencarian($norm,$tgllahir)
    {
        
		$query = Pasien::find()->where(['no_rekmed'=>$norm])->andwhere(['tanggal_lahir'=>$tgllahir])->one();
		$online = new Pasienonline();

         if ($online->load(Yii::$app->request->post()) )
		  {
			
			$online->tanggal = date('Y-m-d G:i:s',strtotime('+5 hour',strtotime(date('Y-m-d G:i:s'))));
			if($online->save()){
			  
				 return $this->redirect(['/daftar-online/succ/?id='.$online->id]);
			}
			else
			{	
				return $this->render('pencarian',[
					'query'=>$query,
					'online'=>$online,
				]);
			}
			
		   
		} else {
			return $this->render('pencarian',[
			'query'=>$query,
			'online'=>$online,
		]);
		
		}

		
    }

	
    protected function findModel($id)
    {
        if (($model = Daftaronline::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findOnline($id)
    {
        if (($model = Pasienonline::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	    protected function findPoli($id)
    {
        if (($model = Poli::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	
}
