<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JadwaldokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwaldokters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwaldokter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jadwaldokter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'hari.nama_hari',
            'dokter.namadokter',
            'mulaijam',
            'selesaijam',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
