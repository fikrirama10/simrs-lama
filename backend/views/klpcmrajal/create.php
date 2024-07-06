<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Klpcm */

$this->title = 'Create Klpcm';
$this->params['breadcrumbs'][] = ['label' => 'Klpcms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="klpcm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataTemplate' => $dataTemplate,
    ]) ?>

</div>
