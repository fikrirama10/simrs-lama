<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PengaduanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengaduans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengaduan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengaduan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nomer',
            'nama',
            'email:email',
            'nohp',
            //'pengaduan:ntext',
            //'tgl',
            //'idjenispengaduan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
