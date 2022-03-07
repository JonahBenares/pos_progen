<?php
class item_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function select_item($table, $where){
    
        $this->db->select('item_name');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        $count=$query->num_rows();
        echo $count;
      
    }


    function search($keyword)
    {
        $this->db->like('items',$keyword);
        $query = $this->db->get();
        return $query->result();
    }


} ?>