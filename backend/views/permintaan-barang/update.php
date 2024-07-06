<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PermintaanBarang */

$this->title = 'Update Permintaan Barang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Permintaan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permintaan-barang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
