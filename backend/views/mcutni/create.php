<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mcutni */

$this->title = 'Create Mcutni';
$this->params['breadcrumbs'][] = ['label' => 'Mcutnis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" box box-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
