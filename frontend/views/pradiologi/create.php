<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pradiologi */

$this->title = 'Create Pradiologi';
$this->params['breadcrumbs'][] = ['label' => 'Pradiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pradiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
