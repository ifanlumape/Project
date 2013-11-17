<?php
echo heading('Sulut Doctoral Bootcamp', 2);
echo '<ul>';
foreach($halamans as $halaman)
{

	echo '<li>'.anchor('halaman/detail/'.$halaman->id_halaman.'/'.seo_title($halaman->judul), $halaman->judul).'</li>';		
}
echo '<div id="clearer"></div><br><br><br>';
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