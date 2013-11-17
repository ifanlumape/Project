<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->home();
	}
	
	function home()
	{
		$this->load->model('berita/Berita_model', '', TRUE);		
		$this->load->model('banner/Banner_model', '', TRUE);
		$this->load->model('Album_model', '', TRUE);
		$limit = 5;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);		
		
		$data['beritas'] = $this->Berita_model->get_berita_terbaru($limit, $offset)->result();
		$data['populars'] = $this->Berita_model->get_berita_populer()->result();
		$data['recents'] = $this->Berita_model->get_berita_terakhir()->result();
		$data['tags'] = $this->Banner_model->get_banner_terbaru()->result();
		$data['albums'] = $this->Album_model->get_album_terbaru()->result();
		$data['title'] = 'Selamat datang';
		$data['content'] = 'welcome_home';
		$this->load->view('fronttemplate', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */