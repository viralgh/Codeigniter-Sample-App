<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_states($id=0)
    {
        $this->db->select('s.name as sname, c.name as cname, c.id as cid, s.id as sid, c.iso2 as iso2');
        $this->db->from('states s');
        $this->db->join('countries c', 's.country_id=c.id', 'left');
        if($id)
        {
            $this->db->where('s.id', $id);
            return $this->db->get()->row();
        }
        $this->db->order_by('s.id');
        return $this->db->get()->result();
    }
    
    function delete_state($id=0)
    {
        $this->db->where('id', $id);
        $this->db->delete('states');

        return $this->db->affected_rows();
    }

    function insert_state($name='', $country_id='')
    {
        $data = array(
            'name' => $name,
            'country_id' => $country_id
        );
        $this->db->insert('states', $data);

        return $this->db->insert_id();
    }

    function edit_state($name='', $country_id='', $id=0)
    {
        $data = array(
            'name' => $name,
            'country_id' => $country_id
        );
        $this->db->where('id', $id);
        $this->db->update('states', $data);
        
        return $this->db->affected_rows();
    }

}