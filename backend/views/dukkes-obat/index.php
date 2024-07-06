<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DukkesObatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Obat Dukkes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dukkes-obat-index box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Obat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kodeobat',
            'namaobat',
            'stok',
			'satuan.satuan',
            'kadaluarsa',
            'jenisobat',
            
            //'idsatuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
