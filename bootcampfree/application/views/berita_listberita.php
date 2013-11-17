<?php
foreach($beritas as $berita)
{

	echo '<p>';
	$image_properties = array(
			  'src' => 'images/berita/thumbs/'.$berita->gambar,
			  'alt' => $berita->judul,
			  'class' => 'images_berita',
			  'width' => '85',
			  'title' => $berita->judul,
			  'rel' => 'lightbox',
	);
	
	echo img($image_properties);
	
	echo heading(anchor('berita/detail/'.$berita->id_berita.'/'.seo_title($berita->judul), $berita->judul), 2);
	echo tgl_indonesia($berita->tgl_posting).', '.$berita->jam;
	echo br(1);	
	echo $berita->kutipan.'... '.anchor('berita/detail/'.$berita->id_berita.'/'.seo_title($berita->judul), 'Selengkapnya &raquo;');
	echo '</p><div id="clearer"></div>';		
}
echo ! empty($pagination) ? '<p id="pagination">' . $pagination . '</p>' : '';

?>