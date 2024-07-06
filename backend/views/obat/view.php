<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Obat */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Obats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obat-view">

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
            'noobat',
            'namaobat',
            'kadaluarsa',
            'idsuplier',
            'harga',
            'idsatuan',
            'idjenisobat',
            'stok',
        ],
    ]) ?>

</div>
