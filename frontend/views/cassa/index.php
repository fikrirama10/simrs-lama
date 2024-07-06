<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Semua Pasien';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aspirasi-index" style='margin-top:20px;'>
	<div class='box box-default'>
	
		<div class='col-md-12'>
			<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
		</div>
		<div class='box-body'>
			<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
			
		
		</div>
	</div>
</div>
	<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					
					['label' => 'No Rawat','attribute' => 'idrawat'],
					
					['label' => 'RM','attribute' => 'no_rekmed'],
					['label' => 'Tanggal Rawat','attribute' => 'tgldaftar'],
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								
								
								
								
							],
					],


					
				],
			]); ?>
<?php
// $script = <<< JS
// $(document).ready(function() {
    // setInterval(function(){ $("#refreshButton").click(); }, 10);
// });
// setTimeout(function () {
        // window.location.reload();
 // }, 6000);
// JS;
// $this->registerJs($script);
?>