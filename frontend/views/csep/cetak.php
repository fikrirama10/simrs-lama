<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>
<div class='header-sep'>
	<div class='header-sep-logo'>
	<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/bpjs.png',['class' => 'img img-responsive']);?>
	</div>
	<div class='header-sep-judul'>
	SURAT ELEGIBILITAS PESERTA RS LANUD SULAIMAN
	</div>
</div>
<div class='body-sep'>
	<div class='body-sep-kiri'>
		<table class='bbh' border=0>
			<tr>
				<td>No .SEP</td>
				<td>: <?= $repo['noSep']?></td>
			</tr>
			<tr>
				<td>Tgl .SEP</td>
				<td>: <?= $repo['tglSep']?></td>
			</tr>
			<tr>
				<td>No .Kartu</td>
				<td>: <?= $repo['peserta']['noKartu']?> ( MR . <?= $repo['peserta']['noMr']?>  )</td>
			</tr>
			<tr>
				<td>Nama Peserta</td>
				<td>: <?= $repo['peserta']['nama']?></td>
			</tr>
			<tr>
				<td>Tgl . Lahir</td>
				<td>: <?= $repo['peserta']['tglLahir']?> Kelamin :
					<?php if($kelas['sex']=='L'){echo"Laki - Laki";}else{echo"Perempuan";}?>
				</td>
			</tr>
			<tr>
				<td>No .Telepon</td>
				<td>: <?=$kelas['mr']['noTelepon'] ?></td>
			</tr>
			<tr>
				<td>Sub Spesialis</td>
				<td>: <?=$repo['poli'] ?></td>
			</tr>
			<tr>
				<td>Faskes Perujuk</td>
				
				<?php if($repo['noRujukan'] == true){
					echo'<td>: '.$kelas['provUmum']['nmProvider'].'</td>';
				}?>
			</tr>
			<tr>
				<td>Diagnosis Awal</td>
				<td>: <i><?= $repo['diagnosa'] ?></i></td>
			</tr>
			<tr>
				<td>Catatan</td>
				<td>:  <?= $repo['catatan'] ?></td>
			</tr>
		</table>
	</div>
	<div class='body-sep-kanan'>
	<br>
	<table>
			<tr>
				<td>Peserta</td>
				<td>: <?= $repo['peserta']['jnsPeserta']?></td>
			</tr>
			<tr>
				<td>COB</td>
				<td>: - </td>
			</tr>
			<tr>
				<td>Jns. Rawat</td>
				<td>: <?= $repo['jnsPelayanan']?></td>
			</tr>
			<tr>
				<td>Kls. Rawat</td>
				<td>: <?= $repo['peserta']['hakKelas']?></td>
			</tr>
			<tr>
				<td>Penjamin</td>
				<td>: <?= $repo['penjamin']?></td>
			</tr>

		</table>
	</div>
</div>
<div class='footer-sep'>
	<div class='footer-sep-kiri'>
		*Saya menyetujui BPJS Kesehatan menggunakan infomasi medis pasien jika diperlukan.
 SEP Bukan sebagai bukti penjaminan peserta.<br>
 <br>Cetakan Ke 1 <?= date('Y-m-d H:i:s',strtotime('+6 hour',strtotime(date('Y-m-d G:i:s')))) ?>
	</div>
	<div class='footer-sep-kanan'>
		Pasien / Keluarga Pasien<br><br><hr>
	</div>
</div>