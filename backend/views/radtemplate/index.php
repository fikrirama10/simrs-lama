<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RadtemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Radtemplates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radtemplate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Radtemplate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kesan:ntext',
            'keterangan:ntext',
            'hasil:ntext',
            'klinis:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
