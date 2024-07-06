<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MasalahKeperawatanImplementasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Masalah Keperawatan Implementasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="masalah-keperawatan-implementasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Masalah Keperawatan Implementasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrawat',
            'iduser',
            'jam',
            'tanggal',
            //'idimplementasi',
            //'implementasi:ntext',
            //'keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
