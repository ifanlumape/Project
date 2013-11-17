<?php 
class Captcha_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha', '', TRUE);
	}
	
	function generate_captcha()
	{
		$captcha = array(
			'word' => '',
			'img_path' => realpath('captcha').'/',
			'img_url' => base_url().'captcha/',
			'font_path' => base_url().'system/fonts/mvboli.ttf',
			'img_width' => '150',
			'img_height' => 50,
			'expiration' => 3600
			);
			return create_captcha($captcha);
	}
}
?>