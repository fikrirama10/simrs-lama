<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Orderlab */

$this->title = 'Update Orderlab: ' . $model->pasien->nama_pasien;
$this->params['breadcrumbs'][] = ['label' => 'Orderlabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pasien->nama_pasien, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orderlab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
