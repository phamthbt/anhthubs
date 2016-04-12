<?php
require_once('../config.php');
$cmid = optional_param('id', 1,PARAM_INT);
// $cm = get_coursemodule_from_id('ibm', $cmid, 0, false, MUST_EXIST);
// $course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$course = $DB->get_record('course', array('id' => 1), '*', MUST_EXIST);
require_login($course, true, $cm);
$PAGE->set_url('/ibm/view.php', array('id' => $cmd->id));
$PAGE->set_title('My modules page title');
$PAGE->set_heading('My modules page heading');
$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('mydashboard');

$PAGE->set_heading('IBM Test');
$PAGE->set_button($htmlstring);
$PAGE->set_cacheable(false);
$PAGE->add_body_class('phipp');
$PAGE->blocks->add_region('left');

echo $OUTPUT->header();

echo $OUTPUT->custom_block_region('left');
echo $OUTPUT->footer();