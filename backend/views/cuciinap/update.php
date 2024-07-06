<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cuciinap */

$this->title = 'Update Cuciinap: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cuciinaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuciinap-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
