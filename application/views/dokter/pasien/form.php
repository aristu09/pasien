<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>No Rekam Medis</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Tgl Lahir</th>
                <th>Nama Suami</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $pasien): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pasien['id_pasien'] ?></td>
                <td><?= $pasien['nama'] ?></td>
                <td><?= $pasien['no_hp'] ?></td>
                <td><?= $pasien['alamat'] ?></td>
                <td><?= $pasien['tgl_lahir'] ?></td>
                <td><?= $pasien['nama_suami'] ?></td>
                <td><?= $pasien['email'] ?></td>

            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <?php $this->load->view('template/footer'); ?>

<?php 

function hitung_usia($tanggal_lahir){
    list($year,$month,$day) = explode("-",$tanggal_lahir);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) {
        $year_diff--;
    } elseif (($month_diff==0) && ($day_diff < 0)) {
        $year_diff--;
    }
    return $year_diff;
}

//format hanya menampilkan tanggal bulan dan tahun
function tgl_indo($tanggal){
    $tgl = substr($tanggal, 8, 2);
      $bln = array (
          1 =>   'Januari',
          2 =>   'Februari',
          3 =>   'Maret',
          4 =>   'April',
          5 =>   'Mei',
          6 =>   'Juni',
          7 =>   'Juli',
          8 =>   'Agustus',
          9 =>   'September',
          10 =>   'Oktober',
          11 =>   'November',
          12 =>   'Desember'
      );
      $bulan = $bln[(int)substr($tanggal, 5, 2)];
      $tahun = substr($tanggal, 0, 4);
      return $tgl.' '.$bulan.' '.$tahun;
  }
  
?>