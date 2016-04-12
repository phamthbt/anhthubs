<?php
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/lib/formslib.php');


class ibm_registra_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
 
        $mform = $this->_form; // Don't forget the underscore! 

        
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
    
    public function add_data($arr = array()){
    	$mform = $this->_form;
    	
    	$mform->addElement('text', 'student_id', 'Student ID');
    	$mform->addElement('text', 'student_id', 'Student name');
		
		
		
		$buttonarray=array();
		//$buttonarray[] =& $mform->createElement('submit', 'submitbutton', 'Go');
		//$buttonarray[] =& $mform->createElement('submit', 'cancel', get_string('cancel'));
		$mform->addElement('button', 'submitbutton', get_string('savechanges'));
		//$mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
	
    	
    }
}