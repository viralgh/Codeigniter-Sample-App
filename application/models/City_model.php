<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_cities($id=0)
    {
        $this->db->select('ci.id as city_id, ci.name as city_name, ci.state_id as state_id,
                            s.name as state_name, s.id as state_id, s.country_id as country_id,
                            c.name as country_name, c.iso2 as iso2');
        $this->db->from('cities ci');
        $this->db->join('states s', 's.id=ci.state_id', 'left');
        $this->db->join('countries c', 's.country_id=c.id', 'left');
        if($id)
        {
            $this->db->where('ci.id', $id);
            return $this->db->get()->row();
        }
        $this->db->order_by('ci.id');
        return $this->db->get()->result();
    }
    
    function delete_city($id=0)
    {
        $this->db->where('id', $id);
        $this->db->delete('cities');

        return $this->db->affected_rows();
    }

    function insert_city($name='', $state_id='')
    {
        $data = array(
            'name' => $name,
            'state_id' => $state_id
        );
        $this->db->insert('cities', $data);

        return $this->db->insert_id();
    }

    function edit_city($name='', $state_id='', $id=0)
    {
        $data = array(
            'name' => $name,
            'state_id' => $state_id
        );
        $this->db->where('id', $id);
        $this->db->update('cities', $data);
        
        return $this->db->affected_rows();
    }

}