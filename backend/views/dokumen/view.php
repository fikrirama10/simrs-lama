<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->Judul;
$this->params['breadcrumbs'][] = ['label' => 'Dokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->Kode;
?>
<div class="dokumen-view">
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h4><?= Html::encode($this->title);?></h4>
		</div>
		<div class='panel-body'>
			<div class='col-sm-12'>
			
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Kode Dokumen</div>
					<div class='col-sm-9'> : <?= $model->Kode;?></div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Judul</div>
					<div class='col-sm-9'> : <?= $model->Judul;?></div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Kategori</div>
					<div class='col-sm-9'> : <?= $model->kategori->Kategori;?></div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Jenis</div>
					<div class='col-sm-9'> : <?= $model->jenis->Jenis;?></div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Type</div>
					<div class='col-sm-9'> : <?= $model->type->Type;?></div>
				</div>
				
		
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Diminta</div>
					<div class='col-sm-9'> : <?= $model->Requested;?> kali</div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Kandungan Informasi</div>
					<div class='col-sm-9'> <div class='well'> <?= $model->Deskripsi;?></div></div>
				</div>
				
				<div class='row'>
				
					<div class='panel panel-warning'>
						<div class='panel-heading dark'>
							<h5>
								<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion' href='#collapse1'>Tampilkan Dokumen</a>
							</h5>
						</div>
						<div id='collapse1' class='panel-collapse collapse'>
							<div class='panel-body'>
								<div class='col-sm-12'>
									<div class="PDF">
									   <object data="<?= Yii::$app->params['baseUrl'].'/frontend/upload/documents/'.$model->FileName;?>" type="application/pdf" width="750" height="600">
										   alt : <a href="<?= Yii::$app->params['baseUrl'].'/frontend/upload/documents/'.$model->FileName;?>"><?= $model->FileName;?></a>
									   </object>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
			
			
			
			
			
		</div>
		
		<div class='panel-footer'>
			<p>
				<?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
				<?= Html::a('Delete', ['delete', 'id' => $model->Id], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
			</p>
		</div>
	</div>
	

</div>
