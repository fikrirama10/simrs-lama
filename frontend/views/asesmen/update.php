<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Dokter */

$this->title = 'Update Pemeriksaan Pasien: ' .$model->pasien->sbb.". ". $model->pasien->nama_pasien;
$this->params['breadcrumbs'][] = ['label' => 'Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dokter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'keluhan' => $keluhan,
        'rxfisik' => $rxfisik,
    ]) ?>

</div>
