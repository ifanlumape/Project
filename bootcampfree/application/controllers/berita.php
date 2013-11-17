<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Berita extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('berita/Berita_model', '', TRUE);
	}
	
	var $limit = 10;
	var $title = 'berita';
	
	function index()
	{
		$this->session->unset_userdata('id_berita');
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_last_ten_berita();
		}
		else
		{
			redirect('welcome');
		}
	}
	
	function get_last_ten_berita()
	{
		if($this->session->userdata('login') == TRUE)
		{
			$data['title'] = $this->title;
			$data['h2_title'] = 'Berita';
			$data['main_view'] = 'berita/berita';
			
			// Offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			// Load data dari tabel berita
			$beritas = $this->Berita_model->get_last_ten_berita($this->limit, $offset, $this->session->userdata('username'), $this->session->userdata('level'))->result();
			$berita = $this->Berita_model->get_last_ten_berita($this->limit, $offset, $this->session->userdata('username'), $this->session->userdata('level'));
			$num_rows = $berita->num_rows();
			
			if ($num_rows > 0) // Jika query menghasilkan data
			{
				// Membuat pagination			
				$config['base_url'] = site_url('berita/get_last_ten_berita');
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
				$this->table->set_heading('no', 'judul', 'tgl posting', 'tgl update', 'dibaca', 'Actions');
				
				// Penomoran baris data
				$i = 0 + $offset;
				
				foreach ($beritas as $berita)
				{
					// Konversi hari dan tanggal ke dalam format Indonesia
					$hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
					

					$hr3 = date('w', strtotime($berita->tgl_posting));
					$hr4 = date('w', strtotime($berita->tgl_update));
					$hari3 = $hari_array[$hr3];
					$hari4 = $hari_array[$hr4];
					$tgl3 = date('d-m-Y', strtotime($berita->tgl_posting));
					$tgl4 = date('d-m-Y', strtotime($berita->tgl_update));
					

					$hr_tgl3 = "$hari3, $tgl3";
					$hr_tgl4 = "$hari4, $tgl4";
					
					$this->table->add_row(++$i, $berita->judul, $hr_tgl3, $hr_tgl4, $berita->dibaca, anchor('berita/update/'.$berita->id_berita,'update',array('class' => 'update')).' '.anchor('berita/delete/'.$berita->id_berita,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
				}
				$data['table'] = $this->table->generate();
			}
			else
			{
				$data['message'] = 'Tidak ditemukan satupun data berita!';
			}		
			
			$data['link'] = array('link_add' => anchor('berita/add/','tambah data', array('class' => 'add')));
			
			// Load default view
			$this->load->view('template', $data);
		}
		else
		{
			redirect('berita/index');
		}
	}
	
	function add()
	{	
		if($this->session->userdata('login') == TRUE)
		{	
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Berita > Tambah Data';
			$data['main_view'] 		= 'berita/berita_form';
			$data['form_action']	= site_url('berita/add_process');
			$data['link'] 			= array('link_back' => anchor('berita/','kembali', array('class' => 'back')));
			
			$this->load->view('template', $data);
		}
		else
		{
			redirect('berita');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login') == TRUE)
		{		
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Berita > Tambah Data';
			$data['main_view'] 		= 'berita/berita_form';
			$data['form_action']	= site_url('berita/add_process');
			$data['link'] 			= array('link_back' => anchor('berita/','kembali', array('class' => 'back')));
			
			// Set validation rules
			$this->form_validation->set_rules('judul', 'Judul', 'trim|max_length[100]|required|callback_valid_berita');
			$this->form_validation->set_rules('kutipan', 'Kutipan', 'trim|required');
			$this->form_validation->set_rules('isi_berita', 'Isi Berita', 'trim|required');
	
			if ($this->form_validation->run() == TRUE)
			{
				$upload = $this->input->post('upload');
				if($upload == 1)
				{	
					$config = array(
							'allowed_types' => 'jpg|jpeg|gif',
							'upload_path' => realpath('./images/berita/'),
							'max_size' => 1024,
							'max_width' => 1024,
							'encrypt_name' => TRUE);
					
					$this->load->library('upload', $config);
					if( ! $this->upload->do_upload())
					{
						echo $this->upload->display_errors();	
					}
					else
					{
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');						redirect('berita/add');
					}
				}
				else
				{
	
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');					redirect('berita/add');										
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

	function update($id_berita)
	{
		if($this->session->userdata('login') == TRUE)
		{
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Berita > Update Data';
			$data['main_view'] 		= 'berita/berita_form';
			$data['form_action']	= site_url('berita/update_process');
			$data['link'] 			= array('link_back' => anchor('berita/','kembali', array('class' => 'back'))
											);
			
			// cari data dari database
			$berita = $this->Berita_model->get_berita_by_id($id_berita)->row();
			
			// buat session untuk menyimpan data primary key (id_absen)
			$this->session->set_userdata('id_berita', $berita->id_berita);
			
			// Data untuk mengisi field2 form
			$data['default']['judul'] = $berita->judul;
			$data['default']['kutipan'] = $berita->kutipan;
			$data['default']['isi_berita'] = $berita->isi_berita;		
			$data['default']['gambar'] = $berita->gambar;
			$data['default']['view_image'] = TRUE;
									
			$this->load->view('template', $data);
		}
		else
		{
			redirect('berita');
		}
	}

	function update_process()
	{
		if($this->session->userdata('login') == TRUE)
		{		
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Berita > Tambah Data';
			$data['main_view'] 		= 'berita/berita_form';
			$data['form_action']	= site_url('berita/update_process');
			$data['link'] 			= array('link_back' => anchor('berita/','kembali', array('class' => 'back')));
			
			// Set validation rules
			$this->form_validation->set_rules('judul', 'Judul', 'trim|max_length[100]|required|callback_valid_judul');
			$this->form_validation->set_rules('kutipan', 'Kutipan', 'trim|required');
			$this->form_validation->set_rules('isi_berita', 'Isi Berita', 'trim|required');
								
			if ($this->form_validation->run() == TRUE)
			{
				$upload = $this->input->post('upload');
				if($upload == 1)
				{	
					$config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath('./images/berita/'),
							'max_size' => 1024,
							'max_width' => 1024,
							'encrypt_name' => TRUE);
					
					$this->load->library('upload', $config);
					if( ! $this->upload->do_upload())
					{
						echo $this->upload->display_errors();	
					}
					else
					{
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');						redirect('berita');
					}
				}
				else
				{
	
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');					redirect('berita');										
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
			
	function delete($id_berita)
	{
		if($this->session->userdata('login') == TRUE)
		{		
			$data = $this->Berita_model->get_image_by_id($id_berita)->row();
		
			@unlink(trim(realpath('./images/berita/'.$data->gambar)));
			@unlink(trim(realpath('./images/berita/thumbs/'.$data->gambar)));		
			$this->Berita_model->delete($id_berita);
			$this->session->set_flashdata('message', '1 data berita berhasil dihapus');
			
			redirect('berita');
		}
		else
		{
			redirect('users');
		}
	}		
	

	function valid_berita($berita)
	{
		if ($this->Berita_model->valid_entry($berita) == TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('valid_berita', "berita sudah ada dalam database");
			return FALSE;
		}
	}
	
	//----------------------------------------------------------------------------------
	function detail($id_berita)
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);
		$this->load->model('Album_model', '', TRUE);	
		
		$data['beritas'] = $this->Berita_model->get_berita_by_id($id_berita)->result();
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['albums'] = $this->Album_model->get_album_terbaru()->result();
		$data['title'] = 'Selamat datang';
		$data['content'] = 'berita_detail';
		$this->load->view('fronttemplate', $data);			
	}
	
	function listberita()
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);

		$limit = 5;
		
		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);	
		
		// Load data dari tabel berita
		$beritas = $this->Berita_model->get_last_ten_berita2($limit, $offset)->result();
		$num_rows = $this->Berita_model->count_all_num_rows();
		
		if ($num_rows > 0) // Jika query menghasilkan data
		{
			// Membuat pagination			
			$config['base_url'] = site_url('berita/listberita');
			$config['total_rows'] = $num_rows;
			$config['per_page'] = $limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
		}
		
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['beritas'] = $beritas;
		
		$data['title'] = 'Daftar Berita';
		$data['content'] = 'berita_listberita';
		$this->load->view('fronttemplate', $data);			
	}
	
	function hasil_pencarian()
	{
		
	}
}

/* End of file berita.php */ 
/* Location: ./application/controllers/berita.php */ 