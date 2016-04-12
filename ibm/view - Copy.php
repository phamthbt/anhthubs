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

require_course_login($course);


$url = new moodle_url('/ibm/view.php');

$courseid = optional_param('course', SITEID, PARAM_INT);

$view = optional_param('view', 'grade', PARAM_ALPHA);

	echo $OUTPUT->header();
$PAGE->navbar->add(userdate($time, get_string('strftimedate')));
echo '<pre>';
print_r($_SESSION->your_current_programs);
echo '</pre>';
echo __FILE__.__LINE__;
$pagetitle = 'IBM Grade';


$PAGE->set_title($pagetitle);

?>
<div class="blah">
	
</div>
<?php
echo $OUTPUT->custom_block_region('content');
echo $OUTPUT->footer();

