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
require_course_login($course);


$url = new moodle_url('/ibm/view.php');

$courseid = optional_param('course', SITEID, PARAM_INT);

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
$PAGE->set_subpage($currentpage->id);
$PAGE->set_title($pagetitle);
$PAGE->set_heading($header);
/*
[current_campust] => 12
    [current_program] => 12
    [student_id] => Array
        (
            [12-205] => stdClass Object
                (
                    [id] => 1
                    [user_id] => 234
                    [student_id] => 12-205
                    [created] => 
                    [program_id] => 12
                )

            [15-001] => stdClass Object
                (
                    [id] => 4
                    [user_id] => 234
                    [student_id] => 15-001
                    [created] => 
                    [program_id] => 15
                )

        )

    [current_student_id] => 12-205
*/
if (isset($_SESSION['ibm'])& count($_SESSION['ibm']->student_id)>0){
	$ibm = $_SESSION['ibm'];
	$program_list = array();
	foreach($ibm->student_id as $k=>$v){

		$program_list[] = substr($v->student_id, 0,205);
		
	} 
	$str_p ='';
	$i =0;
	$n = count($program_list);
	
	
	
	echo $OUTPUT->header();
	echo $OUTPUT->custom_block_region('content');
		
	$str 	= '<form method="post" action="view.php">';

	$str	= '<div class="row my-row">
                 	<div class="col-lg-12 col-md-12">'.
	$str .= 'Chọn trường <select name="program" id="jumpMenu" >';
	$str .=	'<option>--------none---------</option>';
	$str .=	'<option selected value="?value=1">UBIS MBA</option>';
	$str .=	'<option value="?value=2">HASEM</option>';
	$str .= '</select>';
	$str .= '</div>';
	$str .= '</div>';
	$str 	= '</form>';
	echo $str;
	$mform = new simplehtml_form();

	//Form processing and displaying is done here
	if ($mform->is_cancelled()) {
	    //Handle form cancel operation, if cancel button is present on form
	} else if ($fromform = $mform->get_data()) {
	  //In this case you process validated data. $mform->get_data() returns data posted in form.
	} else {
	  // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
	  // or on the first display of the form.
	 
	  //Set default data (if any)
	  $mform->set_data($toform);
	  //displays the form
	  $mform->display();
	}
$pagetitle = 'IBM Grade';
	$str = '';
	$str = '<div class="col-md-9 col-lg-9 col-xs12">
        <table class="my-table table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>	    	
                    <th>No.</th>
                    <th>Shorname</th>
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
                </tr> 
                <tr>
                    <td>2</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>3</td>
                    <td>3</td>
                    <td>90.00</td>
                    <td>A-</td>
                    <td>11.1</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-ok green"></span></td>
                </tr> 
                <tr>
                    <td>3</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>3</td>
                    <td>3</td>
                    <td>90.00</td>
                    <td>A-</td>
                    <td>11.1</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-ok green"></span></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>3</td>
                    <td>3</td>
                    <td>90.00</td>
                    <td>A-</td>
                    <td>11.1</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-ok green"></span></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>3</td>
                    <td>3</td>
                    <td>90.00</td>
                    <td>A-</td>
                    <td>11.1</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-ok green"></span></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>3</td>
                    <td>3</td>
                    <td>90.00</td>
                    <td>A-</td>
                    <td>11.1</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-ok green"></span></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>3</td>
                    <td>3</td>
                    <td>90.00</td>
                    <td>A-</td>
                    <td>11.1</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-ok green"></span></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-minus my-gray"></span></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-minus my-gray"></span></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-minus my-gray"></span></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-minus my-gray"></span></td>
                </tr>
                 <tr>
                    <td>12</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-minus my-gray"></span></td>
                </tr>
                 <tr>
                    <td>13</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-minus my-gray"></span></td>
                </tr>
                 <tr>
                    <td>14</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-minus my-gray"></span></td>
                </tr>
                 <tr>
                    <td>15</td>
                    <td>ACC-601</td>
                    <td>Accounting for Decision Marking</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="glyphicon glyphicon-minus my-gray"></span></td>
                </tr>
            </tbody>
        </table>
        </div>';

echo $str;


?>
<div class="blah">
	
</div>
<?php
echo $OUTPUT->custom_block_region('content');
echo $OUTPUT->footer();

