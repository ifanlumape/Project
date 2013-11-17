<?php 
class Halaman_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	var $table = 'halaman';
	
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	function get_last_ten_halaman($limit, $offset)
	{

		$this->db->order_by('id_halaman', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	function delete($id_halaman)
	{
		$this->db->where('id_halaman', $id_halaman);
		$this->db->delete($this->table);
	}
	
	function add($halaman)
	{
		$this->db->insert($this->table, $halaman);
	}
	
	function get_halaman_by_id($id_halaman)
	{
		$this->db->where('id_halaman', $id_halaman);
		return $this->db->get($this->table);
	}
	

	function get_halaman()
	{
		
		return $this->db->get($this->table);
	}
	
	function get_judul_halaman_by_id($id_halaman)
	{
		$this->db->select('id_halaman, judul');
		$this->db->where('id_halaman', $id_halaman);
		return $this->db->get($this->table);
	}

	function get_image_by_id($id_halaman)
	{
		$this->db->select('id_halaman, gambar');
		$this->db->where('id_halaman', $id_halaman);
		return $this->db->get($this->table);
	}

	function update($id_halaman, $halaman)
	{
		$this->db->where('id_halaman', $id_halaman);
		$this->db->update($this->table, $halaman);
	}
	
	function valid_entry($judul)
	{
		$this->db->where('judul', $judul);
		$query = $this->db->get($this->table)->num_rows();
						
		if($query > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}	
}
// END halaman_model Class

/* End of file halaman_model.php */
/* Location: ./application/models/halaman_model.php */