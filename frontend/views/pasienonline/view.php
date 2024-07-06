<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pasienonline */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pasienonlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasienonline-view">

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
            'nokartu',
            'idbayar',
            'noregistrasi',
            'tanggal',
            'idpoli',
            'nama_pasien',
            'alamat:ntext',
            'nohp',
            'tgl_lahir',
            'usia',
            'idprov',
            'idkab',
            'idkec',
            'idkel',
            'pendidikan',
            'no_ktp',
        ],
    ]) ?>

</div>
