<?php

namespace frontend\controllers;

use Yii;
use common\models\Articles;
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
class ArticlesController extends Controller
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
        $query = Articles::find()->where(['IdCat'=>1]);
		$pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
        ]);
		
		$models = $query->orderBy(['Id' => SORT_DESC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		
		return $this->render('index',[
			'models' => $models,
			'pagination' => $pagination,
		]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
}
