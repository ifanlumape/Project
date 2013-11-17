<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('agenda/Agenda_model', '', TRUE);
		$this->load->helper('combobox', '', TRUE);
	}
	
	var $limit = 10;
	var $title = 'agenda';
	
	function index()
	{
		$this->session->unset_userdata('id_agenda');
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_last_ten_agenda();
		}
		else
		{
			redirect('welcome');
		}
	}
	
	function get_last_ten_agenda()
	{
		if($this->session->userdata('login') == TRUE)
		{
			$data['title'] = $this->title;
			$data['h2_title'] = 'Agenda';
			$data['main_view'] = 'agenda/agenda';
			
			// Offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			// Load data dari tabel agenda
			$agendas = $this->Agenda_model->get_last_ten_agenda($this->limit, $offset)->result();
			$num_rows = $this->Agenda_model->count_all_num_rows();
			
			if ($num_rows > 0) // Jika query menghasilkan data
			{
				// Membuat pagination			
				$config['base_url'] = site_url('agenda/get_last_ten_absen');
				$config['total_rows'] = $num_rows;
				$config['per_page'] = $this->limit;
				$config['uri_segment'] = $uri_segment;
				$this->pagination->initialize($config);
				$data['pagination'] = $this->pagination->create_links();
				
				// Set template tabel, untuk efek selang-seling tiap baris
				$tmpl = array( 'table_open' => '<table border="0" cellpadding="0" cellspacing="0">', 'row_alt_start' => '<tr class="zebra">', 'row_alt_end' => '</tr>'
							  );
				$this->table->set_template($tmpl);
	
				// Set heading untuk tabel
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('No', 'Tema', 'Tgl. Mulai', 'Tgl. Selesai',  'Tgl. Posting', 'Tgl. Update', 'Actions');
				
				// Penomoran baris data
				$i = 0 + $offset;
				
				foreach ($agendas as $agenda)
				{
					// Konversi hari dan tanggal ke dalam format Indonesia
					$hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
					
					$hr1 = date('w', strtotime($agenda->tgl_mulai));
					$hr2 = date('w', strtotime($agenda->tgl_selesai));
					$hr3 = date('w', strtotime($agenda->tgl_posting));
					$hr4 = date('w', strtotime($agenda->tgl_update));
					
					$hari1 = $hari_array[$hr1];
					$hari2 = $hari_array[$hr2];
					$hari3 = $hari_array[$hr3];
					$hari4 = $hari_array[$hr4];
					
					$tgl1 = date('d-m-Y', strtotime($agenda->tgl_mulai));
					$tgl2 = date('d-m-Y', strtotime($agenda->tgl_selesai));
					$tgl3 = date('d-m-Y', strtotime($agenda->tgl_posting));
					$tgl4 = date('d-m-Y', strtotime($agenda->tgl_update));
					
					$hr_tgl1 = "$hari1, $tgl1";
					$hr_tgl2 = "$hari2, $tgl2";
					$hr_tgl3 = "$hari3, $tgl3";
					$hr_tgl4 = "$hari4, $tgl4";
					
					$this->table->add_row(++$i, $agenda->tema, $hr_tgl1, $hr_tgl2, $hr_tgl3, $hr_tgl4, anchor('agenda/update/'.$agenda->id_agenda,'update',array('class' => 'update')).' '.anchor('agenda/delete/'.$agenda->id_agenda,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
				}
				$data['table'] = $this->table->generate();
			}
			else
			{
				$data['message'] = 'Tidak ditemukan satupun data agenda!';
			}		
			
			$data['link'] = array('link_add' => anchor('agenda/add/','tambah data', array('class' => 'add')));
			
			// Load default view
			$this->load->view('template', $data);
		}
		else
		{
			redirect('users');
		}
	}
	
	
	/**
	 * Berpindah ke form untuk entry data agenda baru
	 */
	function add()
	{
		if($this->session->userdata('login') == TRUE)
		{			
			if($this->session->userdata('login') == TRUE)
			{	
				$data['title'] 			= $this->title;
				$data['h2_title'] 		= 'Agenda > Tambah Data';
				$data['main_view'] 		= 'agenda/agenda_form';
				$data['form_action']	= site_url('agenda/add_process');
				$data['link'] 			= array('link_back' => anchor('agenda/','kembali', array('class' => 'back')));
	
				$data['tgl_mulai'] = date("d");
				$data['bln_mulai'] = date("m");
				$data['thn_mulai'] = date("Y");
	
				$data['tgl_selesai'] = date("d");
				$data['bln_selesai'] = date("m");
				$data['thn_selesai'] = date("Y");	
				
				$this->load->view('template', $data);
			}
			else
			{
				redirect('agenda');
			}
		}
		else
		{
			redirect('users');
		}
	}
	
	/**
	 * Proses untuk entry data agenda baru
	 */
	function add_process()
	{
		if($this->session->userdata('login') == TRUE)
		{		
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Agenda > Tambah Data';
			$data['main_view'] 		= 'agenda/agenda_form';
			$data['form_action']	= site_url('agenda/add_process');
			$data['link'] 			= array('link_back' => anchor('agenda/','kembali', array('class' => 'back')));
			
			$data['tgl_mulai'] = date("d");
			$data['bln_mulai'] = date("m");
			$data['thn_mulai'] = date("Y");
	
			$data['tgl_selesai'] = date("d");
			$data['bln_selesai'] = date("m");
			$data['thn_selesai'] = date("Y");	
						
			// Set validation rules
			$this->form_validation->set_rules('tema', 'Tema', 'trim|max_length[100]|required|callback_valid_tema');
			$this->form_validation->set_rules('isi_agenda', 'Isi Agenda', 'trim|required');
			$this->form_validation->set_rules('tempat', 'Tempat', 'trim|max_length[100]|required');
			$this->form_validation->set_rules('waktu', 'Waktu', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|max_length[100]|required');
	
			
			if ($this->form_validation->run() == TRUE)
			{
				
				$tgl = date('Y-m-d');	
				$tgl_mulai = $this->input->post('thn_mulai').'-'.$this->input->post('bln_mulai').'-'.$this->input->post('tgl_mulai');
				$tgl_selesai =	$this->input->post('thn_selesai').'-'.$this->input->post('bln_selesai').'-'.$this->input->post('tgl_selesai');
					
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
				redirect('agenda/add');
			}
			else
			{
				$this->load->view('template', $data);
			}	
		}
		else
		{
			redirect('users');
		}
	}


	/**
	 * Berpindah ke form untuk update data agenda
	 */
	function update($id_agenda)
	{
		if($this->session->userdata('login') == TRUE)
		{
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Agenda > Update Data';
			$data['main_view'] 		= 'agenda/agenda_form';
			$data['form_action']	= site_url('agenda/update_process');
			$data['link'] 			= array('link_back' => anchor('agenda/','kembali', array('class' => 'back'))
											);
			
			// cari data dari database
			$agenda = $this->Agenda_model->get_agenda_by_id($id_agenda)->row();
			
			// buat session untuk menyimpan data primary key (id_absen)
			$this->session->set_userdata('id_agenda', $agenda->id_agenda);
			
			// Data untuk mengisi field2 form
			$data['default']['tema'] = $agenda->tema;
			$data['default']['isi_agenda'] = $agenda->isi_agenda;		
			$data['default']['waktu'] = $agenda->waktu;
			$data['default']['tempat'] = $agenda->tempat;
			$data['default']['pengirim'] = $agenda->pengirim;	
			
			$data['tgl_mulai'] = substr($agenda->tgl_mulai, 8, 2);
			$data['bln_mulai'] = substr($agenda->tgl_mulai, 5, 2);
			$data['thn_mulai'] = substr($agenda->tgl_mulai, 0, 4);

			$data['tgl_selesai'] = substr($agenda->tgl_selesai, 8, 2);
			$data['bln_selesai'] = substr($agenda->tgl_selesai, 5, 2);
			$data['thn_selesai'] = substr($agenda->tgl_selesai, 0, 4);			
						
			$this->load->view('template', $data);
		}
		else
		{
			redirect('agenda');
		}
	}

	/**
	 * Proses untuk update data agenda
	 */
	function update_process()
	{
		if($this->session->userdata('login') == TRUE)
		{		
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Agenda > Tambah Data';
			$data['main_view'] 		= 'agenda/agenda_form';
			$data['form_action']	= site_url('agenda/update_process');
			$data['link'] 			= array('link_back' => anchor('agenda/','kembali', array('class' => 'back')));
			
			$data['tgl_mulai'] = $this->input->post('tgl_mulai');
			$data['bln_mulai'] = $this->input->post('bln_mulai');
			$data['thn_mulai'] = $this->input->post('thn_mulai');
	
			$data['tgl_selesai'] = $this->input->post('tgl_selesai');
			$data['bln_selesai'] = $this->input->post('bln_selesai');
			$data['thn_selesai'] = $this->input->post('thn_selesai');
						
			// Set validation rules
			$this->form_validation->set_rules('tema', 'Tema', 'trim|max_length[100]|required');
			$this->form_validation->set_rules('isi_agenda', 'Isi Agenda', 'trim|required');
			$this->form_validation->set_rules('tempat', 'Tempat', 'trim|max_length[100]|required');
			$this->form_validation->set_rules('waktu', 'Waktu', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|max_length[100]|required');
			
			if ($this->form_validation->run() == TRUE)
			{
							
				// Prepare data untuk disimpan di tabel
				$tgl = date('Y-m-d');	
				
				$tgl_mulai = $this->input->post('thn_mulai').'-'.$this->input->post('bln_mulai').'-'.$this->input->post('tgl_mulai');
				$tgl_selesai =	$this->input->post('thn_selesai').'-'.$this->input->post('bln_selesai').'-'.$this->input->post('tgl_selesai');
									
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
				redirect('agenda');
			}
			else
			{		
				$this->load->view('template', $data);
			}	
		}
		else
		{
			redirect('users');
		}
	}
			
	/**
	 * Menghapus data agenda
	 */
	function delete($id_agenda)
	{
		if($this->session->userdata('login') == TRUE)
		{		
			$this->Agenda_model->delete($id_agenda);
			$this->session->set_flashdata('message', '1 data agenda berhasil dihapus');
			
			redirect('agenda');
		}
		else
		{
			redirect('users');
		}
	}		
	

	function valid_tema($tema)
	{
		if ($this->Agenda_model->valid_entry($tema) == TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('valid_tema', "Tema sudah ada dalam database");
			return FALSE;
		}
	}
//----------------------------------------------------------------------------------------
	function detail($id_agenda)
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);
		$this->load->model('Agenda_model', '', TRUE);
		
		//$data['beritas'] = $this->Berita_model->get_berita_terbaru($limit, $offset)->result();
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$agenda = $this->Agenda_model->get_agenda_by_id($id_agenda);
		$data['agendas'] = $agenda->result();
		$row = $agenda->row();
		$data['title'] = $row->tema;
		$data['h2_title'] = $row->tema;
		$data['content'] = 'agenda_detail';
		$this->load->view('fronttemplate', $data);		
	}
	
	function listagenda()
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);

		$limit = 5;
		
		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);	
		
		// Load data dari tabel berita
		$agendas = $this->Agenda_model->get_last_ten_agenda($limit, $offset)->result();
		$num_rows = $this->Agenda_model->count_all_num_rows();
		
		if ($num_rows > 0) // Jika query menghasilkan data
		{
			// Membuat pagination			
			$config['base_url'] = site_url('agenda/listagenda');
			$config['total_rows'] = $num_rows;
			$config['per_page'] = $limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
		}
		
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['agendas'] = $agendas;
		
		$data['title'] = 'Daftar Agenda';
		$data['content'] = 'agenda_listagenda';
		$this->load->view('fronttemplate', $data);			
	
	}
}

/* End of file agenda.php */ 
/* Location: ./application/controllers/agenda.php */ 