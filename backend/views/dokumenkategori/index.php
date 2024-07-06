<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DokumenKategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dokumen Kategoris';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-kategori-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dokumen Kategori', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Kategori',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
