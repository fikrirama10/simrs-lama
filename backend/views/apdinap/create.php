<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Apdinap */

$this->title = 'Create Apdinap';
$this->params['breadcrumbs'][] = ['label' => 'Apdinaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apdinap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
