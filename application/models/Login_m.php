<?php 
/*model design by Ismarianto Putra Tech Programing
 * http://minangopensource.blogspot.com 
 *
 *
*/
class login_m extends CI_model
{
	
 public function admin($nama='', $email='', $no_hp='', $password='')
 {
  return $this->db->query("SELECT * from tb_admin where (nama='$nama' OR email='$email' OR no_hp='$no_hp') AND password='$password' limit 1");
 }

 public function dokter($nama='', $email='', $no_hp='', $password='')
    {
    return $this->db->query("SELECT * from tb_dokter where (nama='$nama' OR email='$email' OR no_hp='$no_hp') AND password='$password' limit 1");
    }

public function pasien ($nama='', $email='', $no_hp='', $password='')
    {
    return $this->db->query("SELECT * from tb_pasien where (nama='$nama' OR email='$email' OR no_hp='$no_hp') AND password='$password' limit 1");
    }

}