<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Radtemplate */

$this->title = 'Update Radtemplate: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Radtemplates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="radtemplate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
