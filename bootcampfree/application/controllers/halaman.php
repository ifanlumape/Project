<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Halaman extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('halaman/Halaman_model', '', TRUE);
	}
	
	var $limit = 10;
	var $title = 'halaman';
	
	/**
	 * Memeriksa user state, jika dalam keadaan login akan menampilkan halaman absen,
	 * jika tidak akan meload halaman login
	 */
	function index()
	{
		$this->session->unset_userdata('id_halaman');
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_last_ten_halaman();
		}
		else
		{
			redirect('welcome');
		}
	}
	
	function get_last_ten_halaman()
	{
		if($this->session->userdata('login') == TRUE)
		{
			$data['title'] = $this->title;
			$data['h2_title'] = 'Halaman';
			$data['main_view'] = 'halaman/halaman';
			
			// Offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			// Load data dari tabel halaman
			$halamans = $this->Halaman_model->get_last_ten_halaman($this->limit, $offset)->result();
			$num_rows = $this->Halaman_model->count_all_num_rows();
			
			if ($num_rows > 0) // Jika query menghasilkan data
			{
				// Membuat pagination			
				$config['base_url'] = site_url('halaman/get_last_ten_halaman');
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
				$this->table->set_heading('no', 'judul', 'tgl posting', 'tgl update', 'Actions');
				
				// Penomoran baris data
				$i = 0 + $offset;
				
				foreach ($halamans as $halaman)
				{
					// Konversi hari dan tanggal ke dalam format Indonesia
					$hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
					

					$hr3 = date('w', strtotime($halaman->tgl_posting));
					$hr4 = date('w', strtotime($halaman->tgl_update));
					$hari3 = $hari_array[$hr3];
					$hari4 = $hari_array[$hr4];
					$tgl3 = date('d-m-Y', strtotime($halaman->tgl_posting));
					$tgl4 = date('d-m-Y', strtotime($halaman->tgl_update));
					

					$hr_tgl3 = "$hari3, $tgl3";
					$hr_tgl4 = "$hari4, $tgl4";
					
					$this->table->add_row(++$i, $halaman->judul, $hr_tgl3, $hr_tgl4, anchor('halaman/update/'.$halaman->id_halaman,'update',array('class' => 'update')).' '.anchor('halaman/delete/'.$halaman->id_halaman,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
				}
				$data['table'] = $this->table->generate();
			}
			else
			{
				$data['message'] = 'Tidak ditemukan satupun data halaman!';
			}		
			
			$data['link'] = array('link_add' => anchor('halaman/add/','tambah data', array('class' => 'add')));
			
			// Load default view
			$this->load->view('template', $data);
		}
		else
		{
			redirect('halaman/index');
		}
	}
	
	
	/**
	 * Berpindah ke form untuk entry data halaman baru
	 */
	function add()
	{	
		if($this->session->userdata('login') == TRUE)
		{	
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Halaman > Tambah Data';
			$data['main_view'] 		= 'halaman/halaman_form';
			$data['form_action']	= site_url('halaman/add_process');
			$data['link'] 			= array('link_back' => anchor('halaman/','kembali', array('class' => 'back')));
			
			$this->load->view('template', $data);
		}
		else
		{
			redirect('halaman');
		}
	}
	
	/**
	 * Proses untuk entry data halaman baru
	 */
	function add_process()
	{
		if($this->session->userdata('login') == TRUE)
		{		
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'halaman > Tambah Data';
			$data['main_view'] 		= 'halaman/halaman_form';
			$data['form_action']	= site_url('halaman/add_process');
			$data['link'] 			= array('link_back' => anchor('halaman/','kembali', array('class' => 'back')));
	
			
			// Set validation rules
			$this->form_validation->set_rules('judul', 'Judul', 'trim|max_length[100]|required|callback_valid_halaman');
			$this->form_validation->set_rules('isi_halaman', 'Isi halaman', 'trim|required');
	
			if ($this->form_validation->run() == TRUE)
			{
				$upload = $this->input->post('upload');
				if($upload == 1)
				{	
					$config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath('./images/halaman/'),
							'max_size' => 2048,
							'max_width' => 400,
							'encrypt_name' => TRUE);
					
					$this->load->library('upload', $config);
					if( ! $this->upload->do_upload())
					{
						echo $this->upload->display_errors();	
					}
					else
					{
						$tgl = date('Y-m-d');	
						$file = $this->upload->data();
						$nama_file = $file['file_name'];
						// Prepare data untuk disimpan di tabel
						$halaman = array('judul' => $this->input->post('judul'),
										'isi_halaman' => $this->input->post('isi_halaman'),
										'gambar' => $nama_file,
										'tgl_posting' => $tgl,
										'tgl_update' => $tgl);
						
						$config = array(
							'source_image' => $file['full_path'],
							'new_image' => './images/halaman/thumbs',
							'maintain_ration' => TRUE,
							'width' => 100,
							'height' => 75);
							
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();	
											
						// Proses simpan data halaman
						$this->Halaman_model->add($halaman);
						
						$this->session->set_flashdata('message', 'Satu data halaman berhasil disimpan!');
						redirect('halaman/add');
					}
				}
				else
				{
	
					$tgl = date('Y-m-d');	
					// Prepare data untuk disimpan di tabel
					$halaman = array('judul' => $this->input->post('judul'),
									 'isi_halaman' => $this->input->post('isi_halaman'),
									 'tgl_posting' => $tgl,
									 'tgl_update' => $tgl
									);	
					// Proses simpan data halaman
					$this->Halaman_model->add($halaman);
					
					$this->session->set_flashdata('message', 'Satu data halaman berhasil disimpan!');
					redirect('halaman/add');										
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


	/**
	 * Berpindah ke form untuk update data halaman
	 */
	function update($id_halaman)
	{
		if($this->session->userdata('login') == TRUE)
		{
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Halaman > Update Data';
			$data['main_view'] 		= 'halaman/halaman_form';
			$data['form_action']	= site_url('halaman/update_process');
			$data['link'] 			= array('link_back' => anchor('halaman/','kembali', array('class' => 'back'))
											);
			
			// cari data dari database
			$halaman = $this->Halaman_model->get_Halaman_by_id($id_halaman)->row();
			
			// buat session untuk menyimpan data primary key (id_absen)
			$this->session->set_userdata('id_halaman', $halaman->id_halaman);
			
			// Data untuk mengisi field2 form
			$data['default']['judul'] = $halaman->judul;
			$data['default']['isi_halaman'] = $halaman->isi_halaman;		
			$data['default']['gambar'] = $halaman->gambar;
			$data['default']['view_image'] = TRUE;
									
			$this->load->view('template', $data);
		}
		else
		{
			redirect('halaman');
		}
	}

	/**
	 * Proses untuk update data halaman
	 */
	function update_process()
	{
		if($this->session->userdata('login') == TRUE)
		{		
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Halaman > Tambah Data';
			$data['main_view'] 		= 'halaman/halaman_form';
			$data['form_action']	= site_url('halaman/add_process');
			$data['link'] 			= array('link_back' => anchor('halaman/','kembali', array('class' => 'back')));
			
			// Set validation rules
			$this->form_validation->set_rules('judul', 'Judul', 'trim|max_length[100]|required');
			$this->form_validation->set_rules('isi_halaman', 'Isi halaman', 'trim|required');
								
			if ($this->form_validation->run() == TRUE)
			{
				$upload = $this->input->post('upload');
				if($upload == 1)
				{	
					$config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath('./images/halaman/'),
							'max_size' => 2048,
							'max_width' => 400,
							'encrypt_name' => TRUE);
					
					$this->load->library('upload', $config);
					if( ! $this->upload->do_upload())
					{
						echo $this->upload->display_errors();	
					}
					else
					{
						$tgl = date('Y-m-d');	
						$file = $this->upload->data();
						$nama_file = $file['file_name'];
					
						$data = $this->Halaman_model->get_image_by_id($this->session->userdata('id_halaman'))->row();
					
						@unlink(trim(realpath('./images/halaman/'.$data->gambar)));
						@unlink(trim(realpath('./images/halaman/thumbs/'.$data->gambar)));
										
						// Prepare data untuk disimpan di tabel
						$halaman = array('judul' => $this->input->post('judul'),
										'isi_halaman' => $this->input->post('isi_halaman'),
										'gambar' => $nama_file,
										'tgl_update' => $tgl
										);
						
						$config = array(
							'source_image' => $file['full_path'],
							'new_image' => './images/halaman/thumbs',
							'maintain_ration' => TRUE,
							'width' => 100,
							'height' => 75);
							
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();	
											
						// Proses simpan data halaman
						$this->Halaman_model->update($this->session->userdata('id_halaman'),$halaman);
						
						$this->session->set_flashdata('message', 'Satu data halaman berhasil disimpan!');
						redirect('halaman');
					}
				}
				else
				{
	
					$tgl = date('Y-m-d');	
	
					// Prepare data untuk disimpan di tabel
					$halaman = array('judul' => $this->input->post('judul'),
									'isi_halaman' => $this->input->post('isi_halaman'),
									'tgl_update' => $tgl
									);	
					// Proses simpan data halaman
					$this->Halaman_model->update($this->session->userdata('id_halaman'), $halaman);
					
					$this->session->set_flashdata('message', 'Satu data halaman berhasil disimpan!');
					redirect('halaman');										
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
			
	/**
	 * Menghapus data halaman
	 */
	function delete($id_halaman)
	{
		if($this->session->userdata('login') == TRUE)
		{		
			$data = $this->Halaman_model->get_image_by_id($id_halaman)->row();
		
			@unlink(trim(realpath('./images/halaman/'.$data->gambar)));
			@unlink(trim(realpath('./images/halaman/thumbs/'.$data->gambar)));		
			$this->Halaman_model->delete($id_halaman);
			$this->session->set_flashdata('message', '1 data halaman berhasil dihapus');
			
			redirect('halaman');
		}
		else
		{
			redirect('users');
		}
	}		
	

	function valid_halaman($halaman)
	{
		if ($this->Halaman_model->valid_entry($halaman) == TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('valid_halaman', "halaman sudah ada dalam database");
			return FALSE;
		}
	}
	
//------------------------------------------------------------------------------------------
	function detail($id_halaman)
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);
		$this->load->model('Album_model', '', TRUE);	
		
		$data['halamans'] = $this->Halaman_model->get_halaman_by_id($id_halaman)->result();
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['albums'] = $this->Album_model->get_album_terbaru()->result();
		$data['title'] = 'Profil';
		$data['content'] = 'halaman_detail';
		$this->load->view('fronttemplate', $data);	
	}	
	
	function profil()
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);
		$this->load->model('Album_model', '', TRUE);	
		
		$data['halamans'] = $this->Halaman_model->get_halaman()->result();
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['albums'] = $this->Album_model->get_album_terbaru()->result();
		$data['title'] = 'Profil';
		$data['content'] = 'halaman_profil';
		$this->load->view('fronttemplate', $data);			
	}
}

/* End of file halaman.php */ 
/* Location: ./application/controllers/halaman.php */ 