<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function home()
	{
		$data = array('page_title' => 'Codeigniter Sample App - Viral Vadgama');
 
		$this->load->view('templates/header', $data);
		$this->load->view('content', $data);
		$this->load->view('templates/footer', $data);
	}
}
