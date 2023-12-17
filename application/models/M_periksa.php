<?php 

/**
* 
*/
class M_periksa extends CI_model
{

private $table1 = 'tb_periksa';
private $table2 = 'tb_pasien';

//antrian
public function viewAntrian($tgl='')
{
  //hanya membaca Y-m-d saja dari database tanpa jam
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('tgl_periksa', $tgl);
  $this->db->where_in('status', array('ANTRI', 'DIPERIKSA'));
  $this->db->order_by('id_antrian', 'ASC');
  return $this->db->get();
}

public function viewVerifikasi($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('status', 'PV');
  $this->db->order_by('id_antrian', 'ASC');
  return $this->db->get();
}

public function viewSudah($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('status', 'S');
  $this->db->order_by('id_antrian', 'DESC');
  return $this->db->get();
}

public function viewBatal($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('status', 'BTL');
  $this->db->order_by('id_antrian', 'DESC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table1)->where ('id_antrian', $id)->get ();
}

//mengambil id antrian urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_antrian');
  $this->db->from ($this->table1);
}
//mengambil no antrian terakhir
public function no_antrian($value='')
{ 
  $this->db->select('no_antrian');
  $this->db->from ($this->table1);
  $this->db->order_by('tgl_periksa', 'DESC');
  $this->db->limit(1);
}

//mengambil kode antrian terakhir
public function kode_antrian($value='')
{
  $this->db->select('no_antrian');
  $this->db->from ($this->table1);
  $this->db->order_by('tgl_periksa', 'DESC');
  $this->db->limit(1);
}


public function add($SQLinsert){
  return $this -> db -> insert($this->table1, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_antrian', $id);
  return $this->db-> update($this->table1, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_antrian', $id);
  return $this->db-> delete($this->table1);
}


//untuk form pasien
//antrian
public function viewAntrianPasien($tgl='')
{
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('tgl_periksa', $tgl);
  $this->db->where_in('status', array('PV', 'ANTRI', 'DIPERIKSA', 'S'));
  $this->db->order_by('id_antrian', 'ASC');
  return $this->db->get();
}

//namaAntrian
public function namaAntrian($tgl='')
{
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('tgl_periksa', $tgl);
  $this->db->where('status', 'DIPERIKSA');
  $this->db->order_by('id_antrian', 'ASC');
  $this->db->limit(1);
  return $this->db->get();
}

public function view_id_periksa($id='')
{
  $id = $this->session->userdata['id_pasien'];
  $this->db->select ('*');
  $this->db->from ($this->table1);
  $this->db->join ($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('tb_periksa.id_pasien', $id);
  $this->db->order_by('id_antrian', 'DESC');
  return $this->db->get();
}

public function verifikasi($uuid='',$SQLupdate){
  $this->db->where('uuid', $uuid);
  return $this->db-> update($this->table1, $SQLupdate);
}


}