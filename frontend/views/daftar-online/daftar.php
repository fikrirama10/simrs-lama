<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Daftaronline */

?>
<div class="daftaronline-view">
<section  class="medilife-blog-area section-padding-100">
        <div class="container"style='margin-top:100px;'>
		<h1>Daftar Online</h1><hr>
		
							
							<form role="search" action="/simrs/daftar-online/pencarian" method="get">
							<div class="form-group" style=' background:#081f3e; padding:10px 10px 10px 10px; color:#ececec;'>
								<div class='row'>
									<div class='col-md-6'>
										<div class='row'>
											<div class='col-md-6'><label>No Rekamedis</label>
												<input type="text" required name='norm' class="form-control"  placeholder="RM">
											</div>
											<div class='col-md-6'><label>Tanggal lahir</label>
												<input type="text" required  name='tgllahir' class="form-control"  placeholder="YYYY-MM-DD">
											</div>
										</div>
										 <input type="submit" class= 'btn btn-success' value="Search">
										
									</div>
									<div class='col-md-6'></div>
								</div>
								
								
								
							</div>
							
							</form>
							
				
		</div>
</section>
</div>
