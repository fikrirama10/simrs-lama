<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PemeriksaanIgdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemeriksaan Igds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaan-igd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemeriksaan Igd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kodeperiksa',
            'idrawat',
            'keluhanutama:ntext',
            'rwpenyakit:ntext',
            //'therapi:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
