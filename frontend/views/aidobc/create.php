<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Aidobc */

$this->title = 'Create Aidobc';
$this->params['breadcrumbs'][] = ['label' => 'Aidobcs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aidobc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
