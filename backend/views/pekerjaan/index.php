<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PekerjaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pekerjaans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerjaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pekerjaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'jenis_pekerjaan',
            'tempatkerja:ntext',
            'alamat_kerja:ntext',
            'notlp',
            // 'idpasien',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
