<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Dafusg */

$this->title = 'Create Dafusg';
$this->params['breadcrumbs'][] = ['label' => 'Dafusgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dafusg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
