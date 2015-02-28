<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'admin_model' );
	}
	 
	public function index()
	{
		$this->load->view('home');
	}
	
	/** function for the user log in */
	function login(){
		
		$this->form_validation->set_rules('username','Username','required|trim|max_length[50]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('password','Password','required|trim|max_length[50]|alpha_numeric|xss_clean');
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('home');
		}
		else{
			
			extract($_POST);
			$valid = $this->admin_model->validate_login($username,$password);
			
			if(!$valid){
				
				redirect('admin/index');
			}
			else{
				
				$this->session->set_userdata(array('logged_in'=>TRUE, 'admin_id'=>$username));
				$this->load->view('search');
			}
		}
	}
	
	/** function for searching courses */
	function search(){
		
		$this->load->view('search');
	}
	
	/** function for displaying the search results */
	function results(){
		
		$this->form_validation->set_rules('course_id','Course ID','required|trim|max_length[50]|xss_clean');
		
		extract($_POST);
		
			$data['course_id'] = $course_id;
			
		if($this->form_validation->run() == FALSE){
			
			$this->load->view('search', $data);
		}
		else{
			
			$this->load->view('results', $data);
		}
	}
	
	/** function for filling in the data array */
	function fillData($new_id){
		
		$year = 2011;
		$data['course_id'] = $new_id;
		
		/** fetches the course information from the database */
			$course_info = $this->admin_model->get_course_info($new_id);
			foreach ($course_info->result() as $row ){
				$data['course_dept'] = $row->course_dept;
				$data['course_units'] = $row->course_units;
				$data['course_term'] = $row->course_term;
				$data['course_cost'] = $row->course_cost;
				$data['course_xhrs'] = $row->course_xhrs;
				$data['course_xmin'] = $row->course_xmin;
				$data['course_xmax'] = $row->course_xmax;
				$data['course_lhrs'] = $row->course_lhrs;
				$data['course_lmin'] = $row->course_lmin;
				$data['course_lmax'] = $row->course_lmax;
				$data['course_prereq'] = $row->course_prereq;
				$data['course_coreq'] = $row->course_coreq;
				$data['course_conc'] = $row->course_conc;
				$data['course_concpreq'] = $row->course_concpreq;
				$data['course_title'] = $row->course_title;
			}
			
			/** fetches the course demand information from the database */
	/**		$course_demand = $this->admin_model->get_course_demand($new_id);
			$course_count = 0;
			foreach ($course_demand->result() as $row ){
				$demand_values[$course_count] = $row->demand_value;
				$demand_years[$course_count] = $row->demand_year;
				$demand_terms[$course_count] = $row->demand_term;
				$course_count++;
			}
			$data['demand_values'] = $demand_values;
			$data['demand_years'] = $demand_years;
			$data['demand_terms'] = $demand_terms;
	*/		
			/** fetches the course enlistment information from the database */
			$course_enlisted = $this->admin_model->get_course_enlisted($new_id, $year);
			$enlisted_count = 0;
			foreach ($course_enlisted->result() as $row){
				$enlisted_years[$enlisted_count] = $row->enlisted_year;
				$enlisted_terms[$enlisted_count] = $row->enlisted_term;
				$enlisted_course_ids[$enlisted_count] = $row->course_id;
				$enlisted_section_ids[$enlisted_count] = $row->section_id;
				$enlisted_values[$enlisted_count] = $row->enlisted_value;
				$enlisted_count++;
			}
			$data['enlisted_years'] = $enlisted_years;
			$data['enlisted_terms'] = $enlisted_terms;
			$data['enlisted_course_ids'] = $enlisted_course_ids;
			$data['enlisted_section_ids'] = $enlisted_section_ids;
			$data['enlisted_values'] = $enlisted_values;
			
			/** fetches the course slots information from the database */
			$course_slots = $this->admin_model->get_course_slots($new_id, $year);
			$course_count = 0;
			foreach ($course_slots->result() as $row){
				$section_years[$course_count] = $row->class_year;
				$section_terms[$course_count] = $row->class_term;
				$slots_course_ids[$course_count] = $row->course_id;
				$slots_section_ids[$course_count] = $row->section_id;
				$section_slots[$course_count] = $row->slots_value;
				$course_count++;
			}
			$data['section_years'] = $section_years;
			$data['section_terms'] = $section_terms;
			$data['slots_course_ids'] = $slots_course_ids;
			$data['slots_section_ids'] = $slots_section_ids;
			$data['section_slots'] = $section_slots;
			
			/** fetches the course's student information from the database */
			$course_grades = $this->admin_model->get_course_grades($new_id, $year);
			$grades_count = 0;
			foreach ($course_grades->result() as $row){
				$grades_years[$grades_count] = $row->grade_year;
				$grades_terms[$grades_count] = $row->grade_term;
				$grades_student_ids[$grades_count] = $row->student_id;
				$grades_course_ids[$grades_count] = $row->course_id;
				$grades_values[$grades_count] = $row->grade_value;
				$grades_count++;
			}
			$data['grades_years'] = $grades_years;
			$data['grades_terms'] = $grades_terms;
			$data['grades_student_ids'] = $grades_student_ids;
			$data['grades_course_ids'] = $grades_course_ids;
			$data['grades_values'] = $grades_values;
			
		$data['year'] = $year;
		return $data;
	}
	
	/** function for filling in the data array to be used for graph data */
	function fillGraphData($data){
		
		$passed_first = 0;
		$passed_second = 0;
		$passed_summer = 0;
		$failed_first = 0;
		$failed_second = 0;
		$failed_summer = 0;
		$for_removals = 0;
		$for_completions = 0;
		
		for($a=0; $a<sizeof($data['grades_course_ids']); $a++){
			
			if($data['grades_terms'][$a] == "FIRST"){
				
				if($data['grades_values'][$a] == 4) $for_removals++;
				else if($data['grades_values'][$a] == "INC") $for_completions++;
				else if($data['grades_values'][$a] != 5 && $data['grades_values'][$a] != "U") $passed_first++;
				else $failed_first++;
			}
			else if($data['grades_terms'][$a] == "SECOND"){
				
				if($data['grades_values'][$a] == 4) $for_removals++;
				else if($data['grades_values'][$a] == "INC") $for_completions++;
				else if($data['grades_values'][$a] != 5 && $data['grades_values'][$a] != "U") $passed_second++;
				else $failed_second++;
			}
			else{
				
				if($data['grades_values'][$a] == 4) $for_removals++;
				else if($data['grades_values'][$a] == "INC") $for_completions++;
				else if($data['grades_values'][$a] != 5 && $data['grades_values'][$a] != "U") $passed_summer++;
				else $failed_summer++;
			}
		}
		
		$data['passed_first'] = $passed_first;
		$data['failed_first'] = $failed_first;
		$data['passed_second'] = $passed_second;
		$data['failed_second'] = $failed_second;
		$data['passed_summer'] = $passed_summer;
		$data['failed_summer'] = $failed_summer;
		$data['for_removals'] = $for_removals;
		$data['for_completions'] = $for_completions;
		
		return $data;
	}
	
	/** function for displaying the dashboard or course profile */
	function dashboard(){
		
		if($this->session->userdata('logged_in')){
			
			extract($_POST);
			
			$temp = explode("%20", $this->uri->segment(3));
			$new_id = $temp[0]." ".$temp[1];
			
			$data = $this->fillData($new_id);
			$data = $this->fillGraphData($data);
			
			$this->load->view('dashboard', $data);
		}
		else{
			
			redirect('admin/index');
		}
	}
	
	/** function for editing the course information */
	function edit(){
		
		extract($_POST);
		
		$temp = explode("%20", $this->uri->segment(3));
		$new_id = $temp[0]." ".$temp[1];
		
		$data = $this->fillData($new_id);
		
		$this->load->view('edit', $data);
	}
	
	/** function for calculating the forecast */
	function forecast(){
		
		$checkFirst="0";
		$checkSecond="0";
		$checkSummer="0";
		
		extract($_POST);
		
		$temp = explode("%20", $this->uri->segment(3));
		$new_id = $temp[0]." ".$temp[1];
		
		$data = $this->fillData($new_id);
		
		$data['range'] = $range;
		$data['alpha'] = $alpha;
		$data['checkFirst'] = $checkFirst;
		$data['checkSecond'] = $checkSecond;
		$data['checkSummer'] = $checkSummer;
		
		/** fetches the number of students that have the course in their recommended courses from the database */
		$as_recommended = $this->admin_model->get_recommended($new_id);
		$recommended_count = 0;
		$temp_year = 0;
		$indx = (-1);
		foreach ($as_recommended->result() as $row){
			if($temp_year != $row->recommended_year){
				
				$temp_year = $row->recommended_year;
				$indx++;
				$recommended_count = 0;
			}
			$recommended_years[$indx][$recommended_count] = $row->recommended_year;
			$recommended_terms[$indx][$recommended_count] = $row->recommended_term;
			$recommended_student_ids[$indx][$recommended_count] = $row->student_id;
			$recommended_course_ids[$indx][$recommended_count] = $row->course_id;
			$recommended_count++;
		}
		$data['recommended_years'] = $recommended_years;
		$data['recommended_terms'] = $recommended_terms;
		$data['recommended_student_ids'] = $recommended_student_ids;
		$data['recommended_course_ids'] = $recommended_course_ids;
		$data['indx'] = $indx;
		
		$this->load->view('forecast', $data);
	}
	
	/** function for viewing the manual forecast page */
	function manual(){
		
		extract($_POST);
		
		$temp = explode("%20", $this->uri->segment(3));
		$new_id = $temp[0]." ".$temp[1];
		$data['course_id'] = $new_id;
		$data['item_year'] = 0;
		$data['item_term'] = "";
		$data['counter'] = 0;
		
		$this->admin_model->delete_itemlist($new_id);
		
		$this->load->view('manual', $data);
	}
	
	/** function for adding a demand based on user's input */
	function add_item(){
		
		$this->form_validation->set_rules('item_year','Year','required|xss_clean');
		$this->form_validation->set_rules('item_sem','Semester','required|xss_clean');
		
		extract($_POST);
		
		$data['item_year'] = $item_year;
		$data['item_term'] = $item_term;
		$data['course_id'] = $course_id;
		
		$item_count = 0;
		$item = $this->admin_model->get_demand_value($course_id,$item_year,$item_term);
		foreach($item->result() as $row){
			$item_count++;
		}
		
		if($item_count != 0) $this->admin_model->save_forecast_item($course_id,$item_year,$item_term,$item_count);
		
		$data['item_count'] = $item_count;
		
		$counter = 0;
		$thelist = $this->admin_model->get_item_list($course_id);
		foreach($thelist->result() as $row){
			$counter++;
		}
		$data['counter'] = $counter;
		
		$this->load->view('manual',$data);
	}
	
	/** function for displaying the semesters entered by the user */
	function confirm_set(){
		
		extract($_POST);
		
		$temp = explode("%20", $this->uri->segment(3));
		$new_id = $temp[0]." ".$temp[1];
		$data['course_id'] = $new_id;
		
		$ctr = 0;
		$demand_array[] = array();
		$demand_labels[] = array();
		$demandlist = $this->admin_model->get_item_list($new_id);
		foreach($demandlist->result() as $row){
			
			$demand_labels[$ctr] = $row->item_term." Semester, Year ".$row->item_year;
			$demand_array[$ctr] = $row->demand_value;
			$ctr++;
		}
		
		$data['demand_array'] = $demand_array;
		$data['demand_labels'] = $demand_labels;
		$data['ctr'] = $ctr;
		
		$this->load->view('confirm', $data);
	}
	
	/** function for calculating the manual forecast */
	function mforecast(){
		
		extract($_POST);
		
		$temp = explode("%20", $this->uri->segment(3));
		$new_id = $temp[0]." ".$temp[1];
		$data['course_id'] = $new_id;
		
		$ctr = 0;
		$demand[] = array();
		$demand_labels[] = array();
		$demandlist = $this->admin_model->get_item_list($new_id);
		foreach($demandlist->result() as $row){
			
			$demand_labels[$ctr] = $row->item_term." Semester, Year ".$row->item_year;
			$demand[$ctr] = $row->demand_value;
			$ctr++;
		}
		
		$data['demand'] = $demand;
		$data['demand_labels'] = $demand_labels;
		$data['ctr'] = $ctr;
		
		$data['alpha'] = $alpha;
		
		$this->load->view('mforecast', $data);
	}
	
	/** function for deleting an item from the set of demands entered by the user for manual forecast */
	function delete_item(){
		
		extract($_POST);
		
		$temp = explode("%20", $this->uri->segment(3));
		$new_id = $temp[0]." ".$temp[1];
		$data['course_id'] = $new_id;
		
		$i = $this->uri->segment(4);
		$ctr = 0;
		$temp_id = "";
		$temp_year = 0;
		$temp_term = "";
		$demand_array[] = array();
		$demand_labels[] = array();
		$demandlist = $this->admin_model->get_item_list($new_id);
		foreach($demandlist->result() as $row){
			
			if($i == $ctr){
				$temp_id = $row->course_id;
				$temp_year = $row->item_year;
				$temp_term = $row->item_term;
			}
			$demand_labels[$ctr] = $row->item_term." Semester, Year ".$row->item_year;
			$demand_array[$ctr] = $row->demand_value;
			$ctr++;
		}
		$this->admin_model->delete_item($temp_id,$temp_year,$temp_term);
		
		$data['demand_array'] = $demand_array;
		$data['demand_labels'] = $demand_labels;
		$data['ctr'] = $ctr;
		
		$this->load->view('confirm', $data);
	}
	
	/** function for updating the edited course information */
	function update(){
		
		$this->form_validation->set_rules('course_id','Course ID','required|xss_clean');
		$this->form_validation->set_rules('course_title','Course Title','required|xss_clean');
		$this->form_validation->set_rules('course_dept','Department','required|xss_clean');
		$this->form_validation->set_rules('course_units','Course Units','required|xss_clean');
		$this->form_validation->set_rules('course_term','Terms Offered','required|xss_clean');
		
		extract($_POST);
		
			$data['course_id'] = $course_id;
			$data['course_dept'] = $course_dept;
			$data['course_units'] = $course_units;
			$data['course_term'] = $course_term;
			//$data['course_cost'] = $course_cost;
			$data['course_xhrs'] = $course_xhrs;
			//$data['course_xmin'] = $course_xmin;
			//$data['course_xmax'] = $course_xmax;
			$data['course_lhrs'] = $course_lhrs;
			//$data['course_lmin'] = $course_lmin;
			//$data['course_lmax'] = $course_lmax;
			$data['course_prereq'] = $course_prereq;
			//$data['course_coreq'] = $course_coreq;
			//$data['course_conc'] = $course_conc;
			//$data['course_concpreq'] = $course_concpreq;
			$data['course_title'] = $course_title;
			
		if($this->form_validation->run() == FALSE){

			$this->load->view('edit', $data); 
		
		}
		else{
			
			/** saves the edited information and updates the course information in the database */
			$this->admin_model->update_course_info($course_id,$course_dept,$course_units,$course_term,$course_xhrs,$course_lhrs,$course_prereq,$course_title);
			
			$data = $this->fillData($course_id);
			$data = $this->fillGraphData($data);
			
			$this->load->view('dashboard', $data);
		}
	}
	
	/** function for downloading the PDF version of the course profile */
	function download(){
		
		extract($_POST);
		$temp = $this->uri->segment(3);
		$temp2 = explode("%20", $this->uri->segment(3));
		$new_id = $temp2[0]." ".$temp2[1];
			
		$data = $this->fillData($new_id);
		$data = $this->fillGraphData($data);
		
		/** distinguishes which semesters the course is offered */
		$course_term = $data['course_term'];
		$data['terms_offered'] = "";
			for($i=0; $i<strlen($course_term); $i++){
							
				if($course_term[$i]==1) $data['terms_offered'] = $data['terms_offered']."1st ";
				else if($course_term[$i]==2) $data['terms_offered'] = $data['terms_offered']."2nd ";
				else if($course_term[$i]=="S") $data['terms_offered'] = $data['terms_offered']."Summer ";
			}
		
		/** parses the prerequisits of the course */
		$course_prereq = $data['course_prereq'];
		$prereqs = explode("+",$course_prereq);
		$size = sizeof($prereqs);
		$data['parsed_prereqs'] = "";
			if($size==1) $data['parsed_prereqs'] = $prereqs[0];
			else{
				for($i=0; $i<$size; $i++){
					if($prereqs[$i]=="OR"){
						if($prereqs[$i+2]!="AND" && $prereqs[$i+2]!="OR"){
							$data['parsed_prereqs'] = $data['parsed_prereqs'].$prereqs[$i+1]." OR ".$prereqs[$i+2];
						}
						else{
							$data['parsed_prereqs'] = $data['parsed_prereqs'].$prereqs[$i+1]." OR <br />";
						}
					}
					else if($prereqs[$i]=="AND"){
						if($prereqs[$i+2]!="AND" && $prereqs[$i+2]!="OR"){
							$data['parsed_prereqs'] = $data['parsed_prereqs'].$prereqs[$i+1]." AND ".$prereqs[$i+2];
						}
						else{
							$data['parsed_prereqs'] = $data['parsed_prereqs'].$prereqs[$i+1]." AND <br />";
						}
					}
				}
			}
		
		for($j=0; $j<$s; $j++){
									
			if($data['enlisted_section_ids'][$i]==$data['slots_section_ids'][$j]){
				break;
			}
		}
		$msgtemp = "";
		$s = (sizeof($data['enlisted_section_ids'])<sizeof($data['slots_section_ids']))?sizeof($data['enlisted_section_ids']):sizeof($data['slots_section_ids']);
			for($i=0; $i<$s; $i++){
					
				$msgtemp = $msgtemp."<tr>
						<td>".$data['enlisted_section_ids'][$i]."
						</td>
						<td>".$data['enlisted_values'][$i]."
						</td>
						<td>".$data['section_slots'][$j]."
						</td>
					</tr>";
			}
		
		/** variable containing the course information for pdf generation */
		$message = 
		
			"<br />".$data['course_id']." - ".$data['course_title']."
			<h5>COURSE INFORMATION SUMMARY</h5>
			
			<table style='margin-left:5%; margin-right:5%; border:1px solid #000; padding:15px;'>
				<tr>
					<td>Course ID:</td>
					<td>".nbs(5).$data['course_id']."</td>
				</tr>
				<tr>
					<td>Course Title:</td>
					<td>".nbs(5).$data['course_title']."</td>
				</tr>
				<tr>
					<td>Number of Units:</td>
					<td>".nbs(5).$data['course_units']."</td>
				</tr>
				<tr>
					<td>Course Department:</td>
					<td>".nbs(5).$data['course_dept']."</td>
				</tr>
				<tr>
					<td>Semesters Offered:</td>
					<td>".nbs(5).$data['terms_offered']."</td>
				</tr>
				<tr>
					<td>Lecture Hours:</td>
					<td>".nbs(5).$data['course_xhrs']."</td>
				</tr>
				<tr>
					<td>Laboratory Hours:</td>
					<td>".nbs(5).$data['course_lhrs']."</td>
				</tr>
				<tr>
					<td>Prerequisites:</td>
					<td>".nbs(5).$data['parsed_prereqs']."</td>
				</tr>
			</table>
			
			<br />
			
			<br />
			<table>
			
				<tr>
					<td><h5>FIRST SEMESTER ".$data['year']."</h5></td>
					<td><h5>SECOND SEMESTER ".$data['year']."</h5></td>
					<td><h5>SUMMER ".$data['year']."</h5></td>
				</tr>
				<tr>
					<td>Passed: ".$data['passed_first']." | Failed: ".$data['failed_first']."</td>
					<td>Passed: ".$data['passed_second']." | Failed: ".$data['failed_second']."</td>
					<td>Passed: ".$data['passed_summer']." | Failed: ".$data['failed_summer']."</td>
				</tr>
			
			</table>
			
		";
		
		// loads the html and autodownloads the pdf generated
		$this->load->library('mpdf');
		$this->mpdf->SetHeader('UNIVERSITY OF THE PHILIPPINES - LOS BANOS');
		$this->mpdf->SetFooter('Document accessed on {DATE j-m-Y}|{PAGENO}');
		$this->mpdf->WriteHTML($message);
		$this->mpdf->Output();
	}
	
	/** function for deleting a specific course */
	function delete(){
		
		extract($_POST);
		
		$temp = explode("%20", $this->uri->segment(3));
		$new_id = $temp[0]." ".$temp[1];
		$data['course_id'] = $new_id;
		
		$this->admin_model->delete_course_info($new_id);
		$this->load->view('search', $data);
	}
	
	/** function for the user log out */
	function logout(){
		
		$this->session->sess_destroy();
		redirect('admin/index');
	}
	
	/** function for displaying the registration form */
	function register(){
		
		$this->load->view('register');
	}
	
	/** function for registering a new admin */
	function reg_admin(){
		
		$this->form_validation->set_rules('admin_id','Admin ID','required|xss_clean');
		$this->form_validation->set_rules('admin_username','Username','required|xss_clean');
		$this->form_validation->set_rules('admin_password','Password','required|xss_clean');
		
		extract($_POST);
		
			$data['admin_id'] = $admin_id;	
			$data['admin_username'] =$admin_username;
			$data['admin_password'] = $admin_password;
			
		if($this->form_validation->run() == FALSE){
			
			$this->load->view('register', $data);
		}
		else{
			
			$this->admin_model->attempt_register($admin_id,$admin_username,$admin_password);
			redirect('admin/index');
		}
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */