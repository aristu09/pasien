<?php 

/**
* 
*/
class M_pasien extends CI_model
{
    private $table1 = 'tb_pasien';

//pasien	
public function view($value='')
{
    //join table pasien dan periode
    $this->db->select('*');
    $this->db->from($this->table1);
    $this->db->order_by('nama');
    return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table1)->where ('id_pasien', $id)->get ();
}

//mengambil id pasien urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_pasien');
  $this->db->from ($this->table1);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_pasien', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

//delete 2 table
public function delete($id=''){
  $this->db->where('id_pasien', $id);
  return $this->db-> delete($this->table1);
}


//untuk page pasien
public function view_id_pasien($id='')
{
  //join table pasien dan periode di pasien
  $id = $this->session->userdata['id_pasien'];
  $this->db->select('*');
  $this->db->from($this->table1);
  $this->db->where('id_pasien', $id);
  $this->db->order_by('id_pasien');
  return $this->db->get();
}



}
