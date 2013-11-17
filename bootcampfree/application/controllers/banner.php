<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('banner/Banner_model', '', TRUE);
	}
	/**
	 * Inisialisasi variabel untuk $limit dan $title(untuk id element <body>)
	 */
	var $limit = 10;
	var $title = 'banner';
	
	/**
	 * Memeriksa user state, jika dalam keadaan login akan menampilkan halaman banner,
	 * jika tidak akan meredirect ke halaman login
	 */
	function index()
	{
		// Hapus data session yang digunakan pada proses update data banner
		$this->session->unset_userdata('id_banner');
			
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_last_ten_banner();
		}
		else
		{
			redirect('welcome');
		}
	}
	
	/**
	 * Menampilkan 10 data banner terkini
	 */
	function get_last_ten_banner($offset = 0)
	{
		if($this->session->userdata('login') == TRUE)
		{
			$data['title'] = $this->title;
			$data['h2_title'] = 'Banner';
			$data['main_view'] = 'banner/banner';
			
			// Offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			// Load data dari tabel banner
			$banners = $this->Banner_model->get_last_ten_banner($this->limit, $offset)->result();
			$num_rows = $this->Banner_model->count_all_num_rows();
			
			if ($num_rows > 0) // Jika query menghasilkan data
			{
				// Membuat pagination			
				$config['base_url'] = site_url('banner/get_last_ten_banner');
				$config['total_rows'] = $num_rows;
				$config['per_page'] = $this->limit;
				$config['uri_segment'] = $uri_segment;
				$this->pagination->initialize($config);
				$data['pagination'] = $this->pagination->create_links();
				
				// Set template tabel, untuk efek selang-seling tiap baris
				$tmpl = array( 
				'table_open' => '<table border="0" cellpadding="0" cellspacing="0">',
				'row_alt_start' => '<tr class="zebra">',
				'row_alt_end' => '</tr>');
				$this->table->set_template($tmpl);
	
				// Set heading untuk tabel
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('No', 'Judul', 'URL', 'Tgl. Posting', 'Tgl. Update', 'Actions');
				
				// Penomoran baris data
				$i = 0 + $offset;
				
				foreach ($banners as $banner)
				{
					// Konversi hari dan tanggal ke dalam format Indonesia
					$hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
					$hr1 = date('w', strtotime($banner->tgl_posting));
					$hr2 = date('w', strtotime($banner->tgl_update));
					$hari1 = $hari_array[$hr1];
					$hari2 = $hari_array[$hr2];
					$tgl1 = date('d-m-Y', strtotime($banner->tgl_posting));
					$tgl2 = date('d-m-Y', strtotime($banner->tgl_update));
					$hr_tgl1 = "$hari1, $tgl1";
					$hr_tgl2 = "$hari2, $tgl2";
					
					// Penyusunan data baris per baris, perhatikan pembuatan link untuk updat dan delete
					$this->table->add_row(++$i, $banner->judul, $banner->url, $hr_tgl1, $hr_tgl2,
											anchor('banner/update/'.$banner->id_banner,'update',array('class' => 'update')).' '.
											anchor('banner/delete/'.$banner->id_banner,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
				}
				$data['table'] = $this->table->generate();
			}
			else
			{
				$data['message'] = 'Tidak ditemukan satupun data banner!';
			}		
			
			$data['link'] = array('link_add' => anchor('banner/add/','tambah data', array('class' => 'add')));
			
			// Load default view
			$this->load->view('template', $data);
		}
		else
		{
			redirect('users');
		}
	}
	
	/**
	 * Menghapus data banner
	 */
	function delete($id_banner)
	{
		$data 	= $this->Banner_model->get_image_by_id($id_banner)->row();
		
		@unlink(trim(realpath('./images/banner/'.$data->gambar)));
		
		$this->Banner_model->delete($id_banner);
		$this->session->set_flashdata('message', '1 data banner berhasil dihapus');
		
		redirect('banner');
	}
	
	/**
	 * Berpindah ke form untuk entry data bannersi baru
	 */
	function add()
	{
		if($this->session->userdata('login') == TRUE)
		{		
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Banner > Tambah Data';
			$data['main_view'] 		= 'banner/banner_form';
			$data['form_action']	= site_url('banner/add_process');
			$data['link'] 			= array('link_back' => anchor('banner/','kembali', array('class' => 'back')));
			$this->load->view('template', $data);
		}
		else
		{
			redirect('users');
		}
	}
	
	/**
	 * Proses untuk entry data bannersi baru
	 */
	function add_process()
	{
		
		// Inisialisasi data umum
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Banner > Tambah Data';
		$data['main_view'] 		= 'banner/banner_form';
		$data['form_action']	= site_url('banner/add_process');
		$data['link'] 			= array('link_back' => anchor('banner/','kembali', array('class' => 'back')));
		
		// Set validation rules
		$this->form_validation->set_rules('judul', 'Judul', 'trim|max_length[100]|callback_valid_judul|required');
		$this->form_validation->set_rules('url', 'URL', 'trim|max_length[100]|required|prep_url');
		
		if ($this->form_validation->run() == TRUE)
		{
			
			$upload = $this->input->post('upload');
			
			if($upload == 1)
			{
				$config = array(
						'allowed_types' => 'jpg|jpeg|gif|png',
						'upload_path' => realpath('./images/banner/'),
						'max_size' => 1024,
						'max_width' => 535,
						'encrypt_name' => TRUE);
				
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload())
				{
					echo $this->upload->display_errors();
				}
				else
				{
					
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
					redirect('banner/add');				
				}
			}
			else
			{
				
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
				redirect('banner/add');
			}
		}
		else
		{		
			$this->load->view('template', $data);
		}		
	}
	
	/**
	 * Berpindah ke form untuk update data bannersi
	 */
	function update($id_banner)
	{
		if($this->session->userdata('login') == TRUE)
		{
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Banner > Update Data';
			$data['main_view'] 		= 'banner/banner_form';
			$data['form_action']	= site_url('banner/update_process');
			$data['link'] 			= array('link_back' => anchor('banner/','kembali', array('class' => 'back'))
											);
			
			// cari data dari database
			$banner = $this->Banner_model->get_banner_by_id($id_banner)->row();
			
			// buat session untuk menyimpan data primary key (id_banner)
			$this->session->set_userdata('id_banner', $banner->id_banner);
			
			// Data untuk mengisi field2 form
			$data['default']['judul'] 	= $banner->judul;
			$data['default']['url'] 	= $banner->url;		
			$data['default']['gambar'] 	= $banner->gambar;
			$data['default']['view_image'] = TRUE;	
			
			$this->load->view('template', $data);
		}
		else
		{
			redirect('users');
		}
	}
	
	/**
	 * Proses untuk update data bannersi
	 */
	function update_process()
	{
		// Inisialisasi data umum
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Banner > Update Data';
		$data['main_view'] 		= 'banner/banner_form';
		$data['form_action']	= site_url('banner/update_process');
		$data['link'] 			= array('link_back' => anchor('banner/','kembali', array('class' => 'back')));
			
		// Set validation rules
		$this->form_validation->set_rules('judul', 'Judul', 'trim|max_length[100]|required');
		$this->form_validation->set_rules('url', 'URL', 'trim|required|max_length[100]|prep_url');
		
		// jika proses validasi sukses, maka lanjut update banner
		if ($this->form_validation->run() == TRUE)
		{
			$upload = $this->input->post('upload');
			
			if($upload == 1)
			{
						
				$config = array('allowed_types' => 'jpg|jpeg|gif|png',
								'upload_path' => realpath('./images/banner/'),
								'max_size' => 1024,
								'max_width' => 535,
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
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
					
					redirect('banner');
				}
			}
			else
			{
				$tgl_sekarang = date('Y-m-d');
				
				// Simpan data
				$banner = array('judul' 	 => $this->input->post('judul'),
								'url'		 => $this->input->post('url'),
								'tgl_update' => $tgl_sekarang);
								
				$this->Banner_model->update($this->session->userdata('id_banner'), $banner);
				
				// set pesan
				$this->session->set_flashdata('message', 'Satu data banner berhasil diupdate!');
				
				redirect('banner');			
			}
		}
		else
		{		
			$this->load->view('template', $data);
		}
	}
	
	/**
	 * Cek agar tidak terjadi siswa dengan NIS yang sama diabsen 2 kali
	 */
	function valid_judul()
	{
		$judul	= $this->input->post('judul');
	
		if($this->Banner_model->valid_entry($judul) == FALSE)
		{
			$this->form_validation->set_message('valid_judul', 'Judul banner sudah ada!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}	
}
// END banner Class

/* End of file banner.php */
/* Location: ./system/application/controllers/banner.php */