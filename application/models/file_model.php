<?php
class File_model extends CI_Model {
	
	private $tbl_cf= 'cf';
	private $tbl_ga= 'ga';
	
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
	function insert_cf($datas){
		return $this->db->insert($this->tbl_cf, $datas);
		//return $this->db->insert_id();
	}

	function count_ga(){
		return $this->db->select('count(*) as sum_ga',false)
         ->from('ga')
         ->get()
         ->result();
	}
	function insert_ga($datas){
		return $this->db->insert($this->tbl_ga, $datas);
		//return $this->db->insert_id();
	}
}
?>