<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Antibiotik */

$this->title = 'Update Antibiotik: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Antibiotiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="antibiotik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
