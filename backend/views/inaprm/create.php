<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Inaprm */

$this->title = 'Create Inaprm';
$this->params['breadcrumbs'][] = ['label' => 'Inaprms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inaprm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
