<?php class Admin_model extends CI_Model {
	
	function __construct(){
		
		parent::__construct();
	}
	
	/** function for checking the validity of the username and password */
	function validate_login($username,$password){
		
		$pass = $password;
		$query_str = "SELECT admin_id FROM admin where admin_username=? and admin_password=?";
		$result = $this->db->query($query_str,array($username,$pass));
		
		if($result->num_rows() == 1)
		{
			return $result->row(0)->admin_id;
		}
		else {
			return false;
		}
	}
	
	/** function for checking if there is an existing admin ID */
	function check_existing_id($admin_id){
		
		$checker = false;
		
		$this->db->like('admin_id', $admin_id);
		$this->db->from('admin');
		
		$query = $this->db->get();
		if($query == $admin_id){
			
			$checker = true;
			return $checker;
		}
		else{
			
			return $checker;
		}
	}
	
	/** function for getting the course information from the database */
	function get_course_info($course_id){
		
		$this->db->from('courses');
		$this->db->where('course_id',$course_id);
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_demand_value($course_id,$item_year,$item_sem){
		
		$this->db->from('recommended');
		$this->db->where('recommended_year', $item_year);
		$this->db->where('recommended_term', $item_sem);
		$this->db->where('course_id', $course_id);
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_item_list($course_id){
		
		$this->db->from('forecast');
		$this->db->where('course_id', $course_id);
		
		$query = $this->db->get();
		return $query;
	}
	
	function save_forecast_item($course_id,$item_year,$item_term,$item_count){
		
		$this->db->set('course_id', $course_id);
		$this->db->set('item_year', $item_year);
		$this->db->set('item_term', $item_term);
		$this->db->set('demand_value', $item_count);
		$this->db->insert('forecast');
	}
	
	/** function for updating the course information in the database */
	function update_course_info($course_id,$course_dept,$course_units,$course_term,$course_xhrs,$course_lhrs,$course_prereq,$course_title){
		
		//$this->db->from('course');
		$this->db->where('course_id', $course_id);
		$this->db->set('course_id', $course_id);
		$this->db->set('course_dept', $course_dept);
		$this->db->set('course_units', $course_units);
		$this->db->set('course_term', $course_term);
		//$this->db->set('course_cost', $course_cost);
		$this->db->set('course_xhrs', $course_xhrs);
		//$this->db->set('course_xmin', $course_xmin);
		//$this->db->set('course_xmax', $course_xmax);
		$this->db->set('course_lhrs', $course_lhrs);
		//$this->db->set('course_lmin', $course_lmin);
		//$this->db->set('course_lmax', $course_lmax);
		$this->db->set('course_prereq', $course_prereq);
		//$this->db->set('course_coreq', $course_coreq);
		//$this->db->set('course_conc', $course_conc);
		//$this->db->set('course_concpreq', $course_concpreq);
		$this->db->set('course_title', $course_title);
		$this->db->update('courses');
	}
	
	/** function for deleting a course from the database */
	function delete_course_info($course_id){
		
		$this->db->delete('courses',array('course_id' => $course_id));
		$this->db->delete('classes',array('course_id' => $course_id));
		$this->db->delete('enlistment',array('course_id' => $course_id));
	}
	
	function delete_itemlist($course_id){
		
		$this->db->delete('forecast',array('course_id' => $course_id));
	}
	
	function delete_item($course_id,$item_year,$item_term){
		
		$this->db->delete('forecast', array('course_id'=>$course_id,'item_year'=>$item_year,'item_term'=>$item_term));
	}
	
	/** function for getting the course demand information from the database */
	function get_course_demand($course_id){
		
		$this->db->from('demand');
		$this->db->where('course_id', $course_id);
		$query = $this->db->get();
		return $query;
	}
	
	/** function for getting the course enlistment information from the database */
	function get_course_enlisted($course_id, $year){
		
		$this->db->from('enlistment');
		$this->db->where('course_id', $course_id);
		$this->db->where('enlisted_year', $year);
		$query = $this->db->get();
		return $query;
	}
	
	/** function for getting the course slots informtaion from the database */
	function get_course_slots($course_id, $year){
		
		$this->db->from('classes');
		$this->db->where('course_id', $course_id);
		$this->db->where('class_year', $year);
		$query = $this->db->get();
		return $query;
	}
	
	/** function for getting the course grades informtaion from the database */
	function get_course_grades($course_id, $year){
		
		$this->db->from('grades');
		$this->db->where('course_id', $course_id);
		$this->db->where('grade_year', $year);
		$query = $this->db->get();
		return $query;
	}
	
	/** function for getting the recommended course informtaion from the database */
	function get_recommended($course_id){
		
		$this->db->from('recommended');
		$this->db->where('course_id', $course_id);
		$query = $this->db->get();
		return $query;
	}
	
	/** function for adding a new admin */
	function attempt_register($admin_id,$admin_username,$admin_password){
		
		$temp = $this->check_existing_id($admin_id);
		
		if(!$temp){
			
			$this->db->set('admin_id', $admin_id);
			$this->db->set('admin_username', $admin_username);
			$this->db->set('admin_password', $admin_password);	
			$this->db->insert('admin');
		}
	}
	
	/** function for searching for a course from the database */
	function search_courses($course_id){
		
		$this->db->like('course_id', $course_id);
		$this->db->from('courses');
		
		$query = $this->db->get();
		return $query;
	}
}

/* End of file admin_model.php */
/* Location: ./application/models/admin_models.php */