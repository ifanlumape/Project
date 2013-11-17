<?php
echo heading('Daftar Download', 2);

foreach($downloads as $download)
{
	echo heading($download->judul, 3);
	echo '<p>'.anchor('download/downloadfile/'.$download->id_download.'/'.seo_title($download->nama_file), $download->nama_file).'</p>';		
}
echo '<div id="clearer"></div>';
echo ! empty($pagination) ? '<p id="pagination">' . $pagination . '</p>' : '';
?>