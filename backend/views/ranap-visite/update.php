<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanRanapVisite */

$this->title = 'Update Pemeriksaan Ranap Visite: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan Ranap Visites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pemeriksaan-ranap-visite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
