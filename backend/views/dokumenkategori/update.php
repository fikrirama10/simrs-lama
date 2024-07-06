<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DokumenKategori */

$this->title = 'Update Dokumen Kategori: ' . ' ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dokumen-kategori-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
