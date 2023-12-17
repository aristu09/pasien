<?php 

/**
* 
*/
class M_count extends CI_model
{

private $table  = 'tb_pasien';
private $table2 = 'tb_periksa';

//count_periksa
public function count_periksa($tgl='')
{
  $this->db->select ('*');
  $this->db->from ($this->table2);
  $this->db->where ('tgl_periksa', $tgl);
  $this->db->where_in('status', array('PV', 'ANTRI', 'DIPERIKSA', 'S'));
    return $this->db->get()->num_rows();
}

//count_pasien
public function count_pasien($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
    return $this->db->get()->num_rows();
}


}