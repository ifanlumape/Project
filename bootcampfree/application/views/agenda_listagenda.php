<?php
echo heading('Daftar Agenda', 2);

foreach($agendas as $agenda)
{
	echo heading($agenda->tema, 2);
	echo '<p>Tempat : '.$agenda->tempat.'</p>';
	echo '<p>Tanggal : '.tgl_indonesia($agenda->tgl_mulai).' s/d '.tgl_indonesia($agenda->tgl_selesai).'</p>';
	echo '<p>Waktu : '.$agenda->waktu.'</p>';
	echo '<p>Tempat : '.$agenda->isi_agenda.'</p>';
	echo '<p>Pengirim : '.$agenda->username.'</p>';
}
echo ! empty($pagination) ? '<p id="pagination">' . $pagination . '</p>' : '';

?>