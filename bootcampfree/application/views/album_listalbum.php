<?php
echo heading('Daftar Album', 2);
foreach($albums as $album)
{

	echo '<p>';
	$image_properties = array(
			  'src' => 'images/album/thumbs/'.$album->gbr_album,
			  'alt' => $album->jdl_album,
			  'class' => 'images_album',
			  'width' => '100',
			  'title' => $album->jdl_album,
			  'rel' => 'lightbox',
	);
	
	echo '<a href="'.site_url().'album/detail/'.$album->id_album.'/'.seo_title($album->jdl_album).'">'.img($image_properties).'</a>';
	echo '</p>';		
}
echo '<div id="clearer"></div>';
echo ! empty($pagination) ? '<p id="pagination">' . $pagination . '</p>' : '';

?>