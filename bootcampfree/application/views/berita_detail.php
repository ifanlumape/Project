<?php
foreach($beritas as $berita)
{
	echo heading(anchor('berita/detail/'.$berita->id_berita.'/'.seo_title($berita->judul), $berita->judul), 2);
	echo tgl_indonesia($berita->tgl_posting).', '.$berita->jam;
	echo '<p>';
	$image_properties = array(
			  'src' => 'images/berita/'.$berita->gambar,
			  'alt' => $berita->judul,
			  'class' => 'images_berita',
			  'width' => '540',
			  'title' => $berita->judul,
			  'rel' => 'lightbox',
	);
	
	echo img($image_properties);
	echo $berita->isi_berita;
	echo '</p><div id="clearer"></div>';		
}
?>