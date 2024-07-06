<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsgdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usgdetails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usgdetail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usgdetail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idusg',
            'idpemeriksaan',
            'klinis:ntext',
            'hasil:ntext',
            //'tgl',
            //'nousg',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
