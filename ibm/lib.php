<?php
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/lib/formslib.php');


class simplehtml_form extends moodleform {
    //Add elements to form
	var $options;
	
    public function definition() {
        global $CFG;
 
        $mform = $this->_form; // Don't forget the underscore! 
 
       // $mform->addElement('text', 'email', get_string('email')); // Add elements to your form
        //$mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        //$mform->setDefault('email', 'Please enter email');        //Default value
       
        
    }
	function set_data($options = array()){
		$mform = $this->_form;
		$mform->addElement('select', 'type', 'Programs', $options);
		$this->add_action_buttons();
	}
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
