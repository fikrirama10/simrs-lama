<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PemeriksaanRanapVisiteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemeriksaan Ranap Visites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaan-ranap-visite-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemeriksaan Ranap Visite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrawat',
            'iddokter',
            'pemeriksaan_dokter:ntext',
            'tanggal',
            //'catatan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
