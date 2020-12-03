<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Data Pengukuran Bidang </title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
  <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>
</head>

<!-- pengaturan format tanggal -->
<?php
$tangal = date('d-m-Y') ;
$tgl = explode("-", $tangal);

$tgll =  $tgl[0];
$bln =   $tgl[1];
$thn =   $tgl[2];
if ($bln == '01') {
  $bln ="Januari";
}elseif($bln == '02'){
  $bln ="Februari";
}elseif($bln == '03'){
  $bln ="Maret";
}elseif($bln == '04'){
  $bln ="April";
}elseif($bln == '05'){
  $bln ="Mei";
}elseif($bln == '06'){
  $bln ="Juni";
}elseif($bln == '07'){
  $bln ="Juli";
}elseif($bln == '08'){
  $bln ="Agustus";
}elseif($bln == '09'){
  $bln ="September";
}elseif($bln == '10'){
  $bln ="Oktober";
}elseif($bln == '11'){
  $bln ="November";
}elseif($bln == '12'){
  $bln ="Desember";
}
$all= $tgll." ".$bln." ".$thn;
$blnthn= $bln." ".$thn;
?>

<body >
  <div class="container-fluid">
    <table> 
      <thead> 
        <tr style="border:none;">
          <td style="width: 20%">
            <img src="assets/logo/bpn.png" style="width: 50px">
          </td>
          <td style="width: 70%" class="text-center">
            <label style="margin-left: 20px;">Laporan Luas Tanah</label>
          </td>
          <td style="width: 10%">
            <!-- <img src="assets/user/assets/img/hero/unnamed.png" style="width: 90px; max-height: 100px;"> -->
          </td>
        </tr>
      </thead>
    </table>

    <hr class="line-title">

    <table style="width: 100%;">
      <tr>
        <td align="center">
          <!-- <font size="16">LAPORAN KUNJUNGAN PENYULUH KE KELOMPOK TANI</font> --}} -->
        </td>
      </tr>
    </table>

    <h5 style="font-size: 12px;">Bulan : <?php echo $blnthn;?></h5>
    <table align="center" width="100%" border="1" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pengguna</th>
          <th>Nama Proyek</th>
          <th>Luas Tanah</th>
          <th>Tanggal</th>
        </tr>
        
      </thead>

      <tbody class="text-center">

        <?php $i=1; foreach ($print as $value) {?>
       
        <tr>
          <td><?=$i++?></td>
          <td><?=$value['nama']?></td>
          <td><?=$value['nama_project']?></td>
          <td><?=$value['luas_total']?></td>
          <td><?=$value['tanggal']?></td>
        </tr>

      <?php } ?>




    </tbody>
  </table>

  <br>

  <table style="width: 100%;">
    <tr>
      <td  style="border:none;" align="right">
        <span style="font-size: 10px">Catatan</span>
      </td>
    </tr>
  </table>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>