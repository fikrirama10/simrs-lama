<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PemeriksaanawalRanapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemeriksaanawal Ranaps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaanawal-ranap-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemeriksaanawal Ranap', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrawat',
            'anamnesa:ntext',
            'kesadaran:ntext',
            'fisik:ntext',
            //'suhu',
            //'td',
            //'dokterpengirim',
            //'respirasi',
            //'nadi',
            //'diagnosa_awal',
            //'diagnosa_akhir',
            //'jam_masuk',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
