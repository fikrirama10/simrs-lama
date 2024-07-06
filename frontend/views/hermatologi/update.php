<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hermatologi */

$this->title = 'Update Hermatologi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hermatologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hermatologi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
