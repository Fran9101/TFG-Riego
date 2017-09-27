<?php
class model_riego extends CI_Model {

	function configura($id,$data){
		$this->db->where('IDArduino',$id);
		$this->db->update('arduino',$data);
	}

	function programa($id,$data){
		$this->db->where('IDProg',$id);
		$this->db->update('programacion',$data);
	}
}
?>