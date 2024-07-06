<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MasalahKeperawatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Masalah Keperawatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="masalah-keperawatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Masalah Keperawatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrawat',
            'no_rekmed',
            'tgl',
            'user',
            //'idkategori',
            //'idsub',
            //'iddiagnosis',
            //'idtindakan',
            //'tindakan:ntext',
            //'keterangan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
