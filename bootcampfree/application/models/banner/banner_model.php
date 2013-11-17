<?php 
class Banner_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	var $table = 'banner';
	
	/**
	 * Menghitung jumlah baris dalam sebuah tabel, ada kaitannya dengan pagination
	 */
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	/**
	 * Tampilkan 10 baris banner terkini, diurutkan berdasarkan tanggal (Descending)
	 */
	function get_last_ten_banner($limit, $offset)
	{

		$this->db->order_by('id_banner', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	/**
	 * Menghapus sebuah entry data banner
	 */
	function delete($id_banner)
	{
		$this->db->where('id_banner', $id_banner);
		$this->db->delete($this->table);
	}
	
	/**
	 * Menambahkan sebuah data ke tabel banner
	 */
	function add($banner)
	{
		$this->db->insert($this->table, $banner);
	}
	
	/**
	 * Dapatkan data banner dengan id_banner tertentu, untuk proses update
	 */
	function get_banner_by_id($id_banner)
	{
		$this->db->where('id_banner', $id_banner);
		return $this->db->get($this->table);
	}
	
	
	function get_banner_terbaru()
	{
		$this->db->order_by('id_banner', 'desc');
		return $this->db->get($this->table);
	}
	
	function get_image_by_id($id_banner)
	{
		$this->db->select('id_banner, gambar');
		$this->db->where('id_banner', $id_banner);
		return $this->db->get($this->table);
	}
	/**
	 * Update data banner
	 */
	function update($id_banner, $banner)
	{
		$this->db->where('id_banner', $id_banner);
		$this->db->update($this->table, $banner);
	}
	
	/**
	 * Cek apakah ada entry data yang sama pada tanggal tertentu untuk siswa dengan NIS tertentu pula
	 */
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
// END banner_model Class

/* End of file banner_model.php */
/* Location: ./application/models/banner_model.php */