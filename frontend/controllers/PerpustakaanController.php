<?php

namespace frontend\controllers;

use Yii;
use common\models\Articles;
use common\models\Dokumen;
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
class PerpustakaanController extends Controller
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
		$query = Dokumen::find();
		$pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $query->count(),
        ]);
		$dok = $query->orderBy(['Id' => SORT_DESC])
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();

       
		 return $this->render('index', [
            'pagination' => $pagination,
			'query' => $query,
			'dok' => $dok,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	 public function actionDokumen($id)
    {
        return $this->render('dokumen', [
            'model' => $this->findDokumen($id),
        ]);
    }
	 public function actionDoc($id)
    {
		$model= $this->findDoc($id);
		$query = Dokumen::find()->where(['IdJenis'=>$model->Id]);
		$pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count(),
        ]);
		
		$models = $query->orderBy(['Id' => SORT_DESC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
	
        return $this->render('doc', [
            'models' => $models,
			'pagination' => $pagination,
        ]);
    }
	
	public function actionPencarian($keyword)
    {
        
		$query = Dokumen::find()->where(['like','Judul',$keyword]);
		$pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
		
		$docs = $query->orderBy(['Id' => SORT_DESC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
		return $this->render('pencarian',[
			'docs' => $docs,
			'pagination' => $pagination,
		]);
		
    }
	
	public function actionRead($key)
    {
        $model=Articles::find()->where(['SEO' => $key])->one();
		return $this->render('read', [
            'model' => $model,
        ]);
    }
	/*
	public function actionProfil($key)
    {
        
		$model=Articles::find()->where(['SEO' => $key,'IdPub' => 2])->one();
		return $this->render('profil', [
           'model' => $model,
        ]);
		
    }
	*/
	public function actionProfil($key)
    {
        
		$model=Articles::find()->where(['SEO' => $key])->one();
		return $this->render('profil', [
           'model' => $model,
        ]);
		
    }
		
		
	public function actionStruktur($key)
	
	{
		return $this->render('struktur',['model' => $model,]
        );
    }
	
    protected function findModel($id)
    {
        if (($model = DokumenKategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	 protected function findDokumen($id)
    {
        if (($model = Dokumen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findDoc($id)
    {
        if (($model = DokumenJenis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
}
