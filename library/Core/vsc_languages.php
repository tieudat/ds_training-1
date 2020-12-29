<?php

class vsc_languages{
	
	public $source;
	public $ext;
	public $languages;
	
	private $file;
	private $file_conf = "config";
	
	function __construct(){
		
		$this->source = "./languages/";
		$this->ext = ".ini";
		$this->languages = $this->set_languages();
	}
	
	function get_file_language($lang){
		$file = $this->source . $lang . $this->ext;
		return $file;
	}
	
	function get_content_language($lang){
		$content = array();
		if(file_exists($this->get_file_language($lang))){
			$content = parse_ini_file($this->get_file_language($lang), true);
		}
		return $content;
	}
	
	function get_content_language_item($lang, $key){
		$content = $this->get_content_language($lang);
		$str = @$content['general'];
		if(isset($content[$key])){
			return $content[$key];
		}
		return $str;
	}
	
	function get_languages(){
		$file = $this->source . $this->file_conf . $this->ext;
		
		$content = array();
		if(file_exists($file)){
			$content = parse_ini_file($file);
		}
		return $content;
	}
	
	
	function set_languages(){
		$this->languages = array(
				'vi' => 'Tiếng Việt',
				'en' => 'English',
		);
		return $this->languages;
	}


	function get_lang_name($cur_lang) {
		$lang_name = 'Tiếng Việt';
		foreach ($this->languages as $k => $v) {
			if ($k == $cur_lang) {
				$lang_name = $v;
			}
		}
		return $lang_name;
	}
	
	
	function check_exist_language($lang){
		if(!in_array($lang, $this->languages))
			return false;
		
		$file = $this->source . $lang . $this->ext;
		if(file_exists($file))
			return true;
		return false;
	}
	
	
}