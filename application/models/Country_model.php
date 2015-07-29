<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function delete_country($id=0)
    {
        $this->db->where('id', $id);
        $this->db->delete('countries');

        return $this->db->affected_rows();
    }

    function insert_country($name='', $iso2='')
    {
        $data = array(
            'name' => $name,
            'iso2' => $iso2
        );
        $this->db->insert('countries', $data);

        return $this->db->insert_id();
    }

    function edit_country($name='', $iso2='', $id=0)
    {
        $data = array(
            'name' => $name,
            'iso2' => $iso2
        );
        $this->db->where('id', $id);
        $this->db->update('countries', $data);
        
        return $this->db->affected_rows();
    }

}