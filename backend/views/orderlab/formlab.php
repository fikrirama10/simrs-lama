<?php 
use yii\helpers\Html;

use common\models\Pemriklab;
use common\models\Daflab;
use common\models\Rawatjalan;
use common\models\Lab;

$plabk = Lab::find()->joinwith(['katlab as katlab'])->where(['kodelab'=>$pemriklab->kodelab])->groupby(['idjenisp'])->orderby(['katlab.jenis'=>SORT_ASC])->all();

?>
<?php $labbbbn = Lab::find()->where(['kodelab'=>$pemriklab->kodelab])->orderby(['tgl_peniksa'=>SORT_DESC])->one(); ?>
<style>
    
</style>
<div class='header-lab'>
	<div class='header-lab-judul'>
		<div class="header-lab-judul-au">
		PANGKALAN TNI AU SULAIMAN <br>RUMAH SAKIT
		</div>
		
	</div><br><br>
	<p>Penanggung jawab :  dr. Ida Widayati Djajadisastra, Sp.PK</p>
</div>
			
			<div class='olab'>
			<br>
			<table>
				<tr>
					<td width=120>RM</td>
					<td class='border0'>:</td>
					<td  width=200><?= $pemriklab->no_rekmed ?>
				</td>
				<td   width=120>Kode Lab</td>
					<td class='border0'>:</td>
					<td   width=200><?= $pemriklab->kodelab ?>
				</td>
					
					
				</tr>
				<tr>
				<td  width=100>Nama</td>
					<td>:</td>
					<td   width=200><?= $pemriklab->pasien->sbb ?>. <?= $pemriklab->pasien->nama_pasien?></td>
				<td   width=120>Tanggal</td>
					<td>:</td>
					<td   width=200><?= date('d F Y',strtotime($pemriklab->tgl_order )) ?></td>
				
					
				</tr>
				<tr>
					<td   width=120>Tanggal Lahir</td>
					<td>:</td>
					<td   width=200><?= date('d-F-Y',strtotime($pemriklab->pasien->tanggal_lahir))?> (<?= $pemriklab->pasien->usia?> th) </td>
					<td   width=120>Unit Pelayanan</td>
					<td>:</td>
					<td   width=200>
					<?php if($pemriklab->idtkp == 1){
						echo $pemriklab->rawat->polii->namapoli;
					}else if($pemriklab->idtkp == 2){echo'Perawatan';}else{
						echo'IGD';
					}
					?>
					</td>
					
				</tr>
				<tr>
					<td width=120>Jenis Kelamin</td>
					<td>:</td>
					<td width=200>
						<?php if($pemriklab->pasien->jenis_kelamin == 'L'){echo"Laki-Laki";}else{echo"Perempuan";} ?>
					</td>
					<td   width=120>Dokter Pengirim</td>
					<td>:</td>
					<td width=200>
					<?= $pemriklab->dokter->namadokter?>
					</td>
					
				</tr>
				<tr>
					<td width=120>Alamat</td>
					<td>:</td>
					<td   width=200>
					<?= $pemriklab->pasien->alamat ?>
					</td>
					<td   width=120>Ruang / Kelas</td>
					<td>:</td>
					<td   width=200>
					<?= $pemriklab->jrawat->jenisrawat ?>
					</td>
					
					
				</tr>
				<tr>
					<td   width=120>Jam Hasil</td>
					<td>:</td>
					<td width=200>
					<?= date('H:i:s',strtotime('+2 hour',strtotime($labbbbn->tgl_peniksa))); ?>
					</td>
					<td width=120></td>
					<td></td>
					<td width=200>
					
					</td>
					
					
				</tr>
				
					
					
			</table>
			</div>
			
			<h5>HASIL PEMERIKSAAN LABORATORIUM</h5>
			<div class='olab'>
			<table>
			<tr>
						<th width=200>Nama Pemeriksaan</th>
						<th width=100>Hasil Pemeriksaan</th>
						<th width=250>Nilai Normal</th>
						<th>Satuan</th>
					</tr>
			</table>
			<?php foreach($plabk as $lab):?>
				
				<table>
				
				<tr>
					<td style='background:#ececec;' colspan="4"><h5><b><?= $lab->katlab->kat0->namapemeriksaan?></b></h5></td>
				</tr>
					
					<?php $labb = Lab::find()->where(['idjenisp'=>$lab->idjenisp])->andwhere(['kodelab'=>$lab->kodelab])->orderby(['idjenisp'=>SORT_DESC])->all(); ?>
					<?php foreach($labb as $lbb): ?>
					<?php $labbb = Pemriklab::find()->joinwith('kat as kat')->where(['labid'=>$lbb->id])->orderby(['kat.urutan'=>SORT_ASC])->all();
					
					?>
						<?php foreach($labbb as $lb): ?>
					<?php if($lb->hasil == null || $lb->hasil == '-'){echo"";}else{?>
					<tr>
						<td width=200><div style='text-indent:120px;'><?= $lb->kat->nama ?></div></td>
						<td width=100><?= $lb->hasil?></td>
						<?php if($lb->kat->l == "" || $lb->kat->p == ""){echo "<td></td>";}else{ ?>
						<?php if($lb->kat->l == $lb->kat->p){ ?>
							<td width=250>
							   <pre><?= $lb->kat->l?> </pre>
							 </td>
						<?php }else{ ?>
							<td width=250><pre>L: <?= $lb->kat->l?></pre>  <pre>P: <?= $lb->kat->p?></pre></td>
						<?php } ?>
					
						<?php } ?>
						<td><?= $lb->kat->satuan?></td>
					</tr>
					<?php } ?>
					<?php endforeach;?>
					<?php endforeach;?>
					
				</table>
			<?php endforeach;?>
			<br>
			
			</div>
			<br>
			<div style='width:50%; text-indent:80px; font-size:15px; float:left;'>Dokter</div>
			<div style='width:50%; text-indent:40px; text-align:center; font-size:15px; float:right;'>Pemeriksa</div>
			
			