<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DafradSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dafrads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dafrad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dafrad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'jenispemeriksaan',
            'tarif',
            'ket',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
