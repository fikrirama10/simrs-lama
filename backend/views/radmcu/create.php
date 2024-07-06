<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Radmcu */

$this->title = 'Create Radmcu';
$this->params['breadcrumbs'][] = ['label' => 'Radmcus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radmcu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
