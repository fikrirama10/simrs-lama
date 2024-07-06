<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Ganti Password';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Ganti Password';
?>
<div class="user-update">

	<div class='row'>
		<div class='col-sm-4'>
			<div class='panel panel-default'>
				<div class='panel-body'>
				<?= $this->render('_gantipass', [
					'model' => $model,
				]) ?>
				</div>
			</div>
		</div>
	</div>

</div>
