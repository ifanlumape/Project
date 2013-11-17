<?php
class Download extends CI_Controller
{
	function Download()
	{
	  parent::__construct();
	  $this->load->model('Download_model', '', TRUE);
	}
	
	var $limit = 10;
	var $title = 'download';
	
	function index()
	{
	  $this->session->unset_userdata('id_download');
	
	if ($this->session->userdata('login') == TRUE)
	{
	  $this->get_last_ten_download();
	}
	else
	{
	  redirect(base_url());
	}
	}
	
	function get_last_ten_download($offset = 0)
	{
	  $data = array(
	  'title' => $this->title, 
	  'h2_title' => 'Download', 
	  'main_view' => 'download/download'
	  );
	  
	  $uri_segment= 3;
	  $offset= $this->uri->segment($uri_segment);
	  $downloads= $this->Download_model->get_last_ten_download($this->limit, $offset)->result();
	  $num_rows= $this->Download_model->count_all_num_rows();
	
	if ($num_rows > 0)
	{
	  $config= array(
		  'base_url' => site_url('download/get_last_ten_download'), 
		  'total_rows'=> $num_rows, 
		  'per_page' => $this->limit, 
		  'uri_segment' => $uri_segment
	  );
	  $this->pagination->initialize($config);
	  $data['pagination']= $this->pagination->create_links();
	
	  $tmpl = array( 'table_open' => '<table border="0" cellpadding="0" cellspacing="0">', 'row_alt_start' => '<tr class="zebra">', 'row_alt_end' => '</tr>');
	
	  $this->table->set_template($tmpl);
	  $this->table->set_empty("&nbsp;");$this->table->set_heading('No','Judul','Nama File','Tgl Posting','Hits','Actions');
	  $i = 0 + $offset;
	  foreach ($downloads as $download)
	  {
		$this->table->add_row(++$i, $download->judul,  $download->nama_file,  $download->tgl_posting,  $download->hits, anchor('download/update/'.$download->id_download, 'Update', array('class' => 'update')).' '.anchor('download/delete/'.$download->id_download, 'Delete', array('class' => 'delete', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')")));
	  }
	  $data['table'] = $this->table->generate();
	}
	else
	{
	  $data['message'] = 'Tidak ditemukan satupun data Download!';
	}
	
	$data['link'] = array(
		'link_add' => anchor('download/add/', 'Tambah Data', array('class' => 'add'))
	);
	$this->load->view('template', $data);
	}
	
	function delete($id_download)
	{
	if ($this->session->userdata('login') == TRUE)
	{
	  $this->Download_model->delete($id_download);
	  $this->session->set_flashdata('message', 'Data Download berhasil dihapus');
	  redirect('download');
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
		  'h2_title'=> 'Download > Tambah data', 
		  'main_view'=> 'download/download_form', 
		  'form_action'=> site_url('download/add_process'), 
		  'link'=> array('link_back' => anchor('download/', 'Kembali', array('class' => 'back')))
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
		  'h2_title'=> 'Download > Tambah data', 
		  'main_view'=> 'download/download_form', 
		  'form_action'=> site_url('download/add_process'), 
		  'link'=> array('link_back' => anchor('download/', 'Kembali', array('class' => 'back')))
		  );
	
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|max_length[100]');
			  
	if ($this->form_validation->run() == TRUE)
	{
		  $upload = $this->input->post('upload');
		  if($upload == 1)
		  {	
			  $config = array(
					  'allowed_types' => 'zip|pdf|ppt|gtar|gz|tar|tgz|gif|jpeg|jpg|jpe|png|doc|docx|xlsx|word|xl',
					  'upload_path' => realpath('./files/'),
					  'max_size' => 1024,
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
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');				  redirect('download/add');
			  }
		  }
		  else
		  {
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');				  redirect('download/add');			  
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
	
	function update($id_download)
	{
	   if ($this->session->userdata('login') == TRUE)
	  {
		  $data = array(
		  'title'=> $this->title, 
		  'h2_title'=> 'Download > Tambah data', 
		  'main_view'=> 'download/download_form', 
		  'form_action'=> site_url('download/update_process'), 
		  'link'=> array('link_back' => anchor('download/', 'Kembali', array('class' => 'back'))));
	
		  $download = $this->Download_model->get_download_by_id($id_download)->row();
		  $this->session->set_userdata('id_download', $download->id_download);
		  
		  $data['default']['judul']= $download->judul;
		  $data['default']['nama_file']= $download->nama_file;
			  
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
		  'h2_title'=> 'Download > Tambah data', 
		  'main_view' 	=> 'download/download_form', 
		  'form_action'=> site_url('download/update_process'), 
		  'link' => array('link_back' => anchor('/', 'Kembali', array('class' => 'back')))); 
		  
		  $this->form_validation->set_rules('judul', 'Judul', 'trim|required|max_length[100]');
			  
		  if ($this->form_validation->run() == TRUE)
		  {
		  $upload = $this->input->post('upload');
		  if($upload == 1)
		  {	
			  $config = array(
					  'allowed_types' => 'zip|pdf|ppt|gtar|gz|tar|tgz|gif|jpeg|jpg|jpe|png|doc|docx|xlsx|word|xl',
					  'upload_path' => realpath('./files/'),
					  'max_size' => 1024,
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
				  redirect('download'); 
			  }
		  }
		  else
		  {
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
				  redirect('download'); 			  
		  }
		  
		  } 
	  $this->load->view('template', $data); 
	}
	else
	{
	  redirect('login');
	} 
	}

	function listdownload()
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);

		$limit = 25;
		
		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);	
		
		// Load data dari tabel berita
		$downloads = $this->Download_model->get_last_ten_download($limit, $offset)->result();
		$num_rows = $this->Download_model->count_all_num_rows();
		
		if ($num_rows > 0) // Jika query menghasilkan data
		{
			// Membuat pagination			
			$config['base_url'] = site_url('download/listdownload');
			$config['total_rows'] = $num_rows;
			$config['per_page'] = $limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
		}
		
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['downloads'] = $downloads;
		
		$data['title'] = 'Daftar Download';
		$data['content'] = 'download_listdownload';
		$this->load->view('fronttemplate', $data);			
		
	}
	
	function downloadfile($id_file)
	{
		$this->load->helper('download');
		$donwload = $this->Download_model->get_download_by_id($id_file)->row();	
		$name = $donwload->nama_file;
		$data = file_get_contents("./files/".$name); 
		force_download($name, $data);
	}
}
	// END Prodi Class
	/* End of file download.php */
	/* Location: ./sytem/application/controlers/download.php */		
  