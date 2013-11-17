<?php
class Album_model extends CI_Model
{
	function Album_model()
	{
		parent::__construct();
	}
	
	var $table = 'album';
	
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	function get_last_ten_album($limit, $offset)
	{
		$this->db->order_by('id_album', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	function delete($id_album)
	{
		$this->db->where('id_album', $id_album);
		$this->db->delete($this->table);
	}
	
	function add($album)
	{
		$this->db->insert($this->table, $album);
	}
	
	function get_album()
	{
		$this->db->order_by('jdl_album');
		return $this->db->get($this->table);
	}
	
	function get_album_terbaru()
	{
		$this->db->where('aktif', 'Y');
		$this->db->order_by('id_album', 'desc');
		$this->db->limit(8, 0);
		return $this->db->get($this->table);	
	}
	
	function get_album_by_id($id_album)
	{
		$this->db->where('id_album', $id_album);
		return $this->db->get($this->table);
	}
	
	function update($id_album, $album)
	{
		$this->db->where('id_album', $id_album);
		$this->db->update($this->table, $album);
	}
}