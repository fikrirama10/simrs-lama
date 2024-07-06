<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RencanaokSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rencanaoks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rencanaok-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rencanaok', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_rekmed',
            'tanggalperiksa',
            'jadwaloprasi',
            'diagnosa',
            //'status',
            //'iddokrer',
            //'idrawat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
