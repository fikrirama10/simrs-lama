<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Daftaronline */

?>
<div class='box box-body'>
<h4>Kunjungan Poliklinik</h4><hr>
<form role="search" action="laporan-all" method="get">
							<div class="form-group">
								<div class='row'>
									<div class='col-md-6'>
										<div class='row'>
											<div class='col-md-6'><label>Tanggal Awal</label>
												<?= DatePicker::widget([
												'id' => 'awal',
												'name' => 'awal',
												//'value' => $start,
												'options' => ['placeholder' => 'awal'],
												'removeButton' => false,
												'pluginOptions' => [
													'format' => 'yyyy-mm-dd',
													'todayHighlight' => true
												]
												]); ?>
											
											</div>
											<div class='col-md-6'><label>Tanggal Akhir</label>
												<?= DatePicker::widget([
												'id' => 'akhir',
												'name' => 'akhir',
												//'value' => $start,
												'options' => ['placeholder' => 'Akhir'],
												'removeButton' => false,
												'pluginOptions' => [
													'format' => 'yyyy-mm-dd',
													'todayHighlight' => true
												]
												]); ?>
											
											</div>
										</div><br>
										 <button type="submit"  class= 'btn btn-success' formtarget="_blank">Submit</button>
										 
										
									</div>
									
										
									<div class='col-md-6'>
									<div class="bs-callout bs-callout-info"> <h4>Laporan Bulanan Kunjungan Poliklinik</h4> <p>Masukan tanggal awal dan tanggal akhir pada kolom pencarian</p> </div>
									</div>
									
							
								</div>
								
								
								
							</div>
							
							</form>
							</div>
