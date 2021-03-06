<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_lab_medical_record extends CI_Model {

  function __construct() 
  {
    parent::__construct();
  }
  function get_table() 
  {
    $table = 'lab_medical_record';
    return $table;
  }

  function get($order_by)
  {
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
  }

  function get_with_limit($limit, $offset, $order_by) 
  {
    $table = $this->get_table();
    $this->db->limit($limit, $offset);
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
  }

  function get_where($no_order)
  {
    $data = $this->db->get_where('lab_medical_record',array('no_order'=>$no_order));
    if($data->num_rows()==1){
        return $data->row_array();
    }else{
        return FALSE;
    }
  }


  function get_where_custom($nama) 
  {
    $table = $this->get_table();
    $this->db->select('no_order, nama_prov');
    $this->db->like('nama_prov', $nama, 'both');
    $this->db->order_by('no_order','asc');
    //$this->db->limit(10, 0);
    $query=$this->db->get($table);
    return $query->result_array();
  }

  function get_where_custom2($col, $value) 
  {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $this->db->order_by('inc','asc');
    $query=$this->db->get($table);
    return $query->result_array();
  }

  function _insert($data)
  {
    $table = 'lab_medical_record';
    $this->db->insert($table, $data);
  }


  function _update($no_order, $data)
  {
    $table = 'lab_medical_record';
    $this->db->where('no_order', $no_order);
    $this->db->update($table, $data);
  }

  function _delete($no_order)
  {
    $table = 'lab_medical_record';
    $this->db->where('no_order', $no_order);
    $this->db->delete($table);
  }

  function count_where($column, $value) 
  {
    $table = $this->get_table();
    $this->db->where($column, $value);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
  }

  function count_filter_where($no_order) 
  {
   $out =  $this->db->query("SELECT `no_order`, `pemeriksaan`, `nilai`, `nilai_normal`, `inc`, `isNormal`, `not_used_1`, `not_used_2`, `not_used_3`, `not_used_4`, `not_used_5`, `not_used_6` FROM `lab_medical_record` WHERE no_order = $no_order ORDER BY `no_order`");
    $num_rows = $out->num_rows();
    return $num_rows;
  }


  function count_all() 
  {
    $table = $this->get_table();
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
  }

  function get_max() 
  {
    $table = $this->get_table();
    $this->db->select_max('no_order');
    $query = $this->db->get($table);
    $row=$query->row();
    $no_order=$row->no_order;
    return $no_order;
  }

  function _custom_query($mysql_query) 
  {
    $query = $this->db->query($mysql_query);
    return $query;
  }

  function get_all()
  {
    $query = $this->db->get('lab_periksa');
    return $query->result_array();
  }


  public function fetch_item_pemeriksaan($limit, $start,$no_order) 
  {

    $out =  $this->db->query("SELECT `no_order`, `pemeriksaan`, `nilai`, `nilai_normal`, `inc`, `isNormal`, `not_used_1`, `not_used_2`, `not_used_3`, `not_used_4`, `not_used_5`, `not_used_6` FROM `lab_medical_record` WHERE no_order = $no_order ORDER BY `no_order` DESC LIMIT $start,$limit");

    if($out->num_rows()>0)
    {
      return $out->result_array();
    }
  }

}  