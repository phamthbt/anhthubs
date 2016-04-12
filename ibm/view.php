<?php

/////////////////////////////////////////////////////////////////////////////
//                                                                         //
// NOTICE OF COPYRIGHT                                                     //
//                                                                         //
// Moodle - IBM Grade                                                      //
//                                                                         //
// Copyright (C)                               ibm.org.vn                  //
//                                                                         //
// Designed by:                                                            //
//     Pham Phu Phi (phamphuphi@gmail.com)                                 //
//                                                                         //
//                                                                         //
// Programming and development: 																						//			
//     Pham Phu Phi  - Nguyen Trong Tri                                    //
//                                                                         //
// For bugs, suggestions, etc contact:                                     //
//     PhiPP           (phamphuphi@gmail.com)                              //
//                                                                         //
//                                                                         //
//                                                                         //
/////////////////////////////////////////////////////////////////////////////

//  Display Student grade for IBM Institute.


require_once('../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/ibm/lib.php');
require_once($CFG->dirroot.'/ibm/renderer.php');
require_once ($CFG->dirroot.'/ibm/ibm_registra_form.php');



	$url = new moodle_url('/ibm/view.php');

	$courseid = optional_param('course', SITEID, PARAM_INT);
	$get_program_id = optional_param('program_id', 0, PARAM_INT);
	$get_intake_id = optional_param('intake_id', 0, PARAM_INT);
	$get_student_id = optional_param('txt_student_id', '', PARAM_RAW);
	$str_students 	= optional_param('str_students', '', PARAM_RAW);
	require_course_login($courseid);
	$view = optional_param('view', 'grade', PARAM_ALPHA);

	$userid = $USER->id;  // Owner of the page
    $context = context_user::instance($USER->id);
	if(!has_capability('moodle/grade:manage', $context)){
		redirect($CFG->wwwroot);
		
	}
	
    $header = fullname($USER);
    $pagetitle = 'IBM Transcript';
	$params = array();
	$PAGE->set_context($context);
	$PAGE->set_url('/my/index.php', $params);
	$PAGE->set_pagelayout('mydashboard');
	$PAGE->set_pagetype('my-index');
	$PAGE->blocks->add_region('content');
	//$PAGE->set_subpage($currentpage->id);
	$PAGE->set_title($pagetitle);
	$PAGE->set_heading($header);



	//$DB->get_records('');
	
	$reg_form = new ibm_registra_form();
	$reg_form->add_data();
	
	echo $OUTPUT->header();
	
	//$reg_form->display();
	echo '<div>';
	
	echo '<h3>Registra Search:</h3> <br>  
	<form name="phipp" method="post" action="view.php">';
	
	echo 'Student ID: <input type="text" name="txt_student_id" value="'.$get_student_id.'"/>';
	//echo 'Name ID:<input type="text" name="aa"/>';
	echo '<div>';
	echo '<div>';
	$str ='';
	$str .=  'Programs: <select name="program_id" >';
	
	$programs = $DB->get_records('ibm_program');
	$programs[0] = new stdClass();
	$programs[0]->program_id = 0;
	$programs[0]->name = '-----All----';
	
	ksort($programs);
	foreach($programs as $k=>$v){
		if($get_program_id== $v->program_id)
			$str .= '<option selected value="'.$v->program_id.'">'.$v->name.'</option>';
		else
			
		$str .= '<option  value="'.$v->program_id.'">'.$v->name.'</option>';
	}
	
	$str .=	 '</select>';
	echo $str;
	echo '</div>';
	

	echo '</div>';
	/*---- Intake code---*/
	$intakes = $DB->get_records('ibm_intake');
	echo '<div>';
	$str ='';
	$str .=  'intakes: <select name="intake_id" >';
	
	$intakes = $DB->get_records('ibm_intake', array('status'=>1));
	$intakes[0] = new stdClass();
	$intakes[0]->id = 0;
	$intakes[0]->name = '-----All----';
	
	ksort($intakes);
	foreach($intakes as $k=>$v){
		
		if($get_intake_id == $v->id)
			$str .= '<option selected value="'.$v->id.'">'.$v->name.'</option>';
		else
			
		$str .= '<option  value="'.$v->id.'">'.$v->name.'</option>';
	}
	
	$str .=	 '</select>';
	echo $str;
	echo '</div>';
	echo '<input type="submit" value="Search	"/>';
	echo '</form>';
	
	
	
	$sql = 'SELECT ';
	
	$sql .= 's.student_id , u.firstname, u.lastname ';
	
	$sql .='FROM ';
	$sql .='{ibm_student_id} s left join  {user} u ON u.id = s.user_id ';
	
	$where = array();
	
	if($get_student_id !=''){
		$where[] = ' s.student_id like'." '%".$get_student_id."%' ";
	}
	if($get_program_id !=0){
		$sql .= ' LEFT JOIN {ibm_student_program} sp on s.id = sp.student_id ';
		$where[] = ' sp.program_id = '.$get_program_id .' ';
	}
	$str_where ='';
	if(count($where)>0 )
		echo $str_where =' WHERE '. implode(' AND ', $where);
	
	if($str_where!= '')
	 $sql .=$str_where . ' ';
	
	$sql .= 'ORDER BY s.user_id';
	$rs = $DB->get_records_sql($sql);
	$table = ' <table class="my-table table table-bordered table-striped table-hover table-condensed">';
	$table .='<thead>
                <tr>	    	
                    <th align="center">No.</th>
                    <th align="center">Student ID</th>
                    <th align="center">Fullname</th
                </tr>
            </thead>';
	$table .= '<tbody';
	$i = 1;
	$str_students = array();
	foreach($rs as $k=>$v){
		$str_students []= $v->student_id;
	$table .=' <tr >
                    <td align="center" style="align:center;">'.$i.'</td>
                    <td>'.$v->student_id.'</td>
                    <td>'.$v->firstname.' '. $v->lastname.'</td>
                   
                </tr>';
		$i++;		
	}
	$table .= '</tbody>';
	$table .='</table>';
	if(count($str_students>0))
		$str_students = implode(',', $str_students);
	echo $str_students;
	echo $table;
	echo '<form action=view.php methodd = "POST" name ="download">';
	echo '<input type ="hidden" name= "str_students" value='.$str_students.'/>';
	echo '<input type ="hidden" name="download" value='.$str_students.'/>';
	echo $str_download = '<input type="submit" value="Download"/>';
	echo '</form>';
	echo '</div>';
	
echo $OUTPUT->custom_block_region('content');
echo $OUTPUT->footer();

