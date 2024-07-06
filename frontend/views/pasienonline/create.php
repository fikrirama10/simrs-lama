<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pasienonline */

$this->title = 'Create Pasienonline';
$this->params['breadcrumbs'][] = ['label' => 'Pasienonlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasienonline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
