<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FolmulirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Folmulirs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folmulir-index box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Folmulir', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'jenisform',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
