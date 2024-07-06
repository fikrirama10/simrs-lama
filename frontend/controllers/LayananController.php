<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Produk;
use yii\filters\AccessControl;


class LayananController extends Controller
{
	
	 
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
	
	  public function actionView($key)
    {
        
		$model=Produk::find()->where(['SEO' => $key ])->one();
		return $this->render('view', [
           'model' => $model,
        ]);
		
	}
	 protected function findModel($id)
    {
        if (($model = Produk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
}
?>

