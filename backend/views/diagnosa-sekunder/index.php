<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PemeriksaanUgddiagsekunderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemeriksaan Ugddiagsekunders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaan-ugddiagsekunder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemeriksaan Ugddiagsekunder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idpemeriksaan',
            'idrawat',
            'diagnosaprimer',
            'diagnosasekunder',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
