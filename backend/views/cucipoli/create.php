<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cucipoli */

$this->title = 'Create Cucipoli';
$this->params['breadcrumbs'][] = ['label' => 'Cucipolis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cucipoli-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
