<?php 
class Hubungi_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	var $table = 'hubungi';
	
	/**
	 * Menghitung jumlah baris dalam sebuah tabel, ada kaitannya dengan pagination
	 */
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	/**
	 * Tampilkan 10 baris hubungi terkini, diurutkan berdasarkan tanggal (Descending)
	 */
	function get_last_ten_hubungi($limit, $offset)
	{
		$this->db->order_by('id_hubungi', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	/**
	 * Menghapus sebuah entry data hubungi
	 */
	function delete($id_hubungi)
	{
		$this->db->where('id_hubungi', $id_hubungi);
		$this->db->delete($this->table);
	}
	
	
	/**
	 * Dapatkan data hubungi dengan id_hubungi tertentu, untuk proses update
	 */
	function get_hubungi_by_id($id_hubungi)
	{
		$this->db->where('id_hubungi', $id_hubungi);
		return $this->db->get($this->table);
	}
	

	/**
	 * Update data hubungi
	 */
	function update($id_hubungi, $hubungi)
	{
		$this->db->where('id_hubungi', $id_hubungi);
		$this->db->update($this->table, $hubungi);
	}
	
	function add($hubungi)
	{
		$this->db->insert($this->table, $hubungi);
	}		
}
// END hubungi_model Class

/* End of file hubungi_model.php */
/* Location: ./application/models/hubungi_model.php */