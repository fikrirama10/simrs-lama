<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PaguSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pagu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'jenispagu',
            'kodepagu',
            'nilaipagu',
            'tahun',
            //'iduser',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
