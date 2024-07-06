<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tb */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-view">

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
            'no_rm',
            'nama',
            'usia',
            'tgl_lahir',
            'berat_badan',
            'tinggi_badan',
            'ktp',
            'bpjs',
            'no_hp',
            'jenis_pasien',
        ],
    ]) ?>

</div>
