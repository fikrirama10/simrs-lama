<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */

$this->title = 'Update Pengaduan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengaduans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengaduan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
