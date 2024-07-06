<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TindakandokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tindakandokters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tindakandokter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tindakandokter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_rawat',
            'idtindakan',
            'tarif',
            'penindak',
            //'ditindakoleh',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
