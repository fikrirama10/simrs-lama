<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RadmcuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Radmcus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radmcu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Radmcu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrad',
            'tanggal',
            'usia',
            'rmmcu',
            //'nama',
            //'alamat:ntext',
            //'dokter',
            //'kesan:ntext',
            //'klinis:ntext',
            //'hasil:ntext',
            //'nofoto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
