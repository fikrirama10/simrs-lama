<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PemeriksaanRajalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemeriksaan Rajals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaan-rajal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemeriksaan Rajal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrawat',
            'idpoli',
            'iddokter',
            'suhu',
            //'respirasi',
            //'nadi',
            //'td',
            //'diagnosa:ntext',
            //'tanggal',
            //'tindakan:ntext',
            //'obat:ntext',
            //'lab:ntext',
            //'radiologi:ntext',
            //'pemeriksaan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
