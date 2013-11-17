<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Adminhome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	

	var $title = 'adminhome';
	
	function index()
	{
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_adminhome();
		}
		else
		{
			$this->load->view('adminhome/login_view');
		}
	}
	
	function get_adminhome()
	{
		if($this->session->userdata('login') == TRUE)
		{
			$data['title'] = $this->title;
			$data['h2_title'] = 'Welcome';
			$data['main_view'] = 'adminhome/adminhome';
			
			$this->load->view('template', $data);
		}
		else
		{
			redirect('users/index');
		}
	}	
}

/* End of file adminhome.php */ 
/* Location: ./application/controllers/adminhome.php */ 