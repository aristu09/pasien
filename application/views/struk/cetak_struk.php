<!DOCTYPE html>
<html lang="en">
<?php 
if($aksi == "cetak_struk_bulanan"):
?>
<head>
    <title>Nota KassandraWiFi Bulan <?= $bulan;?> <?= htmlentities($id_tagihan); ?> <?= $nama; ?>
    </title>
    <link rel="shortcut icon" href="<?= base_url('themes/kassandra-wifi') ?>/img/favicon.ico" type="image/x-icon">  
    <meta name="keywords" content="wifi kassandra my id, kassandra my id, kassandra wifi, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description" content="Layanan hotspot wifi unlimited 24 jam non stop tanpa lemot kecuali saat wifi down">
</head>

<body>
    <font face="Courier New" size="2px">

        <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
        </style>
        </head>

        <body style='font-family:tahoma; font-size:8pt;'>
            <center>
                <table id="example1" class="table table-bordered table-striped" border="0" cellspacing="1"
                    style="width: 100%">
                    <thead>

                        <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                            <span style='font-size:12pt'><b><u>KASSANDRAWIFI</u></b></span></br>
                            Alamat Jl. H. Agus Salim 07/03 Ds. Jalen Kec. Balong Kab. Ponorogo ( 63461 ) </br>
                            Telp / Wa : 081456141227<br>
                            Email : kassandramikrotik@gmail.com
                        </td>
                        <td style='vertical-align:top' width='30%' align='left'>
                            <b><span style='font-size:12pt'>Nota Pembayaran Iuran Bulanan KassandraWiFi</span></b></br>
                            No Tagihan : <?= htmlentities($id_tagihan); ?></br>
                            Bulan Tagihan : <?= $bulan; ?> / <?= $tahun; ?></br></br>
                        </td>
                </table><br><br>
                <table id="example1" class="table table-bordered table-striped" border="0" cellspacing="1"
                    style="width: 100%">
                    <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                        Nama Pelanggan : <?= $nama; ?></br>
                        Alamat : <?= $alamat; ?><br>
                        No Telp / Wa : <?= $no_hp; ?>
                    </td>
                </table>
                <table id="example1" class="table table-bordered table-striped" border="1" cellspacing="1"
                    style="width: 100%">

                    <tr>
                        <th>Paket Internet</th>
                        <td>
                            <?= $id_paket; ?> | <?= $paket; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Deskripsi Tagihan</th>
                        <td>
                            Iuran Hotspot WiFi Bulan <?= $bulan; ?> / <?= $tahun; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Total Biaya</th>
                        <td>
                            <?= rupiah($tagihan); ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <?php $stt = $status  ?>
                            <?php if($stt == 'BL'){ ?>
                            <span class="label label-danger"><b>Belum Di Bayar</b></span>
                            <?php }elseif($stt == 'LS'){ ?>
                            <span class="label label-info">Lunas</span>
                        </td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <th>Tanggal Bayar</th>
                        <td>
                            <?php $tgl = $tgl_bayar  ?>
                            <?php if($tgl == '0000-00-00'){ ?>
                            <span class=""><b>-- / -- / ----</b></span>
                            <?php }elseif($tgl = $tgl_bayar){ ?>
                            <span class=""><?= tgl_indo($tgl_bayar); ?></span>
                        </td>
                        <?php } ?>
                    </tr>
                </table>

                <table style='width:650; font-size:8pt;' cellspacing='2'>
                    <tr>
                        <td align='center'>Ponorogo, <?= tgl_indo(date('Y-m-d')); ?></td>
                    </tr>
                    <tr>
                        <td align='center'>Diterima Oleh,<br><br><br><br><br>(<u>.................</u>)</td>
                        <td style='border:0px solid black; padding:5px; text-align:left; width:40%'></td>
                        <td align='center'>Admin,<br>
                            <img src="<?= base_url('themes/kassandra-wifi') ?>/img/img/ttd-erik.jpg" style="width: 40px; height: 40px;"><br>
                            (<u>Kassandra WiFi</u>)
                        </td>
                    </tr>

                    </thead>
                </table>
            </center>

<?php 
elseif($aksi == "cetak_struk_tagihan_lain"):
?>	
<head>
    <title>Nota KassandraWiFi <?= htmlentities($id_tagihan_lain); ?> <?= $nama; ?>
    </title>
    <link rel="shortcut icon" href="../dist/img/favicon.ico" type="image/x-icon">
</head>

<body>
    <font face="Courier New" size="2px">

        <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
        </style>
        </head>

        <body style='font-family:tahoma; font-size:8pt;'>
            <center>
                <table id="example1" class="table table-bordered table-striped" border="0" cellspacing="1"
                    style="width: 100%">
                    <thead>

                        <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                            <span style='font-size:12pt'><b><u>KASSANDRAWIFI</u></b></span></br>
                            Alamat Jl. H. Agus Salim 07/03 Ds. Jalen Kec. Balong Kab. Ponorogo ( 63461 ) </br>
                            Telp / Wa : 081456141227<br>
                            Email : kassandramikrotik@gmail.com
                        </td>
                        <td style='vertical-align:top' width='30%' align='left'>
                            <b><span style='font-size:12pt'>Nota Pembayaran Iuran Bulanan KassandraWiFi</span></b></br>
                            No Tagihan : <?= htmlentities($id_tagihan_lain); ?></br>
                        </td>
                </table><br><br>
                <table id="example1" class="table table-bordered table-striped" border="0" cellspacing="1"
                    style="width: 100%">
                    <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                        Nama Pelanggan : <?= $nama; ?></br>
                        Alamat : <?= $alamat; ?><br>
                        No Telp / Wa : <?= $no_hp; ?>
                    </td>
                </table>
                <table id="example1" class="table table-bordered table-striped" border="1" cellspacing="1"
                    style="width: 100%">

                    <tr>
                        <th>Deskripsi Tagihan</th>
                        <td>
                            <?= $keterangan; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Total Biaya</th>
                        <td>
                            <?= rupiah($tagihan); ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <?php $stt = $status  ?>
                            <?php if($stt == 'BL'){ ?>
                            <span class="label label-danger"><b>Belum Di Bayar</b></span>
                            <?php }elseif($stt == 'LS'){ ?>
                            <span class="label label-info">Lunas</span>
                        </td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <th>Tanggal Bayar</th>
                        <td>
                            <?php $tgl = $tgl_bayar  ?>
                            <?php if($tgl == '0000-00-00'){ ?>
                            <span class=""><b>-- / -- / ----</b></span>
                            <?php }elseif($tgl = $tgl_bayar){ ?>
                            <span class=""><?= tgl_indo($tgl_bayar); ?></span>
                        </td>
                        <?php } ?>
                    </tr>
                </table>

                <table style='width:650; font-size:8pt;' cellspacing='2'>
                    <tr>
                        <td align='center'>Ponorogo, <?= tgl_indo(date('Y-m-d')); ?></td>
                    </tr>
                    <tr>
                        <td align='center'>Diterima Oleh,<br><br><br><br><br>(<u>.................</u>)</td>
                        <td style='border:0px solid black; padding:5px; text-align:left; width:40%'></td>
                        <td align='center'>Admin,<br>
                            <img src="<?= base_url('themes/kassandra-wifi') ?>/img/img/ttd-erik.jpg" style="width: 40px; height: 40px;"><br>
                            (<u>Kassandra WiFi</u>)
                        </td>
                    </tr>

                    </thead>
                </table>
            </center>

        </body>

</html>

<?php endif; ?>

<script>
  window.print();
</script>
<?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

//format tanggal indonesia
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
  
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>