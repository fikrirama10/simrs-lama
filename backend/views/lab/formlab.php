<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
use common\models\Pemriklab;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

$plabk = Pemriklab::find()->where(['idrawat'=> $pemriklab->idrawat])->andWhere(['idjenisp'=>$pemriklab->idjenisp])->groupby(['idtindakan'])->all();
$no=1;
?>
<div class='header-lab'>
	<div class='header-lab-judul'>
		<div class="header-lab-judul-au">
		PANGKALAN TNI AU SULAIMAN <br>RUMAH SAKIT
		</div>
		
	</div>
	<div class='header-lab-logo'>
		<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($pemriklab->idrawat, $generator::TYPE_CODE_128)) . '">'; ?>
		<div style='font-size:11px; letter-spacing: 6px;'>
			<?= $pemriklab->idrawat ?> 
			</div>
	</div>

	

</div>
<div class='body-lab'>
<br>
			<table>
				<tr>
					<td class='nolborder' width=100>Nama</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= $pemriklab->pasien->sbb ?>. <?= $pemriklab->pasien->nama_pasien?></td>
					<td class='nolborder'  width=120>RM</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= $pemriklab->no_rekmed ?></td>
				</tr>
				<tr>
					<td class='nolborder'  width=100>Tanggal Lahir</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= date('d F Y',strtotime($pemriklab->pasien->tanggal_lahir))  ?> / <?= $pemriklab->pasien->jenis_kelamin?></td>
					<td class='nolborder'  width=120>Tanggal</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= date('d F Y',strtotime($pemriklab->tanggal_req )) ?></td>
				</tr>
				<tr>
					<td class='nolborder'  width=120>Dokter Pengirim</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= $pemriklab->dokter->namadokter?></td>
					<td class='nolborder'  width=120>Alamat</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= $pemriklab->pasien->alamat?></td>
				</tr>
			
					
			</table>
</div><hr>
<div class='lab-body-hasil'>

<?php foreach($plabk as $labb): ?>
<h5><?= $labb->katt->nama ?></h5>
<?php if($labb->katt->jenis == 2){?>
	<?php $plab = Pemriklab::find()->where(['idrawat'=> $pemriklab->idrawat])->andWhere(['idjenisp'=>$pemriklab->idjenisp])->andwhere(['idtindakan'=>$labb->idtindakan])->all();?>
<table>
	<tr>
		<?php foreach($plab as $lab): ?>
		<td><b><?= $lab->kat->nama ?></b></td>
		<?php endforeach; ?>
	</tr>
	<tr>
		<?php foreach($plab as $lab): ?>
		<td><b><?= $lab->kat->l ?><?= $lab->kat->satuan?></b></td>
		<?php endforeach; ?>
	</tr>
	<tr>
		<?php foreach($plab as $lab): ?>
		<td><?= $lab->hasil?><?= $lab->kat->satuan?></td>
		<?php endforeach; ?>
	</tr>
	
	
</table>
<table>
<tr>
		<td><b>No</b></td>
		<td><b>Pemeriksaan</b></td>
		<td><b>Hasil</b></td>
		<td><b>Satuan</b></td>
		<td><b>Nilai Rujukan</b></td>
	</tr>
</table>
	<?php }else{ ?>
<table>
	
	<?php $plab = Pemriklab::find()->where(['idrawat'=> $pemriklab->idrawat])->andWhere(['idjenisp'=>$pemriklab->idjenisp])->andwhere(['idtindakan'=>$labb->idtindakan])->all();?>
	<?php foreach($plab as $lb): ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $lb->kat->nama ?></td>
			<td><?= $lb->hasil ?> </td>
			<td><?= $lb->kat->satuan ?></td>
			<?php if($lb->pasien->jenis_kelamin == 'L'){
	    		echo"<td>".$lb->kat->l."</td>";
	    	}else{
	    		echo"<td>".$lb->kat->p."</td>";
	    	} ?>
	    
		</tr>
	<?php endforeach; ?>
	
</table>
<?php } ?>
	<?php endforeach; ?>
</div>
<div class='ttd2'>
	<h5 style='text-align:center;'><br> Petugas lab</h5><br>
	<h5 style='text-align:center;'>..............................</h5>
	<h5 style='text-align:center;'><b><?= $pemriklab->pemeriksa->pegawai->nama_petugas ?></b></h5>
</div>
