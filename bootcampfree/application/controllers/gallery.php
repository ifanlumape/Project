<?php
class Gallery extends CI_Controller
{
	function Gallery()
	{
		parent::__construct();
		$this->load->model('Gallery_model', '', TRUE);
		$this->load->model('Album_model', '', TRUE);
	}
	
	var $limit = 10;
	var $title = 'gallery';
	
	function index()
	{
		$this->session->unset_userdata('id_gallery');
		
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_last_ten_gallery();
		}
		else
		{
			redirect(base_url());
		}
	}
	
	function get_last_ten_gallery($offset = 0)
	{
		$data = array(
		'title' => $this->title, 
		'h2_title' => 'Gallery', 
		'main_view' => 'gallery/gallery'
		);
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$gallerys= $this->Gallery_model->get_last_ten_gallery($this->limit, $offset)->result();
		$num_rows= $this->Gallery_model->count_all_num_rows();
		
		if ($num_rows > 0)
		{
			$config= array(
				'base_url' => site_url('gallery/get_last_ten_gallery'), 
				'total_rows'=> $num_rows, 
				'per_page' => $this->limit, 
				'uri_segment' => $uri_segment
			);
			$this->pagination->initialize($config);
			$data['pagination']= $this->pagination->create_links();
			
			$tmpl = array( 'table_open' => '<table border="0" cellpadding="0" cellspacing="0">', 'row_alt_start' => '<tr class="zebra">', 'row_alt_end' => '</tr>');
			
			$this->table->set_template($tmpl);
			$this->table->set_empty("&nbsp;");$this->table->set_heading('No','Id Album','Jdl Gallery','Gallery Seo','Keterangan','Gbr Gallery','Actions');
			$i = 0 + $offset;
			foreach ($gallerys as $gallery)
			{
				$album = $this->Album_model->get_album_by_id($gallery->id_album)->row();
				$this->table->add_row(++$i, $album->jdl_album,  $gallery->jdl_gallery,  $gallery->gallery_seo,  $gallery->keterangan,  $gallery->gbr_gallery, anchor('gallery/update/'.$gallery->id_gallery, 'Update', array('class' => 'update')).' '.anchor('gallery/delete/'.$gallery->id_gallery, 'Delete', array('class' => 'delete', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')")));
			}
			$data['table'] = $this->table->generate();
		}
		else
		{
			$data['message'] = 'Tidak ditemukan satupun data Gallery!';
		}
		
		$data['link'] = array(
			'link_add' => anchor('gallery/add/', 'Tambah Data', array('class' => 'add'))
		);
		$this->load->view('template', $data);
	}
	
	function delete($id_gallery)
	{
		if ($this->session->userdata('login') == TRUE)
		{
			$this->Gallery_model->delete($id_gallery);
			$this->session->set_flashdata('message', 'Data Gallery berhasil dihapus');
			redirect('gallery');
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
			'h2_title'=> 'Gallery > Tambah data', 
			'main_view'=> 'gallery/gallery_form', 
			'form_action'=> site_url('gallery/add_process'), 
			'link'=> array('link_back' => anchor('gallery/', 'Kembali', array('class' => 'back')))
			); 


			$album = $this->Album_model->get_album()->result();
			$data['options_album'][''] = '-- Pilih Album --';
			foreach($album as $row)
			{
				$data['options_album'][$row->id_album] = $row->jdl_album;	
			}
			
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
			'h2_title'=> 'Gallery > Tambah data', 
			'main_view'=> 'gallery/gallery_form', 
			'form_action'=> site_url('gallery/add_process'), 
			'link'=> array('link_back' => anchor('gallery/', 'Kembali', array('class' => 'back'))));

			$album = $this->Album_model->get_album()->result();
			$data['options_album'][''] = '-- Pilih Album --';
			foreach($album as $row)
			{
				$data['options_album'][$row->id_album] = $row->jdl_album;	
			}
					
			$this->form_validation->set_rules('id_album', 'Id Album', 'trim|required|max_length[5]');
			$this->form_validation->set_rules('jdl_gallery', 'Jdl Gallery', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('gallery_seo', 'Gallery Seo', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
				
			if ($this->form_validation->run() == TRUE)
			{
				$upload = $this->input->post('upload');
				if($upload == 1)
				{	
					$config = array(
							'allowed_types' => 'jpg|jpeg|gif',
							'upload_path' => realpath('./images/gallery/'),
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
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
					  redirect('gallery/add');
					}
				}
				else
				{
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
					  redirect('gallery/add');					
				}
			}

			$this->load->view('template', $data);
			 
		}
		else
		{
			redirect('login');
		} 
	}
	
	function update($id_gallery)
	{
		if ($this->session->userdata('login') == TRUE)
		{
			$data = array(
			'title'=> $this->title, 
			'h2_title'=> 'Gallery > Tambah data', 
			'main_view'=> 'gallery/gallery_form', 
			'form_action'=> site_url('gallery/update_process'), 
			'link'=> array('link_back' => anchor('gallery/', 'Kembali', array('class' => 'back'))));
		
			$gallery = $this->Gallery_model->get_gallery_by_id($id_gallery)->row();
			$this->session->set_userdata('id_gallery', $gallery->id_gallery);

			$album = $this->Album_model->get_album()->result();
			$data['options_album'][''] = '-- Pilih Album --';
			foreach($album as $row)
			{
				$data['options_album'][$row->id_album] = $row->jdl_album;	
			}
						
			$data['default']['id_album']= $gallery->id_album;
			$data['default']['jdl_gallery']= $gallery->jdl_gallery;
			$data['default']['gallery_seo']= $gallery->gallery_seo;
			$data['default']['keterangan']= $gallery->keterangan;
			$data['default']['gbr_gallery']= $gallery->gbr_gallery;
				
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
			'h2_title'=> 'Gallery > Tambah data', 
			'main_view' 	=> 'gallery/gallery_form', 
			'form_action'=> site_url('gallery/update_process'), 
			'link' => array('link_back' => anchor('/', 'Kembali', array('class' => 'back')))); 
			
			$this->form_validation->set_rules('id_album', 'Id Album', 'trim|required|max_length[5]');
			$this->form_validation->set_rules('jdl_gallery', 'Jdl Gallery', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('gallery_seo', 'Gallery Seo', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');


			$album = $this->Album_model->get_album()->result();
			$data['options_album'][''] = '-- Pilih Album --';
			foreach($album as $row)
			{
				$data['options_album'][$row->id_album] = $row->jdl_album;	
			}
							
			if ($this->form_validation->run() == TRUE)
			{
				$upload = $this->input->post('upload');
				if($upload == 1)
				{	
					$config = array(
							'allowed_types' => 'jpg|jpeg|gif',
							'upload_path' => realpath('./images/gallery/'),
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
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
						redirect('gallery'); 
					}
				}
				else
				{
				/** Bagian yang dihilangkan
				 *  Contact e-mail fnnight@gmail.com
				 */
				
				$this->session->set_flashdata('message', 'Baris skrip dihilangkan. kontak fnnight@gmail.com!');
					redirect('gallery'); 
					
				}
			} 
			$this->load->view('template', $data); 
		}
		else
		{
			redirect('login');
		} 
	}
}
// END Prodi Class
/* End of file gallery.php */
/* Location: ./sytem/application/controlers/gallery.php */		
