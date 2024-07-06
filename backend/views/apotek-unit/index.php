<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ApotekUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengeluaran Obat Untuk Unit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apotek-unit-index">
	<div class="box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Apotek Unit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idtrx',
            'unit',
            'tanggal',
            'nama',
            //'iduser',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	</div>
</div>
