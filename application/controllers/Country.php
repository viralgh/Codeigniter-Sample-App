<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$data = array('page_title' => 'Countries - Viral Vadgama');
 
		$data['country_data'] = $this->db->get('countries')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('country/list', $data);
		$this->load->view('templates/footer', $data);
	}

	public function delete($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('countries');

		$this->session->set_flashdata('data','Country deleted successfully with ID:'.$id);
		redirect('country');
	}
}
