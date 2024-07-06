<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Apd */

$this->title = 'Create Apd';
$this->params['breadcrumbs'][] = ['label' => 'Apds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
