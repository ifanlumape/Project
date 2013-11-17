
		<?php
		class Identitas_model extends CI_Model
		{
		function Identitas_model()
		{
		parent::__construct();
		}
		
		var $table = 'identitas';
		
		function count_all_num_rows()
		{
		return $this->db->count_all($this->table);
		}
		
		function get_last_ten_identitas($limit, $offset)
		{
		$this->db->order_by('id_identitas', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
		}
		
		function delete($id_identitas)
		{
		$this->db->where('id_identitas', $id_identitas);
		$this->db->delete($this->table);
		}
		
		function add($identitas)
		{
		$this->db->insert($this->table, $identitas);
		}
		
		function get_identitas()
		{
		$this->db->order_by('nama_identitas');
		return $this->db->get($this->table);
		}
		
		function get_identitas_by_id($id_identitas)
		{
		$this->db->where('id_identitas', $id_identitas);
		return $this->db->get($this->table);
		}
		
		function update($id_identitas, $identitas)
		{
		$this->db->where('id_identitas', $id_identitas);
		$this->db->update($this->table, $identitas);
		}
		
		function valid_entry($id_identitas)
		{
		$this->db->where('id_identitas', $id_identitas);
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