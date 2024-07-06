<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Lab */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idpengirim',
            'idjenisp',
            'no_rekmed',
            'hasil:ntext',
            'idrawat',
            'idpemeriksa',
            'tanggal_req',
            'tgl_peniksa',
            'status',
        ],
    ]) ?>

</div>
