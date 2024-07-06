<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Transferpasien */

$this->title = 'Create Transferpasien';
$this->params['breadcrumbs'][] = ['label' => 'Transferpasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferpasien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
