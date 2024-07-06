<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TbSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tb', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_rm',
            'nama',
            'usia',
            'tgl_lahir',
            //'berat_badan',
            //'tinggi_badan',
            //'ktp',
            //'bpjs',
            //'no_hp',
            //'jenis_pasien',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
