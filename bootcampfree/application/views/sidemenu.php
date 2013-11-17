<?php

if($jadwal->num_rows() > 0)
{
	echo '<div 	id="box_sidemenu">';
	echo heading('Schedule!', 2);
	echo '<ul>';
	foreach($jadwal->result() as $row_jadwal)
	{
		echo '<li>';
		echo anchor(base_url().'jadwal/detail/'.$row_jadwal->id_jadwal.'/'.seo_title($row_jadwal->judul), $row_jadwal->judul);
		echo '</li>';
	}
	echo '</ul><p align="right" class="link_index_side_menu">';
	echo anchor('jadwal/form', 'Quick Search');
	echo '</p>';
	echo '</div>';
}

if($renungan_terbaru->num_rows() > 0)
{
	echo '<div id="box_sidemenu">';
	echo heading('Reflection', 2);
	echo '<ul>';
	foreach($renungan_terbaru->result() as $row_renungan_terbaru)
	{
		echo '<li>';
		echo anchor(base_url().'renungan/detail/'.$row_renungan_terbaru->id_renungan.'/'.seo_title($row_renungan_terbaru->judul), $row_renungan_terbaru->judul);
		echo '</li>';
	}
	echo '</ul><p align="right" class="link_index_side_menu">';
	echo anchor('renungan/all', 'Index');
	echo '</p>';
	echo '</div>';
}

if($agenda_terbaru->num_rows() > 0)
{
	echo '<div id="box_sidemenu">';
	echo heading('Agenda', 2);
	echo '<ul>';
	foreach($agenda_terbaru->result() as $row_agenda_terbaru)
	{
		echo '<li>';
		echo anchor(base_url().'agenda/detail/'.$row_agenda_terbaru->id_agenda.'/'.seo_title($row_agenda_terbaru->tema), $row_agenda_terbaru->tema);
		echo '</li>';
	}
	echo '</ul><p align="right" class="link_index_side_menu">';
	echo anchor('agenda/all', 'Index');	
	echo '</p>';
	echo '</div>';
}

if($banner_terbaru->num_rows() > 0)
{
	echo '<div id="box_sidemenu">';
	echo '<p align=center>';
	foreach($banner_terbaru->result() as $row_banner_terbaru)
	{
		$image_properties = array(
				  'src' => base_url().'images/banner/'.$row_banner_terbaru->gambar,
				  'alt' => $row_banner_terbaru->judul,
				  'class' => 'img_banner',
				  'title' => $row_banner_terbaru->judul,
				  'rel' => 'lightbox',
		);
		echo anchor($row_banner_terbaru->url, img($image_properties), array('target' => '_blank'));	
	}
	echo '</p><br />';
	echo '</div>';
}
?>