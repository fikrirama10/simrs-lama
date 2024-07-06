<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cp */

$this->title = 'Create Cp';
$this->params['breadcrumbs'][] = ['label' => 'Cps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
