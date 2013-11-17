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
?>
<div id="box">
<?php 
foreach($albums as $album)
{
	$image_properties = array(
			  'src' => 'images/album/thumbs/'.$album->gbr_album,
			  'alt' => $album->jdl_album,
			  'class' => 'images_album',
			  'width' => '100',
			  'title' => $album->jdl_album,
			  'rel' => 'lightbox',
	);
	
	echo '<a href="album/detail/'.$album->id_album.'/'.seo_title($album->jdl_album).'">'.img($image_properties).'</a>';	
}
?>
</div>