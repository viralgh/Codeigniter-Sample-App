<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('city_model');
    }

	public function index()
	{
		$data = array('page_title' => 'Cities - Viral Vadgama');
 
		$data['city_data'] = $this->city_model->get_cities();

		$this->load->view('templates/header', $data);
		$this->load->view('city/list', $data);
		$this->load->view('templates/footer', $data);
	}

	public function delete($id=0)
	{
		if(ctype_digit($id))
		{
			$this->city_model->delete_city($id);
			$this->session->set_flashdata('data','City deleted successfully with ID:'.$id);
		}
		redirect('city');
	}

	public function add()
	{
		$data = array('page_title' => 'Add City - Viral Vadgama');

		$data['city_name'] = '';
		$data['state_id'] = '';
		$data['country_id'] = '';
		
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('city_name', 'City Name', 'required|min_length[3]');
			$this->form_validation->set_rules('country_id', 'Country', 'required');
			$this->form_validation->set_rules('state_id', 'State', 'required');

			if($this->form_validation->run() !== FALSE)
			{
				$insert_id = $this->city_model->insert_city(
								$this->input->post('city_name'),
								$this->input->post('state_id')
							);
				$this->session->set_flashdata('data','City added successfully with ID:'.$insert_id);
				redirect('city');
			}
			else
			{
				$data['city_name'] = $this->input->post('city_name');
				$data['state_id'] = $this->input->post('state_id');
				$data['country_id'] = $this->input->post('country_id');
			}
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('city/add', $data);
		$this->load->view('templates/footer', $data);
	}

	public function edit($id=0)
	{
		$data = array('page_title' => 'Edit City - Viral Vadgama');

		if(!ctype_digit($id)) redirect('city');

		$current = $this->city_model->get_cities($id);

		if(!$current) redirect('city');

		$data['city_name'] = $current->city_name;
		$data['state_id'] = $current->state_id;
		$data['country_id'] = $current->country_id;
		$data['id'] = $id;
		
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('city_name', 'City Name', 'required|min_length[3]');
			$this->form_validation->set_rules('country_id', 'Country', 'required');
			$this->form_validation->set_rules('state_id', 'State', 'required');

			if($this->form_validation->run() !== FALSE)
			{
				$insert_id = $this->city_model->edit_city(
								$this->input->post('city_name'),
								$this->input->post('state_id'),
								$id
							);
				$this->session->set_flashdata('data','City edited successfully with ID:'.$id);
				redirect('city');
			}
			else
			{
				$data['city_name'] = $this->input->post('city_name');
				$data['state_id'] = $this->input->post('state_id');
				$data['country_id'] = $this->input->post('country_id');
			}
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('city/edit', $data);
		$this->load->view('templates/footer', $data);
	}

	function state_ajax()
	{
		$cid = $this->input->post('country_id');

		if($cid && ctype_digit($cid))
		{
			$data['states'] = get_states_by_country_id($cid);
			$data['selected'] = $this->input->post('selected');

			$this->load->view('city/state_ajax', $data);
		}
	}
}
