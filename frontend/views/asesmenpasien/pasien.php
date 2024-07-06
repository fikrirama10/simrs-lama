<?php
use yii\helpers\Url;
?>
           <div class="box box-body table-responsive no-padding">
              <table class="table table-hover">
               
				<tr>
                  <th>Tgl Daftar</th>
                  <th>RM</th>
                  <th>Nama Pasien</th>
                  <th>Tanggal Lahir</th>
                  <th>Aksi</th>
                </tr>
					
				<?php foreach($model as $m):?>
					
                <tr>
				<td><?= $m->tgldaftar ?></td>
				<td><?= $m->no_rekmed ?></td>
                <td><?= $m->pasien->nama_pasien?></td>
                <td><?= $m->pasien->tanggal_lahir?></td>
                
                <td><a href='<?= Url::to(['ppi/vppi/'.$m->id]) ?>'><span class="label label-success"><i class="fa fa-hand-stop-o"></i></span></a></td>
                </tr>
					
				<?php endforeach; ?>

              </table>
            </div>