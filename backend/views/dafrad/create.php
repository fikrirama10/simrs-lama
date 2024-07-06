<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Dafrad */

$this->title = 'Create Dafrad';
$this->params['breadcrumbs'][] = ['label' => 'Dafrads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dafrad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
