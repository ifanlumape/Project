<?php
class Download_model extends CI_Model
{
	function Download_model()
	{
		parent::__construct();
	}
	
	var $table = 'download';
	
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	function get_last_ten_download($limit, $offset)
	{
		$this->db->order_by('id_download', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	function delete($id_download)
	{
		$this->db->where('id_download', $id_download);
		$this->db->delete($this->table);
	}
	
	function add($download)
	{
		$this->db->insert($this->table, $download);
	}
	
	function get_download()
	{
		$this->db->order_by('nama_download');
		return $this->db->get($this->table);
	}
	
	function get_download_by_id($id_download)
	{
		$this->db->where('id_download', $id_download);
		return $this->db->get($this->table);
	}
	
	function update($id_download, $download)
	{
		$this->db->where('id_download', $id_download);
		$this->db->update($this->table, $download);
	}
}