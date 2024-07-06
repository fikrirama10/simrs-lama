<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Prosm */

$this->title = 'Create Prosm';
$this->params['breadcrumbs'][] = ['label' => 'Prosms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prosm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
