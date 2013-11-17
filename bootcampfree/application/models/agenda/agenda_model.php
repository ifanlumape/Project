<?php 
class Agenda_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	var $table = 'agenda';
	
	/**
	 * Menghitung jumlah baris dalam sebuah tabel, ada kaitannya dengan pagination
	 */
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	/**
	 * Tampilkan 10 baris agenda terkini, diurutkan berdasarkan tanggal (Descending)
	 */
	function get_last_ten_agenda($limit, $offset)
	{

		$this->db->order_by('id_agenda', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	function get_all_agenda($limit, $offset)
	{
		$this->db->select('id_agenda, tema, tgl_posting, tgl_update');
		$this->db->order_by('id_agenda', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	

	function delete($id_agenda)
	{
		$this->db->where('id_agenda', $id_agenda);
		$this->db->delete($this->table);
	}
	

	function add($agenda)
	{
		$this->db->insert($this->table, $agenda);
	}
	

	function get_agenda_by_id($id_agenda)
	{
		$this->db->where('id_agenda', $id_agenda);
		return $this->db->get($this->table);
	}
	
	function get_agenda_terbaru($limit, $offset)
	{
		$this->db->order_by('id_agenda', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	function get_judul_by_id($id_agenda)
	{
		$this->db->select('id_agenda, tema');
		$this->db->where('id_agenda', $id_agenda);
		return $this->db->get($this->table);
	}

	function update($id_agenda, $agenda)
	{
		$this->db->where('id_agenda', $id_agenda);
		$this->db->update($this->table, $agenda);
	}
	

	function valid_entry($tema)
	{
		$this->db->where('tema', $tema);
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
// END agenda_model Class

/* End of file agenda_model.php */
/* Location: ./application/models/agenda_model.php */