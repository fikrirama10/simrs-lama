<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Jenisrawat;
use common\models\Petugas;

use common\models\Poli;
$this->title = 'Daftar User ';

?>
<div  class="trx" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-size:20px;">
	<div class='header-kunjungan'>
	<div class='header-kunjungan-judul'>

		
	</div>
	

</div>
<div class='judul-kunjungan'>
	<b>Daftar User</b>
	</div>
			<table>	
				<tr>
						<th>#</th>
						<th>Username</th>
						<th>Password</th>
						<th>Hak Akses</th>
						
						
					</tr>
			
					<?php 
					if(count($dataProvider) > 0){
						$no = 1;
						foreach($dataProvider as $data){
													
					?>
					<input type="hidden" id="trxid" value="<?= $data->id ?>">
					<tr>
						<td><?= $no++ ?></td>
				
						<td><?= $data->username ?></td>
						<td><?= $data->password_repeat ?></td>
						<td><?= $data->priviledges->privilages ?></td>
						
						
					</tr>
					<?php 
						}
						
						}
						
					else{
					?>
					<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
					</tr>
					<?php } ?>
			
			</table>
			
		
			
	</div>
</div>
