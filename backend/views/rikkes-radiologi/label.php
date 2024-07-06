<?php foreach($pemriklab as $pemriklab): ?>
<div class='judul'>Nomer Tes : <?= $pemriklab->nomer_tes ?> | No: <?= $pemriklab->nofoto ?></div>
<div class='rmedis2'><b><h4><?=substr($pemriklab->nama,0,15)?></h4></b></div>
<div class='judul'>Usia : <?= $pemriklab->usia?> Th </div><br>
<br>
<?php endforeach ;?>