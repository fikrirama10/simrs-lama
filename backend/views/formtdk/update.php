<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Formtdk */

$this->title = 'Update Formtdk: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Formtdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="formtdk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
