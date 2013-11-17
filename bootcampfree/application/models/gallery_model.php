<?php
class Gallery_model extends CI_Model
{
	function Gallery_model()
	{
		parent::__construct();
	}
	
	var $table = 'gallery';
	
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	function get_last_ten_gallery($limit, $offset)
	{
		$this->db->order_by('id_gallery', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	function delete($id_gallery)
	{
		$this->db->where('id_gallery', $id_gallery);
		$this->db->delete($this->table);
	}
	
	function add($gallery)
	{
		$this->db->insert($this->table, $gallery);
	}
	
	function get_gallery()
	{
		$this->db->order_by('nama_gallery');
		return $this->db->get($this->table);
	}
	
	function get_gallery_by_id($id_gallery)
	{
		$this->db->where('id_gallery', $id_gallery);
		return $this->db->get($this->table);
	}

	function get_gallery_by_id_album($id_album)
	{
		$this->db->where('id_album', $id_album);
		return $this->db->get($this->table);
	}
		
	function update($id_gallery, $gallery)
	{
		$this->db->where('id_gallery', $id_gallery);
		$this->db->update($this->table, $gallery);
	}
	
	function valid_entry($id_gallery)
	{
		$this->db->where('id_gallery', $id_gallery);
		$query = $this->db->get($this->table)->num_rows();
		if ($query > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}