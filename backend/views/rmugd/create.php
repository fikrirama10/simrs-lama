<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Rmugd */

$this->title = 'Create Rmugd';
$this->params['breadcrumbs'][] = ['label' => 'Rmugds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rmugd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
