<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\IndirawatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Indirawats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indirawat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Indirawat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_rekmed',
            'diagnosa',
            'dpjptcp',
            'pkmcp',
            //'tanggal',
            //'verived',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
