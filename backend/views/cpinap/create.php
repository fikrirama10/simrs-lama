<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cpinap */

$this->title = 'Create Cpinap';
$this->params['breadcrumbs'][] = ['label' => 'Cpinaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpinap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
