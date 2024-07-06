<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TindakanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tindakans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tindakan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tindakan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idpoli',
            'namatindakan',
            'kattindakan',
            'tarif',
            //'ket',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
