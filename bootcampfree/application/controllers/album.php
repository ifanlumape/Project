<?php
class Album extends CI_Controller
{
	function Album()
	{
	  parent::__construct();
	  $this->load->model('Album_model', '', TRUE);
	}
	
	var $limit = 10;
	var $title = 'album';
	
	function index()
	{
	  $this->session->unset_userdata('id_album');
	
	if ($this->session->userdata('login') == TRUE)
	{
	  $this->get_last_ten_album();
	}
	else
	{
	  redirect(base_url());
	}
	}
	
	function get_last_ten_album($offset = 0)
	{
	  $data = array('title' => $this->title, 'h2_title' => 'Album', 'main_view' => 'album/album');
	  $uri_segment= 3;
	  $offset= $this->uri->segment($uri_segment);
	  $albums= $this->Album_model->get_last_ten_album($this->limit, $offset)->result();
	  $num_rows= $this->Album_model->count_all_num_rows();
	
	if ($num_rows > 0)
	{
	  $config= array(
		  'base_url' => site_url('album/get_last_ten_album'), 
		  'total_rows'=> $num_rows, 
		  'per_page' => $this->limit, 
		  'uri_segment' => $uri_segment
	  );
	  $this->pagination->initialize($config);
	  $data['pagination']= $this->pagination->create_links();
	
	  $tmpl = array( 'table_open' => '<table border="0" cellpadding="0" cellspacing="0">', 'row_alt_start' => '<tr class="zebra">', 'row_alt_end' => '</tr>');
	
	  $this->table->set_template($tmpl);
	  $this->table->set_empty("&nbsp;");$this->table->set_heading('No','Jdl Album','Album Seo','Gbr Album','Aktif','Actions');
	$i = 0 + $offset;
	foreach ($albums as $album)
	{
	
	$this->table->add_row(++$i, $album->jdl_album,  $album->album_seo,  $album->gbr_album,  $album->aktif, anchor('album/update/'.$album->id_album, 'Update', array('class' => 'update')).' '.anchor('album/delete/'.$album->id_album, 'Delete', array('class' => 'delete', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')")));
	
	
	}
	$data['table'] = $this->table->generate();
	}
	else
	{
	  $data['message'] = 'Tidak ditemukan satupun data Album!';
	}
	
	$data['link'] = array(
	'link_add' => anchor('album/add/', 'Tambah Data', array('class' => 'add'))
	);
	$this->load->view('template', $data);
	}
	
	function delete($id_album)
	{
	if ($this->session->userdata('login') == TRUE)
	{
	  $this->Album_model->delete($id_album);
	  $this->session->set_flashdata('message', 'Data Album berhasil dihapus');
	  redirect('album');
	}
	else
	{
	  redirect('login');
	}
	}
	
	function add()
	{
	  if ($this->session->userdata('login') == TRUE)
	  {
		  $data = array(
		  'title'=> $this->title,
		  'h2_title'=> 'Album > Tambah data', 
		  'main_view'=> 'album/album_form', 
		  'form_action'=> site_url('album/add_process'), 
		  'link'=> array('link_back' => anchor('album/', 'Kembali', array('class' => 'back')))
		  ); 
	  
	  $this->load->view('template', $data);
	}
	else
	{
	  redirect('login');
	}
	}
	
	function add_process()
	{
	  if ($this->session->userdata('login') == TRUE)
	  {
		  $data = array(
		  'title'=> $this->title, 
		  'h2_title'=> 'Album > Tambah data', 
		  'main_view'=> 'album/album_form', 
		  'form_action'=> site_url('album/add_process'), 
		  'link'=> array('link_back' => anchor('album/', 'Kembali', array('class' => 'back'))));
		  $this->form_validation->set_rules('jdl_album', 'Jdl Album', 'trim|required|max_length[100]');
		  $this->form_validation->set_rules('album_seo', 'Album Seo', 'trim|required|max_length[100]');
		  $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required|max_length[1]');
			  
	if ($this->form_validation->run() == TRUE)
	{
		  $upload = $this->input->post('upload');
		  if($upload == 1)
		  {	
			  $config = array(
					  'allowed_types' => 'jpg|jpeg|gif',
					  'upload_path' => realpath('./images/album/'),
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
				  $file = $this->upload->data();
				  $nama_file = $file['file_name'];
										  
				  $config = array(
					  'source_image' => $file['full_path'],
					  'new_image' => './images/album/thumbs',
					  'maintain_ration' => TRUE,
					  'width' => 100,
					  'height' => 75);
					  
				  $this->load->library('image_lib', $config);
				  $this->image_lib->resize();	
		
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
				  redirect('album/add');
			  }
		  }
		  else
		  {
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
				  redirect('album/add');					
		  }
	}
	else
	{
	  $this->load->view('template', $data);
	} 
	}
	else
	{
	  redirect('login');
	} 
	}
	
	function update($id_album)
	{
	   if ($this->session->userdata('login') == TRUE)
	  {
		  $data = array(
		  'title'=> $this->title, 
		  'h2_title'=> 'Album > Tambah data', 
		  'main_view'=> 'album/album_form', 
		  'form_action'=> site_url('album/update_process'), 
		  'link'=> array('link_back' => anchor('album/', 'Kembali', array('class' => 'back'))));
	
		  $album = $this->Album_model->get_album_by_id($id_album)->row();
		  $this->session->set_userdata('id_album', $album->id_album);$data['default']['jdl_album']= $album->jdl_album;
			  $data['default']['album_seo']= $album->album_seo;
			  $data['default']['gbr_album']= $album->gbr_album;
			  $data['default']['aktif']= $album->aktif;
			  
		  $this->load->view('template', $data);
	}
	else
	{
	  redirect('login');
	} 
	}
	
	function update_process()
	{
	  if ($this->session->userdata('login') == TRUE)
	  {
		  $data = array(
		  'title'=> $this->title, 
		  'h2_title'=> 'Album > Tambah data', 
		  'main_view' 	=> 'album/album_form', 
		  'form_action'=> site_url('album/update_process'), 
		  'link' => array('link_back' => anchor('/', 'Kembali', array('class' => 'back')))); 
		  $this->form_validation->set_rules('jdl_album', 'Jdl Album', 'trim|required|max_length[100]');
		  $this->form_validation->set_rules('album_seo', 'Album Seo', 'trim|required|max_length[100]');
		  $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required|max_length[1]');
			  
		  if ($this->form_validation->run() == TRUE)
		  {
		  $upload = $this->input->post('upload');
		  if($upload == 1)
		  {	
			  $config = array(
					  'allowed_types' => 'jpg|jpeg|gif',
					  'upload_path' => realpath('./images/album/'),
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
				  $file = $this->upload->data();
				  $nama_file = $file['file_name'];
										  
				  $config = array(
					  'source_image' => $file['full_path'],
					  'new_image' => './images/album/thumbs',
					  'maintain_ration' => TRUE,
					  'width' => 100,
					  'height' => 75);
					  
				  $this->load->library('image_lib', $config);
				  $this->image_lib->resize();	
			  
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
				  redirect('album'); 
			  }
		  }
		  else
		  {
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
				  redirect('album'); 
			  
		  }
		  
		  } 
	  $this->load->view('template', $data); 
	}
	else
	{
	  redirect('login');
	} 
	}
		
	function detail($id_album)
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);
		$this->load->model('Album_model', '', TRUE);
		$this->load->model('Gallery_model', '', TRUE);	
		
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['gallerys'] = $this->Gallery_model->get_gallery_by_id_album($id_album)->result();
		$album = $this->Album_model->get_album_by_id($id_album)->row();
		$data['jdl_album'] = $album->jdl_album;
		$data['title'] = 'Selamat datang';
		$data['content'] = 'album_detail';
		$this->load->view('fronttemplate', $data);		
	}
	
	function listalbum()
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);

		$limit = 5;
		
		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);	
		
		// Load data dari tabel berita
		$albums = $this->Album_model->get_last_ten_album($limit, $offset)->result();
		$num_rows = $this->Album_model->count_all_num_rows();
		
		if ($num_rows > 0) // Jika query menghasilkan data
		{
			// Membuat pagination			
			$config['base_url'] = site_url('album/listalbum');
			$config['total_rows'] = $num_rows;
			$config['per_page'] = $limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
		}
		
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['albums'] = $albums;
		
		$data['title'] = 'Daftar Berita';
		$data['content'] = 'album_listalbum';
		$this->load->view('fronttemplate', $data);			
		
	}
}
// END Prodi Class
/* End of file album.php */
/* Location: ./sytem/application/controlers/album.php */		
