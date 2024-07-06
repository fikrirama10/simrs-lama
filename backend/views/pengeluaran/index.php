<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PengeluaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengeluarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengeluaran-index box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengeluaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'trxid',
            'nama',
            'jabatan',
            'keterangan:ntext',
            'tanggal',
            'biaya',
            //'casier',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
