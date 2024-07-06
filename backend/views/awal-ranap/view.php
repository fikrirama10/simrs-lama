<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanawalRanap */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaanawal Ranaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaanawal-ranap-view">

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
            'idrawat',
            'anamnesa:ntext',
            'kesadaran:ntext',
            'fisik:ntext',
            'suhu',
            'td',
            'dokterpengirim',
            'respirasi',
            'nadi',
            'diagnosa_awal',
            'diagnosa_akhir',
            'jam_masuk',
            'status',
        ],
    ]) ?>

</div>
