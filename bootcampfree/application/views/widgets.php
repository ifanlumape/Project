<?php
function add_widget($tipe,$posisi) {
	
	if($posisi == 'sidebar') : 
		$printWidget = '<div id="widget">';
	elseif($posisi == 'footer') : 
		$printWidget = '<div id="footer-widget">';
	endif;
	
	switch($tipe) {
		case "cari":		
			$printWidget .= '
				<form method="POST" action="hasil-pencarian.html">
					<input class="searchField" type="text" name="kata" maxlength="50" placeholder="Cari.." />
					<input class="searchSubmit" type="submit" value="" />
				</form>';	
		break;
		
		case "populer":
			$printWidget .= '<div id="widget-title"><h3>Berita Populer</h3></div>
							<ul>';
				$populer = $this->Widget_model->get_berita_populer();		 
				foreach($populer->result() as $p) {
					$judul = $p->judul;
					$printWidget .= '<li><a class="ease" href="berita-'.$p->id_berita.'-'.$p->judul_seo.'.html">'.$judul.'</a></li>';
				}
			$printWidget .= '</ul>';
		break;
		
		case "kategori":
			$printWidget .= '<div id="widget-title"><h3>Kategori</h3></div>
							<ul>'; 
			@$kategori = $this->Widget_model->get_kategori();
			foreach($kategori->result() as $k) {
				$nama_kategori = strtoupper($k->nama_kategori);
				$printWidget .= '<li><a class="ease" href="kategori-'.$k->id_kategori.'-'.$k->kategori_seo.'.html">'.$nama_kategori.'</a> ('.$k->jml.')</li>';
			}
		$printWidget .= '</ul>';
		break;
		
		case "poling":
			$printWidget .= '<div id="widget-title"><h3>Polling</h3></div>
							<ul>
							<div class="poll-content">';
			$tanya = $this->db->query("SELECT * FROM poling WHERE aktif = 'Y' and status = 'Pertanyaan'");
            $t = $tanya->row();

			$printWidget .= '<div class="poll-question">'.$t->pilihan.'</div>';
            $printWidget .= '<form method="POST" id="radio" action="hasil-poling.html">';

            $poling = $this->Widget_model->get_poling();
            foreach($poling->result() as $p) {
                $printWidget .= '<input type="radio" name="pilihan" value="'.$p->id_poling.'" />'.$p->pilihan.'<br />';
            }
            $printWidget .= '<div align="right" style="padding-bottom:8px;"><a class="button" href="lihat-poling.html">Hasil</a> <input type="submit" value="Vote" class="button" /> </div>
                      </form>
                 ';
            $printWidget .= '</div></ul>';
		break;
		
		case "download";
			$printWidget .= '<div id="widget-title"><h3>Download</h3></div>
							<ul> '; 
			$download = $this->Widget_model->get_download();
                  
			foreach($download->result() as $d){
				$printWidget .= '<li><a class="ease" href="downlot.php?file='.$d->nama_file.'">'.$d->judul.'</a></li>';
			}
		$printWidget .= '</ul>';	
		break;
		
		case "agenda":
			$printWidget .= '<div id="widget-title"><h3>Agenda</h3></div>
							<ul>';
            $agenda = $this->Widget_model->get_agenda();
            foreach($agenda->result() as $a) {
                $tgl_agenda = tgl_indo($a->tgl_mulai);
                $isi_agenda = strip_tags($a->isi_agenda); // membuat paragraf pada isi berita dan mengabaikan tag html
                $isi = substr($isi_agenda,0,200); // ambil sebanyak 220 karakter
                $isi = substr($isi_agenda,0,strrpos($isi," ")); // potong per spasi kalimat
       
            $printWidget .= '<li><b>['.$tgl_agenda.']</b> - <a class="ease" href="agenda-'.$a->id_agenda.'-'.$a->tema_seo.'.html" title="'.$isi_agenda.' ...">'.$a->tema.'</a></li>';
                }
			$printWidget .= '</ul>';
		break;
		
		case "komentar":
			$printWidget .= '<div id="widget-title"><h3>Komentar Terbaru</h3></div>
							<ul>';
			  
			$komentar = $this->Widget_model->get_komentar();
			foreach($komentas->result() as $k){
				$printWidget .= '<li><a class="ease" href="http://'.$k->url.'"><b>'.$k->nama_komentar.'</b></a> pada <a class="ease" href="berita-'.$k->id_berita.'-'.$k->judul_seo.'.html#'.$k->id_komentar.'">'.$k->judul.'</a></li>';
		}
			$printWidget .= '</ul>';

		break;
		
		case "banner":
			$printWidget .= '<div id="widget-title"><h3>Banner</h3></div>
							<ul>';
		
			$banner = $this->Widget_model->get_banner();
			foreach($banner->result() as $b) {
				$printWidget .= '<li><center><a href="'.$b->url.'" target="_blank" title="'.$b->judul.'"><img src="foto_banner/'.$b->gambar.'" border="0"></a></center></li>';
			}
			$printWidget .= '</ul>';
		
		break;
	}
	
	$printWidget .= '</div>';
	
	return $printWidget;
	
	echo $printWidget;
}
?>