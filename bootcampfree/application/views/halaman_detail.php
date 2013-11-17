<?php
foreach($halamans as $halaman)
{
	echo heading(anchor('halaman/detail/'.$halaman->id_halaman.'/'.seo_title($halaman->judul), $halaman->judul), 2);
	echo tgl_indonesia($halaman->tgl_posting);
	echo '<p>';
	$image_properties = array(
			  'src' => 'images/halaman/'.$halaman->gambar,
			  'alt' => $halaman->judul,
			  'class' => 'images_halaman',
			  'width' => '540',
			  'title' => $halaman->judul,
			  'rel' => 'lightbox',
	);
	
	if(file_exists(site_url().'images/halaman/'.$halaman->gambar))
	{
		echo img($image_properties);
	}
	echo $halaman->isi_halaman;
	echo '</p><div id="clearer"></div>';		
}
?>