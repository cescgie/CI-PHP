<?php
class File_model extends CI_Model {
	
	private $tbl= 'cf';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl);
	}

	function count_cf(){
		return $this->db->select('count(*) as sum_cf',false)
         ->from('cf')
         ->get()
         ->result();
	}
}
?>