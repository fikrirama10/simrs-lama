<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TargetPenerimaan */

$this->title = 'Create Target Penerimaan';
$this->params['breadcrumbs'][] = ['label' => 'Target Penerimaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-penerimaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
