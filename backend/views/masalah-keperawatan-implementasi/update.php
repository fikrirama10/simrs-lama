<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatanImplementasi */

$this->title = 'Update Masalah Keperawatan Implementasi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Masalah Keperawatan Implementasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="masalah-keperawatan-implementasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
