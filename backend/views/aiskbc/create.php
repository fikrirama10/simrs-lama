<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Aiskbc */

$this->title = 'Create Aiskbc';
$this->params['breadcrumbs'][] = ['label' => 'Aiskbcs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aiskbc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
