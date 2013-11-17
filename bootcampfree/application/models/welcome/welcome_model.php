<?php 
class Welcome_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_sambutan()
	{
		$this->db->where('id_halaman', '17');
		return $this->db->get('halaman');
	}
}
// END welcome_model Class

/* End of file welcome_model.php */
/* Location: ./application/models/welcome_model.php */