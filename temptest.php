<?php
/*
 Plugin Name: Temperatur Test 
 Plugin URI: http://www.cos-gbr.de 
 Version: 1.0 
 Description: Print a test tower for a new filament  
 Author: Stefan Mueller & Andreas Mann 
 Author URI: http://www.cos-gbr.de 
 Plugin Slug: fabtotumfunctionality
 Icon: fa fa-star
 */
class Temptest extends Plugin {

	public function __construct() {
		parent::__construct();
		$this->layout->add_css_file(array('src'=>site_url().'application/plugins/temptest/assets/css/temptest.css', 'comment' => 'stylesheet for temptest'));
		$this->layout->add_js_file(array('src'=>site_url().'application/plugins/temptest/assets/js/temptest.js', 'comment' => 'stylesheet for temptest'));
	}

	public function index() {
		
		$this -> layout -> view('index', '');

	}
	
	
	public function remove(){
		
		/** TO DO  */
		
		/** remove files */
		shell_exec('sudo rm -rf '.PLUGINSPATH.strtolower(get_class($this)));
		
		/** SET MESSAGE TO DISPLAY */
		$this->session->set_flashdata('message', "Plugin <strong>".get_class($this)."</strong> removed");
		$this->session->set_flashdata('message_type', 'info');
		
		/** REDIRECT TO PLUGINS PAGE */
		redirect('plugin');
		
	}
	

}
?>
