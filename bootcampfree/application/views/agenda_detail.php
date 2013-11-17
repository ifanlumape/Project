<?php
echo heading($h2_title, 2);

foreach($agendas as $agenda)
{
	echo '<p>Tempat : '.$agenda->tempat.'</p>';
	echo '<p>Tanggal : '.tgl_indonesia($agenda->tgl_mulai).' s/d '.tgl_indonesia($agenda->tgl_selesai).'</p>';
	echo '<p>Waktu : '.$agenda->waktu.'</p>';
	echo '<p>Tempat : '.$agenda->isi_agenda.'</p>';
	echo '<p>Pengirim : '.$agenda->username.'</p>';
}
?>