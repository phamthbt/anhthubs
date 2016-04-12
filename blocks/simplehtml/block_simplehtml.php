<?php
class block_simplehtml extends block_base {
    public function init() {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
    
        $this->content         =  new stdClass;
        $this->content->text   = 'The content of our SimpleHTML block!';
        $this->content->footer = 'Footer here...';
    
        return $this->content;
    }
    public function specialization() {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_simplehtml');
            } else {
                $this->title = $this->config->title;
            }
    
            if (empty($this->config->text)) {
                $this->config->text = get_string('defaulttext', 'block_simplehtml');
            }
        }
    }
    public function instance_allow_multiple() {
        return true;
    }
    function has_config() {return true;}
    public function instance_config_save($data,$nolongerused =false) {
        if(get_config('simplehtml', 'Allow_HTML') == '1') {
            $data->text = strip_tags($data->text);
        }
    
        // And now forward to the default implementation defined in the parent class
        return parent::instance_config_save($data,$nolongerused);
    }
    public function applicable_formats() {
        $array = array('site-*'=>true,
            'mydashboard'=>true,
            'course-view-social' => false,
            'mod'=>true
            
        );
        //array('site-index' => true);
        
        return $array;
    }
}