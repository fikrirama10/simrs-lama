<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatan */

$this->title = 'Update Masalah Keperawatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Masalah Keperawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="masalah-keperawatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
