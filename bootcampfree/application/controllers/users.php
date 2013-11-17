<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('users/Users_model', '', TRUE);
	}
	
	var $limit = 10;
	var $title = 'users';
	
	/**
	 * Memeriksa user state, jika dalam keadaan login akan menampilkan halaman absen,
	 * jika tidak akan meload halaman login
	 */
	function index()
	{
		$this->session->unset_userdata('id_users');
		$this->session->unset_userdata('update');
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_last_ten_users();
		}
		else
		{
			$this->load->view('users/login_view');
		}
	}
	
	function get_last_ten_users()
	{
		if($this->session->userdata('login') == TRUE)
		{
			$data['title'] = $this->title;
			$data['h2_title'] = 'Users';
			$data['main_view'] = 'users/users';
			
			// Offset
			$uri_segment = 3;
			$offset = $this->uri->segment($uri_segment);
			
			// Load data dari tabel users
			$users = $this->Users_model->get_last_ten_users($this->limit, $offset, $this->session->userdata('username'))->result();
			$num_rows = $this->Users_model->count_all_num_rows();
			
			if ($num_rows > 0) // Jika query menghasilkan data
			{
				// Membuat pagination			
				$config['base_url'] = site_url('users/get_last_ten_users');
				$config['total_rows'] = $num_rows;
				$config['per_page'] = $this->limit;
				$config['uri_segment'] = $uri_segment;
				$this->pagination->initialize($config);
				$data['pagination'] = $this->pagination->create_links();
				
				// Set template tabel, untuk efek selang-seling tiap baris
				$tmpl = array( 'table_open'    => '<table border="0" cellpadding="0" cellspacing="0">',
							  'row_alt_start'  => '<tr class="zebra">',
								'row_alt_end'    => '</tr>'
							  );
				$this->table->set_template($tmpl);
	
				// Set heading untuk tabel
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('No', 'Username', 'Nama Lengkap', 'Email',  'Telp.', 'Level', 'Blokir', 'Tgl. Reg', 'Tgl. Update', 'Actions');
				
				// Penomoran baris data
				$i = 0 + $offset;
				
				foreach ($users as $user)
				{
					// Konversi hari dan tanggal ke dalam format Indonesia
					$hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
					$hr1 = date('w', strtotime($user->tgl_regis));
					$hr2 = date('w', strtotime($user->tgl_update));
					$hari1 = $hari_array[$hr1];
					$hari2 = $hari_array[$hr2];
					$tgl1 = date('d-m-Y', strtotime($user->tgl_regis));
					$tgl2 = date('d-m-Y', strtotime($user->tgl_update));
					$hr_tgl1 = "$hari1, $tgl1";
					$hr_tgl2 = "$hari2, $tgl2";
					
					$this->table->add_row(++$i, $user->username, $user->nama_lengkap, $user->email, $user->no_telp, $user->level, $user->blokir, $hr_tgl1, $hr_tgl2,
											anchor('users/update/'.$user->username,'update',array('class' => 'update')).' '.
											anchor('users/delete/'.$user->username,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
										);
				}
				$data['table'] = $this->table->generate();
			}
			else
			{
				$data['message'] = 'Tidak ditemukan satupun data users!';
			}		
			
			$data['link'] = array('link_add' => anchor('users/add/','tambah data', array('class' => 'add')));
			
			// Load default view
			$this->load->view('template', $data);
		}
		else
		{
			redirect('users');
		}
	}
	
	
	/**
	 * Berpindah ke form untuk entry data users baru
	 */
	function add()
	{	
		if($this->session->userdata('login') == TRUE)
		{	
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Users > Tambah Data';
			$data['main_view'] 		= 'users/users_form';
			$data['form_action']	= site_url('users/add_process');
			$data['link'] 			= array('link_back' => anchor('users/','kembali', array('class' => 'back')));
			$this->load->view('template', $data);
		}
		else
		{
			redirect('users');
		}
	}
	
	/**
	 * Proses untuk entry data users baru
	 */
	function add_process()
	{
		if($this->session->userdata('login') == TRUE)
		{
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Users > Tambah Data';
			$data['main_view'] 		= 'users/users_form';
			$data['form_action']	= site_url('users/add_process');
			$data['link'] 			= array('link_back' => anchor('users/','kembali', array('class' => 'back')));
			
			// Set validation rules
			$this->form_validation->set_rules('username', 'Username', 'trim|max_length[50]|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|max_length[50]|required|md5');
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|max_length[100]|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');
			$this->form_validation->set_rules('no_telp', 'No Telp', 'trim|max_length[20]|required');
			$this->form_validation->set_rules('blokir', 'Blokir', 'required');
			
			if ($this->form_validation->run() == TRUE)
			{
							
				// Prepare data untuk disimpan di tabel
				$user = array('username' 	 => $this->input->post('username'),
							  'password'	 => $this->input->post('password'),
							  'nama_lengkap' => $this->input->post('nama_lengkap'),
							  'email' 		 => $this->input->post('email'),
							  'no_telp'		 => $this->input->post('no_telp'));
				// Proses simpan data users
				$this->Users_model->add($user);
				
				$this->session->set_flashdata('message', 'Satu data user berhasil disimpan!');
				redirect('users/add');
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
	 * Berpindah ke form untuk update data users
	 */
	function update($id_users)
	{
		if($this->session->userdata('login') == TRUE)
		{
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Users > Update Data';
			$data['main_view'] 		= 'users/users_form';
			$data['form_action']	= site_url('users/update_process');
			$data['link'] 			= array('link_back' => anchor('users/','kembali', array('class' => 'back'))
											);
			
			// cari data dari database
			$user = $this->Users_model->get_users_by_id($id_users)->row();
			
			// buat session untuk menyimpan data primary key (id_absen)
			$this->session->set_userdata('id_users', $user->username);
			
			// Data untuk mengisi field2 form
			$data['default']['username'] 	= $user->username;
			$data['default']['password'] 	= $user->password;		
			$data['default']['nama_lengkap']= $user->nama_lengkap;
			$data['default']['email'] 		= $user->email;
			$data['default']['no_telp']		= $user->no_telp;
			$data['default']['blokir']		= $user->blokir;
			$data['default']['update']		= TRUE;		
				
			$this->load->view('template', $data);
		}
		else
		{
			redirect('users');
		}
	}

	/**
	 * Proses untuk update data users
	 */
	function update_process()
	{
		if($this->session->userdata('login') == TRUE)
		{
			// Inisialisasi data umum
			$data['title'] 			= $this->title;
			$data['h2_title'] 		= 'Users > Tambah Data';
			$data['main_view'] 		= 'users/users_form';
			$data['form_action']	= site_url('users/update_process');
			$data['link'] 			= array('link_back' => anchor('users/','kembali', array('class' => 'back')));
			
			// Set validation rules
			$this->form_validation->set_rules('username', 'Username', 'trim|max_length[50]|required');
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|max_length[100]|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');
			$this->form_validation->set_rules('no_telp', 'No Telp', 'trim|max_length[20]|required');
			$this->form_validation->set_rules('blokir', 'Blokir', 'required');
			$data['default']['update']		= TRUE;	
			
			if ($this->form_validation->run() == TRUE)
			{
				if($this->input->post('password') != '')
				{			
					// Prepare data untuk disimpan di tabel
					$user = array('username' 	 => $this->input->post('username'),
								  'password'	 => $this->input->post('password'),
								  'nama_lengkap' => $this->input->post('nama_lengkap'),
								  'email' 		 => $this->input->post('email'),
								  'no_telp'		 => $this->input->post('no_telp'));
					// Proses simpan data absensi
					$this->Users_model->update($this->session->userdata('id_users'), $user);
					
					$this->session->set_flashdata('message', 'Satu data user berhasil diupdate!');
					redirect('users');
				}
				else
				{
					// Prepare data untuk disimpan di tabel
					$user = array('username' 	 => $this->input->post('username'),
								  'nama_lengkap' => $this->input->post('nama_lengkap'),
								  'email' 		 => $this->input->post('email'),
								  'no_telp'		 => $this->input->post('no_telp'));
					// Proses simpan data absensi
					$this->Users_model->update($this->session->userdata('id_users'), $user);
					
					$this->session->set_flashdata('message', 'Satu data user berhasil diupdate!');
					redirect('users');
				
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
	 * Menghapus data users
	 */
	function delete($id_users)
	{
		if($this->session->userdata('login') == TRUE)
		{		
			$this->Users_model->delete($id_users);
			$this->session->set_flashdata('message', '1 data users berhasil dihapus');
			
			redirect('users');
		}
		else
		{
			redirect('users');
		}
	}		
	
	/**
	 * Memproses login
	 */
	function process_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$data 	= $this->Users_model->get_level($this->input->post('username'), md5($this->input->post('password')));
			$row 	= $data->row();
			$level 	= $row->level;
			$username 	= $this->input->post('username');
			$password 	= md5($this->input->post('password'));
			
			if ($this->Users_model->check_user($username, $password) == TRUE)
			{
				$data = array('username' => $username, 'login' => TRUE, 'level' => $level);
				$this->session->set_userdata($data);
				redirect('adminhome');
			}
			else
			{
				$this->session->set_flashdata('message', 'Maaf, username dan atau password Anda salah');
				redirect('users/index');
			}
		}
		else
		{
			$this->load->view('users/login_view');
		}
	}
	
	/**
	 * Memproses logout
	 */
	function process_logout()
	{
		$this->session->sess_destroy();
		redirect('welcome', 'refresh');
	}
	
	function valid_username($username)
	{
		if ($this->Users_model->valid_entry($username) == TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('valid_username', "username sudah ada dalam database");
			return FALSE;
		}
	}	
	
}

/* End of file users.php */ 
/* Location: ./application/controllers/users.php */ 