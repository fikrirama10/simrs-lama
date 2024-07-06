<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cucipoli */

$this->title = 'Update Cucipoli: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cucipolis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cucipoli-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
