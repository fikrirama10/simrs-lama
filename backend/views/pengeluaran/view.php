<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pengeluaran */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengeluarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengeluaran-view box box-body">

    

    <p>
        <?= Html::a('Selesai', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Print', ['print', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'trxid',
            'nama',
            'jabatan',
            'keterangan:ntext',
            'tanggal',
            'biaya',
            
        ],
    ]) ?>

</div>
