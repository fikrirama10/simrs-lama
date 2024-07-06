<p style='font-size:15px;'>PIC Windayanti, S.kep<p>
<b><h4 ALIGN=CENTER>FORMAT PENCATATAN INDIKATOR PRIORITA</h4></b>
<p style='font-size:15px;'>Indikator Area Klinik 1 :</p>
<p style='font-size:15px;'> => Presentase Kelengkapan Assesmen Awal Medis Pasien Gawat Darurat
<div class='trx'>
	<table>	
				<tr>
						<th>#</th>
						<th>Tanggal</th>
						<th>Nama Pasien</th>
						<th>Usia</th>
						<th>RM</th>
						<th>Anamnesis</th>
						<th>Assesmen Psikognitif</th>
						<th>Pemeriksaan Fisik</th>
						<th>Pemeriksaan Penunjang</th>
						<th>Diagnosis</th>
						<th>Rencana Asuhan</th>
						<th>EVT</th>
						<th>TTD DPJP</th>
						<th>Keterangan</th>
						
						
					</tr>
			
					<?php 
					if(count($dataProvider) > 0){
						$no = 1;
						foreach($dataProvider as $data){
													
					?>
					<input type="hidden" id="trxid" value="<?= $data->id ?>">
					<tr>
						<td><?= $no++ ?></td>
						<td><?= date('d/m/Y',strtotime($data->tanggal ))?></td>
						<td><?= $data->pasien->nama_pasien ?></td>
						<td><?= $data->pasien->usia ?> th</td>
						<td><?= $data->no_rekmed ?></td>
						<?php if($data->anamesisi == 1){
								echo '<td><b>v</b></td>';
							}else{
								echo '<td><b>-</b></td>';
							}?>
						<?php if($data->ass_psiko == 1){
								echo '<td><b>v</b></td>';
							}else{
								echo '<td><b>-</b></td>';
							}?>
						<?php if($data->rx_fisik == 1){
								echo '<td><b>v</b></td>';
							}else{
								echo '<td><b>-</b></td>';
							}?>
						<?php if($data->penunjang == 1){
								echo '<td><b>v</b></td>';
							}else{
								echo '<td><b>-</b></td>';
							}?>
						<?php if($data->diagnosis == 1){
								echo '<td><b>v</b></td>';
							}else{
								echo '<td><b>-</b></td>';
							}?>
						<?php if($data->rencanaasuhan == 1){
								echo '<td><b>v</b></td>';
							}else{
								echo '<td><b>-</b></td>';
							}?>
						<?php if($data->evaluasi == 1){
								echo '<td><b>v</b></td>';
							}else{
								echo '<td><b>-</b></td>';
							}?>
						<?php if($data->ttd == 1){
								echo '<td><b>v</b></td>';
							}else{
								echo '<td><b>-</b></td>';
							}?>
						<?php if($data->lengkap == 1){
								echo '<td><b>
								lengkap</b></td>';
							}else{
								echo '<td><b>Tidak Lengkap</b></td>';
							}?>
						
						
					</tr>
					<?php 
						}
						
						}
						
					else{
					?>
					<tr>
						<td colspan=14><div class="empty">No result found.</div></td>
					</tr>
					<?php } ?>
			
			</table>
</div>
