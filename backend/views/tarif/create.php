<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tarif */

$this->title = 'Create Tarif';
$this->params['breadcrumbs'][] = ['label' => 'Tarifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarif-create">
	<div class="box box-body">

		<h1><?= Html::encode($this->title) ?></h1>

		<?= $this->render('_form', [
			'model' => $model,
		]) ?>

	</div>
</div>
