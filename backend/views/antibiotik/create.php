<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Antibiotik */

$this->title = 'Create Antibiotik';
$this->params['breadcrumbs'][] = ['label' => 'Antibiotiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="antibiotik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
