<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hubungi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('hubungi/Hubungi_model', '', TRUE);
	}
	
	var $limit = 10;
	var $title = 'hubungi';
	
	function index()
	{
		$this->session->unset_userdata('id_hubungi');
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_last_ten_hubungi();
		}
		else
		{
			redirect('welcome');
		}
	}
	
	function get_last_ten_hubungi()
	{
		if($this->session->userdata('login') == TRUE)
		{
			$data['title'] = $this->title;
			$data['h2_title'] = 'Hubungi';
			$data['main_view'] = 'hubungi/hubungi';
			
			// Offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			// Load data dari tabel hubungi
			$hubungis = $this->Hubungi_model->get_last_ten_hubungi($this->limit, $offset, $this->session->userdata('id_hubungi'))->result();
			$num_rows = $this->Hubungi_model->count_all_num_rows();
			
			if ($num_rows > 0) // Jika query menghasilkan data
			{
				// Membuat pagination			
				$config['base_url'] = site_url('hubungi/get_last_ten_hubungi');
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
				$this->table->set_heading('No', 'Nama', 'Email', 'Subjek',  'Tanggal',  'dibalas', 'Actions');
				
				// Penomoran baris data
				$i = 0 + $offset;
				
				foreach ($hubungis as $hubungi)
				{
					// Konversi hari dan tanggal ke dalam format Indonesia
					$hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
					$hr1 = date('w', strtotime($hubungi->tanggal));
					$hari1 = $hari_array[$hr1];
					$tgl1 = date('d-m-Y', strtotime($hubungi->tanggal));
					$hr_tgl1 = "$hari1, $tgl1";
					
					$this->table->add_row(++$i, $hubungi->nama, $hubungi->email, $hubungi->subjek, $hr_tgl1, $hubungi->dibalas, anchor('hubungi/reply/'.$hubungi->id_hubungi,'reply',array('class' => 'update')).' '.anchor('hubungi/delete/'.$hubungi->id_hubungi, 'Delete'));
				}
				$data['table'] = $this->table->generate();
			}
			else
			{
				$data['message'] = 'Tidak ditemukan satupun data hubungi!';
			}		
			
			//$data['link'] = array('link_add' => anchor('hubungi/add/','tambah data', array('class' => 'add')));
			
			// Load default view
			$this->load->view('template', $data);
		}
		else
		{
			redirect('hubungi/index');
		}
	}
	
	function reply($id_hubungi)
	{
		if($this->session->userdata('login') == TRUE)
		{
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Hubungi > Update Data';
			$data['main_view'] 		= 'hubungi/Hubungi_form';
			$data['form_action']	= site_url('hubungi/reply_process');
			$data['link'] 			= array('link_back' => anchor('hubungi/','kembali', array('class' => 'back'))
											);
			
			// cari data dari database
			$hubungi = $this->Hubungi_model->get_hubungi_by_id($id_hubungi)->row();
			
			// buat session untuk menyimpan data primary key (id_absen)
			$this->session->set_userdata('id_hubungi', $hubungi->id_hubungi);
			
			// Data untuk mengisi field2 form
			$data['default']['email'] = $hubungi->email;		
			$data['default']['subjek'] = $hubungi->subjek;
			$data['default']['pesan'] = $hubungi->pesan;
									
			$this->load->view('template', $data);
		}
		else
		{
			redirect('hubungi');
		}
	}

	function reply_process()
	{
		if($this->session->userdata('login') == TRUE)
		{		
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Hubungi > Tambah Data';
			$data['main_view'] 		= 'hubungi/Hubungi_form';
			$data['form_action']	= site_url('hubungi/reply_process');
			$data['link'] 			= array('link_back' => anchor('hubungi/','kembali', array('class' => 'back')));
						
			// Set validation rules
			$this->form_validation->set_rules('email', 'Email', 'trim|max_length[50]|required');
			$this->form_validation->set_rules('subjek', 'Subjek', 'trim|max_length[100]|required');
			$this->form_validation->set_rules('pesan', 'Pesan', 'trim|required');
			
			if ($this->form_validation->run() == TRUE)
			{
								
				$email_admin = 'info@localhost';				
				$email_member = $this->input->post('email');
								
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from($email_admin, 'GMIM Bukit Moria - Manado');
				$this->email->to($email_member);
				$this->email->subject($this->input->post('subjek'));
				$this->email->message($this->input->post('pesan'));
				
				if( ! $this->email->send())
				{
					echo $this->email->print_debugger();
				}
				else
				{
					
					// Prepare data untuk disimpan di tabel
					$hubungi = array('dibalas' => 'Y');
					// Proses simpan data absensi
					$this->Hubungi_model->update($this->session->userdata('id_hubungi'), $hubungi);				
					$this->session->set_flashdata('message', 'Satu contact telah dibalas!');
					redirect('hubungi');
				}
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
			
	function delete($id_hubungi)
	{
		if($this->session->userdata('login') == TRUE)
		{		
			$this->Hubungi_model->delete($id_hubungi);
			$this->session->set_flashdata('message', '1 data hubungi berhasil dihapus');
			
			redirect('hubungi');
		}
		else
		{
			redirect('users');
		}
	}

//-----------------------------------------------------------------------------------------
	function form()
	{
		$this->load->model('berita/Berita_model', '', TRUE);
		$this->load->model('agenda/Agenda_model', '', TRUE);
		$this->load->model('captcha/Captcha_model', '', TRUE);
		$this->load->model('banner/Banner_model', '', TRUE);
		$this->load->helper('html');
		
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['form_action'] = 'hubungi/proses_hubungi';
		$captcha = $this->Captcha_model->generate_captcha();
		$data_session = array('captcha_word' => $captcha['word']);
		$this->session->set_userdata($data_session);
		
		$data['captcha'] = $captcha;				
		$data['content'] = 'hubungi_form';
		$this->load->view('fronttemplate', $data);
	}
	
	function proses_hubungi()
	{
		$this->load->model('berita/Berita_model', '', TRUE);
		$this->load->model('agenda/Agenda_model', '', TRUE);
		$this->load->model('captcha/Captcha_model', '', TRUE);
		$this->load->model('banner/Banner_model', '', TRUE);
		$this->load->helper('html');
		
		$this->form_validation->set_rules('nama', 'nama', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|max_length[100]|valid_email');
		$this->form_validation->set_rules('subjek', 'subjek', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('pesan', 'pesan', 'trim|required');

		if($this->form_validation->run() == TRUE)
		{	
			$tgl = date('Y-m-d');
			$hubungi = array(
						'nama' => $this->input->post('nama', TRUE),
						'email'	 => $this->input->post('email', TRUE),
						'subjek' => $this->input->post('subjek', TRUE),
						'pesan' => $this->input->post('pesan', TRUE),
						'tanggal' => $tgl);
						
			// Proses simpan data jemaat
			$this->Hubungi_model->add($hubungi);
			
			$this->session->set_flashdata('message', 'Kontak anda telah berhasil dikirim');
			redirect('hubungi/form');
		}
		
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['form_action'] = 'hubungi/proses_hubungi';
		$captcha = $this->Captcha_model->generate_captcha();
		$data_session = array('captcha_word' => $captcha['word']);
		$this->session->set_userdata($data_session);
		
		$data['captcha'] = $captcha;				
		$data['content'] = 'hubungi_form';
		$this->load->view('fronttemplate', $data);
	}
}

/* End of file hubungi.php */ 
/* Location: ./application/controllers/hubungi.php */ 