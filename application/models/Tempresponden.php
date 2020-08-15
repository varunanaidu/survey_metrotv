<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Tempresponden extends CI_Model{

    /*** DATATABLE SERVER SIDE FOR OUTBOUND ***/
    function _get_applicant_query($data=''){
        $__order 			= array('tab_responden.resp_id' => 'ASC');

        $__column_search 	= array('tab_responden.resp_id', 'resp_ph', 'resp_name', 'resp_email', 'prov_title');
        $__column_order 	= array('tab_responden.resp_id', 'resp_ph', 'resp_name', 'resp_email', 'prov_title');

        $this->db->select('tab_responden.resp_id, resp_ph, resp_name, resp_email, prov_title');
        $this->db->from('tab_responden');
        $this->db->join('tab_province', 'tab_responden.prov_id = tab_province.prov_id', 'left');
        $this->db->where_not_in
        $this->db->where

        $i = 0;
        $search_value = $this->input->post('search')['value'];
        foreach ($__column_search as $item){
         if ($search_value){
                if ($i === 0){ // looping awal
                	$this->db->group_start(); 
                	$this->db->like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                else{
                	$this->db->or_like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                if (count($__column_search) - 1 == $i) $this->db->group_end(); 
            }
            $i++;
        }

        /* order by */
        if ($this->input->post('order') != null){
        	$this->db->order_by($__column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if (isset($__order)){
        	$order = $__order;
        	$this->db->order_by(key($order), $order[key($order)]);
        }

    }

    function get_applicant($data=''){
        if ($data != '') {
            $this->_get_applicant_query($data);
        }else{
            $this->_get_applicant_query();
        }
        if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function get_applicant_count_filtered(){
    	$this->_get_applicant_query();
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function get_applicant_count_all(){
    	$this->db->from('tab_responden');
    	return $this->db->count_all_results();
    }
}