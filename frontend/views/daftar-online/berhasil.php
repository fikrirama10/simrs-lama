<?php
use yii\helpers\Url;
?>
<section  class="medilife-blog-area section-padding-100">
        <div class="container"style='margin-top:100px;'>
		<h1>Berhasil </h1><hr>
		<p></p>
		 <div class="panel single-accordion">
                            <h6><a role="button" class="" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Selamat Anda berhasil melakukan daftar online !!!
                                    <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    </a></h6>
                            <div id="collapseOne" class="accordion-content collapse show">
                                <p>Nomer Registrasi anda <b><?= $model->noregistrasi?> , </b> Selanjutnya silahkan datang ke pendaftaran RSAU LANUD SULAIMAN dan lakukan verifikasi Sebelum Pukul <b><?= date('H:i A',strtotime($model->poli->waktu))?><b><br>
								</p>
								<p>Segera Lakukan Verifikasi Caranya:<br>1. Tunjukan Nomor Registrasi ke pendaftaran <br>2. Jangan Lupa membawa kartu berobat <br>3. lengkapi persaratan jika anda peserta bpjs <br>4. Digit Terakhir pada nomer registrasi merupakan nomor antrian Online anda <br>5. Selesai , Selamat berobat semoga lekas sembuh :) </p>
								<p style='color:red;'>* silahkan ScreenShoot halaman ini untuk petunjuk anda </p>
                                <a href='<?= Url::to(['/'])?>'class= 'btn btn-success' >Selesai</a>
                            </div>
                        </div>
		</div>
</section>