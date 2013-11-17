<?php 
class Users_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	// Inisialisasi nama tabel user
	var $table = 'users';
	
	/**
	 * Cek tabel user, apakah ada user dengan username dan password tertentu
	 */
	function check_user($username, $password)
	{
		$query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password), 1, 0);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_level($username, $password)
	{
		$this->db->select('username, password, level');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get($this->table);
	}
	
	
	/**
	 * Menghitung jumlah baris dalam sebuah tabel, ada kaitannya dengan pagination
	 */
	function count_all_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	/**
	 * Tampilkan 10 baris absen terkini, diurutkan berdasarkan tanggal (Descending)
	 */
	function get_last_ten_users($limit, $offset, $username)
	{
		if($username == 'admin')
		{
			$this->db->order_by('username', 'desc');
		}
		else
		{
			$this->db->where('username', $username);
			$this->db->order_by('username', 'desc');
		}
	
		
		$this->db->limit($limit, $offset);
		return $this->db->get($this->table);
	}
	
	/**
	 * Menghapus sebuah entry data users
	 */
	function delete($id_users)
	{
		$this->db->where('username', $id_users);
		$this->db->delete($this->table);
	}
	
	/**
	 * Menambahkan sebuah data ke tabel users
	 */
	function add($users)
	{
		$this->db->insert($this->table, $users);
	}
	
	/**
	 * Dapatkan data users dengan id_users tertentu, untuk proses update
	 */
	function get_users_by_id($id_users)
	{
		$this->db->where('username', $id_users);
		return $this->db->get($this->table);
	}
	
	/**
	 * Update data users
	 */
	function update($id_users, $users)
	{
		$this->db->where('username', $id_users);
		$this->db->update($this->table, $users);
	}
	
	/**
	 * Cek apakah ada entry data yang sama
	 */
	function valid_entry($username)
	{
		$this->db->where('username', $username);
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
// END Users_model Class

/* End of file users_model.php */ 
/* Location: ./application/models/users/users_model.php */