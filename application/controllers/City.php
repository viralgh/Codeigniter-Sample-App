<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('state_model');
    }

	public function index()
	{
		$data = array('page_title' => 'Cities - Viral Vadgama');
 
		$data['state_data'] = $this->state_model->get_states();

		$this->load->view('templates/header', $data);
		$this->load->view('city/list', $data);
		$this->load->view('templates/footer', $data);
	}

	public function delete($id=0)
	{
		if(ctype_digit($id))
		{
			$this->state_model->delete_state($id);
			$this->session->set_flashdata('data','State deleted successfully with ID:'.$id);
		}
		redirect('state');
	}

	public function add()
	{
		$data = array('page_title' => 'Add State - Viral Vadgama');

		$data['state_name'] = '';
		$data['state_id'] = '';
		$data['country_id'] = '';
		
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('state_name', 'State Name', 'required|min_length[3]');
			$this->form_validation->set_rules('country_id', 'Country', 'required');

			if($this->form_validation->run() !== FALSE)
			{
				$insert_id = $this->state_model->insert_state(
								$this->input->post('state_name'),
								$this->input->post('country_id')
							);
				$this->session->set_flashdata('data','State added successfully with ID:'.$insert_id);
				redirect('state');
			}
			else
			{
				$data['state_name'] = $this->input->post('state_name');
				$data['country_id'] = $this->input->post('country_id');
			}
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('state/add', $data);
		$this->load->view('templates/footer', $data);
	}

	public function edit($id=0)
	{
		$data = array('page_title' => 'Edit State - Viral Vadgama');

		if(!ctype_digit($id)) redirect('state');

		$current = $this->state_model->get_states($id);

		if(!$current) redirect('state');

		$data['state_name'] = $current->sname;
		$data['state_id'] = $current->sid;
		$data['country_id'] = $current->cid;
		
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('state_name', 'State Name', 'required|min_length[3]');
			$this->form_validation->set_rules('country_id', 'Country', 'required');
			$this->form_validation->set_rules('state_id', 'State ID', 'required');

			if($this->form_validation->run() !== FALSE)
			{
				$edit_id = $this->state_model->edit_state(
								$this->input->post('state_name'),
								$this->input->post('country_id'),
								$id
							);
				$this->session->set_flashdata('data','State edited successfully with ID:'.$id);
				redirect('state');
			}
			else
			{
				$data['state_name'] = $this->input->post('state_name');
				$data['state_id'] = $current->sid;
				$data['country_id'] = $this->input->post('country_id');
			}
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('state/edit', $data);
		$this->load->view('templates/footer', $data);
	}
}
