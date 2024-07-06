<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DukkesMasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dukkes Masuks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dukkes-masuk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dukkes Masuk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idsuplier',
            'tgl',
            'iduser',
            'keterangan:ntext',
            //'kodetrx',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
