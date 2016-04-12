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
require_once ($CFG->dirroot.'/ibm/output/index_page.php');
$courseid = optional_param('course', SITEID, PARAM_INT);

require_course_login(0);


$url = new moodle_url('/ibm/detail.php');



//required id for program_id
$program_id = required_param('id', PARAM_INT);
	
	$view = optional_param('view', 'grade', PARAM_ALPHA);

	$userid = $USER->id;  // Owner of the page
    $context = context_user::instance($USER->id);
    $PAGE->set_blocks_editing_capability('moodle/my:manageblocks');
    $header = fullname($USER);
    
$params = array();
$PAGE->set_context($context);
$PAGE->set_url('/my/index.php', $params);
$PAGE->set_pagelayout('mydashboard');
$PAGE->set_pagetype('my-index');
$PAGE->blocks->add_region('content');

$PAGE->set_title('IBM Grade');
$PAGE->set_heading($header);

if (isset($_SESSION['ibm']) & $_SESSION['ibm']->current_student_id!=''){
	$ibm = $_SESSION['ibm'];
	
	$program = $DB->get_record('ibm_program', array('program_id'=>$program_id));
	
	$sql 	= 'SELECT '; 
				$sql	.= 'g.id, g.user_id, g.subject_id, g.earning, g.percent,';
				$sql	.=	'g.alphabet, g.point, g.id_subject_transfer, g.status,s.credit,s.shortname, s.name ';
		$sql	.= 'FROM ';
				$sql	.= '{ibm_grade} g ';
				$sql	.= 'LEFT JOIN {ibm_subject} s ON g.subject_id = s.id ';
		$sql	.= 'WHERE ';
				$sql	.= ' s.program_id = '.$program_id . ' AND g.user_id = '.$USER->id ;
	
	$rs = $DB->get_records_sql ($sql);
	

	echo $OUTPUT->header();

		
	$str 	= '<form method="post" action="view.php">';

	$str	= '<div class="row my-row">
                 	<div class="col-lg-12 col-md-12">'.
	$str .= $program->name.'<br>';		
	$str .= 'Chá»�n trÆ°á»�ng <select name="program" id="jumpMenu" >';
	$str .=	'<option>--------none---------</option>';
	$str .=	'<option selected value="?value=1">UBIS MBA</option>';
	$str .=	'<option value="?value=2">HASEM</option>';
	$str .= '</select>';
	$str .= '</div>';
	$str .= '</div>';
	$str 	= '</form>';
	
	
	$str = '';
	$str = '<div class="col-md-9 col-lg-9 col-xs12">';
	$str .= 'Program: <strong>'.$program->name.'</strong><br>';	
	$str .='
        <table class="my-table table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>	    	
                    <th>No.</th>
                    <th>Shortname</th>
                    <th>Fullname</th>
                    <th>Credits</th>
                    <th>ERN</th>
                    <th>Grade</th>
                    <th>Alphabet</th>
                    <th>Points</th>
                    <th>GPA</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="success">
                    <td>1</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>3</td>
                    <td>3</td>
                    <td>90.00</td>
                    <td>A-</td>
                    <td>11.1</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-ok green"></span></td>
                </tr>';
		$i = 1;
		if(count($rs)>0){
			
		foreach($rs as $k=>$v){	
				
			$str .=' <tr class="success">
                    <td>'.$i.'</td>
                    <td>'.$v->shortname.'</td>
                    <td>'.$v->name.'</td>
                    <td>'.$v->credit.'</td>
                    <td>'.$v->earning.'</td>
                    <td>'.$v->point.'</td>
                    <td>'.$v->alphabet.'</td>
                    <td>'.$v->percent.'</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-ok green"></span></td>
                </tr> ';
			$i++;
			}
		}
		$str .='</tbody>
        </table>
        </div>';
	
echo $str;
}

?>
<div class="blah">
	
</div>
<?php
echo $OUTPUT->custom_block_region('content');
echo $OUTPUT->footer();

