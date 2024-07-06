<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Radtemplate */

$this->title = 'Create Radtemplate';
$this->params['breadcrumbs'][] = ['label' => 'Radtemplates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radtemplate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
