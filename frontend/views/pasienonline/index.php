<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PasienonlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pasienonlines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasienonline-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pasienonline', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nokartu',
            'idbayar',
            'noregistrasi',
            'tanggal',
            //'idpoli',
            //'nama_pasien',
            //'alamat:ntext',
            //'nohp',
            //'tgl_lahir',
            //'usia',
            //'idprov',
            //'idkab',
            //'idkec',
            //'idkel',
            //'pendidikan',
            //'no_ktp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
