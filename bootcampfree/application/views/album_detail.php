<?php
echo heading(ucwords($jdl_album), 2);
foreach($gallerys as $gallery)
{

	$image_properties = array(
			  'src' => 'images/gallery/'.$gallery->gbr_gallery,
			  'alt' => $gallery->jdl_gallery,
			  'class' => 'images_gallery',
			  'width' => '100',
			  'title' => $gallery->jdl_gallery,
			  'rel' => 'lightbox',
	);
	
	echo img($image_properties);		
}
	echo '<div id="clearer"></div>';
?>