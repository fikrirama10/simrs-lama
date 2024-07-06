<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Usgdetail */

$this->title = 'Create Usgdetail';
$this->params['breadcrumbs'][] = ['label' => 'Usgdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usgdetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usg' => $usg,
        'dataTemplate' => $dataTemplate,
    ]) ?>

</div>
