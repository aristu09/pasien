<?php 

/**
* 
*/
class M_dokter extends CI_model
{

private $table = 'tb_dokter';

//dokter
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_dokter', $id)->get ();
}

//mengambil id dokter urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_dokter');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_dokter', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_dokter', $id);
  return $this->db-> delete($this->table);
}

//untuk page dokter login
public function view_id_dokter($id='')
{
  //join table tb_dokter dan tb_paket di dokter
  $id = $this->session->userdata['id_dokter'];
  $this->db->select('*');
  $this->db->from($this->table);
  $this->db->where('id_dokter', $id);
  $this->db->order_by('id_dokter');
  return $this->db->get();
}

}