<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HermatologiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hermatologis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hermatologi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hermatologi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrawat',
            'rm',
            'hb',
            'hbb',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
