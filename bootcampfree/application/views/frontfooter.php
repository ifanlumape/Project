<?php
echo '<div id="box-footer" class="kolom2">';
echo heading('Agenda', 2);
$list_agenda = array();
$agendas = $this->db->query("select * from agenda order by id_agenda desc limit 5")->result();
foreach($agendas as $agenda)
{
	$list_agenda[] = anchor('agenda/detail/'.$agenda->id_agenda.'/'.seo_title($agenda->tema), $agenda->tema);
}

$attributes_agenda= array(
                    'class' => 'boldlist',
                    'id'    => 'mylist'
                    );
echo ul($list_agenda, $attributes_agenda);
echo '</div>
		<div id="pembatas" class="kolom2"></div>
	  <div id="box-footer" class="kolom2">';
echo heading('Download', 2);
$list_download = array();
$downloads = $this->db->query("select * from download order by id_download desc limit 5")->result();
foreach($downloads as $download)
{
	$list_download[] = anchor('download/file/'.$download->id_download.'/'.$download->nama_file, $download->nama_file);
}

$attributes_download= array(
                    'class' => 'boldlist',
                    'id'    => 'mylist'
                    );
echo ul($list_download, $attributes_download);
echo '</div>
		<div id="pembatas" class="kolom2"></div>
		<div id="box-footer" class="kolom2">';
echo heading('Kontak', 2);
$list_hubungi = array();
$hubungis = $this->db->query("select * from hubungi order by id_hubungi desc limit 5")->result();
foreach($hubungis as $hubungi)
{
	$list_hubungi[] = safe_mailto($hubungi->email, $hubungi->nama).' Subjek '.$hubungi->subjek;
}

$attributes_hubungi= array(
                    'class' => 'boldlist',
                    'id'    => 'mylist'
                    );
echo ul($list_hubungi, $attributes_hubungi);
echo '</div>';
?>
Copyright &copy; 2013 APTIKOM Sulut. All rights reserved.