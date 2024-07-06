<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DukkesKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengeluaran Dukkes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dukkes-keluar-index box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dukkes Keluar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'kodetrx',
            'tgl',
            'kegiatan:ntext',
            'keterangan:ntext',
            //'kegiatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
