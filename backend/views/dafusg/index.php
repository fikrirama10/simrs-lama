<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DafusgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dafusgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dafusg-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dafusg', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'namausg',
            'tarif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
