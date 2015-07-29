<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('country_model');
    }

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
		if(ctype_digit($id))
		{
			$this->country_model->delete_country($id);
			$this->session->set_flashdata('data','Country deleted successfully with ID:'.$id);
		}
		redirect('country');
	}

	public function add()
	{
		$data = array('page_title' => 'Add Country - Viral Vadgama');

		$data['country_name'] = '';
		$data['iso2'] = '';
		
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('country_name', 'Country Name', 'required|min_length[3]');
			$this->form_validation->set_rules('iso2', 'ISO2 Name', 'required|exact_length[2]');

			if($this->form_validation->run() !== FALSE)
			{
				$insert_id = $this->country_model->insert_country(
								$this->input->post('country_name'),
								$this->input->post('iso2')
							);
				$this->session->set_flashdata('data','Country added successfully with ID:'.$insert_id);
				redirect('country');
			}
			else
			{
				$data['country_name'] = $this->input->post('country_name');
				$data['iso2'] = $this->input->post('iso2');
			}
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('country/add', $data);
		$this->load->view('templates/footer', $data);
	}

	public function edit($id=0)
	{
		$data = array('page_title' => 'Edit Country - Viral Vadgama');

		if(!ctype_digit($id)) return;

		$current = $this->db->get_where('countries', array('id' => $id))->row();

		$data['country_name'] = $current->name;
		$data['iso2'] = $current->iso2;
		$data['id'] = $id;
		
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('country_name', 'Country Name', 'required|min_length[3]');
			$this->form_validation->set_rules('iso2', 'ISO2 Name', 'required|exact_length[2]');

			if($this->form_validation->run() !== FALSE)
			{
				$edit_id = $this->country_model->edit_country(
								$this->input->post('country_name'),
								$this->input->post('iso2'),
								$id
							);
				$this->session->set_flashdata('data','Country edited successfully with ID:'.$edit_id);
				redirect('country');
			}
			else
			{
				$data['country_name'] = $this->input->post('country_name');
				$data['iso2'] = $this->input->post('iso2');
			}
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('country/edit', $data);
		$this->load->view('templates/footer', $data);
	}
}
