<?php 
class Berita_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	var $table = 'berita';
	
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	function get_last_ten_berita($limit, $offset, $username, $level)
	{
		if($level == 'user')
		{
			$this->db->where('username', $username);
		}
		$this->db->order_by('id_berita', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}

	function get_last_ten_berita2($limit, $offset)
	{
		$this->db->order_by('id_berita', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
		
	function delete($id_berita)
	{
		$this->db->where('id_berita', $id_berita);
		$this->db->delete($this->table);
	}
	

	function add($berita)
	{
		$this->db->insert($this->table, $berita);
	}
	

	function get_berita_by_id($id_berita)
	{
		$this->db->select('id_berita, username, kutipan, judul, isi_berita, jam, gambar, tgl_posting, tgl_update, dibaca');
		$this->db->where('id_berita', $id_berita);
		return $this->db->get($this->table);
	}
	
	function get_all_berita($limit, $offset)
	{
		$this->db->select('id_berita, username, kutipan, judul, jam, gambar, tgl_posting, tgl_update');
		$this->db->order_by('id_berita', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	function get_berita_terbaru($limit, $offset)
	{
		$this->db->select('id_berita, username, kutipan, judul, jam, gambar, tgl_posting, tgl_update');
		$this->db->order_by('id_berita', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	function get_berita_terakhir()
	{
		$this->db->select('id_berita, judul, dibaca');
		$this->db->order_by('dibaca', 'desc');
		$this->db->limit(10, 5);
		return $this->db->get($this->table);
	}	

	function get_berita_populer()
	{
		$this->db->select('id_berita, judul, dibaca');
		$this->db->order_by('dibaca', 'desc');
		$this->db->limit(10, 0);
		return $this->db->get($this->table);
	}
	
	function get_berita_terkait($kata)
	{ 	
		$this->db->like('judul', $kata);
		$this->db->or_like('isi_berita', $kata);
		$this->db->order_by('judul', 'desc');
		$this->db->limit(7);
		return $this->db->get($this->table);
	}
	
	function get_judul_by_id($id_berita)
	{
		$this->db->select('id_berita, judul, dibaca');
		$this->db->where('id_berita', $id_berita);
		return $this->db->get($this->table);
	}
	
	function get_image_by_id($id_berita)
	{
		$this->db->select('id_berita, gambar');
		$this->db->where('id_berita', $id_berita);
		return $this->db->get($this->table);
	}
	
	function update($id_berita, $berita)
	{
		$this->db->where('id_berita', $id_berita);
		$this->db->update($this->table, $berita);
	}
	
	function update_dibaca($id_berita, $dibaca)
	{
		$this->db->query("UPDATE berita SET dibaca='$dibaca' WHERE id_berita='$id_berita'");
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
// END berita_model Class

/* End of file berita_model.php */
/* Location: ./application/models/berita_model.php */