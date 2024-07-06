<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\IndikatorigdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Indikatorigds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indikatorigd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Indikatorigd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'namapetugas',
            'jab',
            'bls',
            'blsterbit',
            //'blshabis',
            //'ppgd',
            //'ppgdterbit',
            //'ppgdhabis',
            //'gels',
            //'gelsterbit',
            //'gelshabis',
            //'als',
            //'alsterbit',
            //'alshabis',
            //'ket',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
