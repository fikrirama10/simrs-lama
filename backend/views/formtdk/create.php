<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Formtdk */

$this->title = 'Create Formtdk';
$this->params['breadcrumbs'][] = ['label' => 'Formtdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formtdk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
