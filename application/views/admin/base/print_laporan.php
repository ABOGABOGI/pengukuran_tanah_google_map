<!doctype html>
<html class="no-js" lang="zxx">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>/assets/user/assets/img/logo/logos.png">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
  <title>LUas Tanah</title>
  
</head>
<body>

<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive"> 
          <table> 
            <thead> 
              <tr style="border:none;">
                <td style="width: 20%">
                  <img src="assets/logo/bpn.png" style="width: 50px">
                </td>
                <td style="width: 70%" class="text-center">
                  <label>Laporan Luas Tanah</label>
                </td>
                <td style="width: 10%">
                  <!-- <img src="assets/user/assets/img/hero/unnamed.png" style="width: 90px; max-height: 100px;"> -->
                </td>
              </tr>
            </thead>
          </table>
        </div>
        <hr style="margin: 0; padding: 0; margin-top: 10px; margin-bottom: 10px;">
        <table class="table center-aligned-table">
          <tr>
            <td style="width: 30%";padding:5px;>
             Nama Pengguna
            </td>
            <td style="width: 2%;padding:5px;">
              :
            </td>
            <td style="width: 78%;padding:5px;">
              <?=$data['nama']?>
            </td>
          </tr>
          <tr>
            <td style="width: 30%;padding:5px;">
             Nama Proyek
            </td>
            <td style="width: 2%;padding:5px;">
              :
            </td>
            <td style="width: 78%;padding:5px;">
              <?=$data['nama_project']?>
            </td>
          </tr>
          <tr>
            <td style="width: 30%;padding:5px;">
             Luas Tanah
            </td>
            <td style="width: 2%;padding:5px;">
              :
            </td>
            <td style="width: 78%;padding:5px;">
              <?=$data['luas_total']?>
            </td>
          </tr>
          <tr>
            <td style="width: 30%;padding:5px;">
             Tanggal
            </td>
            <td style="width: 2%;padding:5px;">
              :
            </td>
            <td style="width: 78%;padding:5px;">
              <?=$data['tgl']?>
            </td>
          </tr>
        </table>
        <hr>
        <h5>Polygon Map</h5>
        <img src="<?=$imgData?>" style="width: 100%">
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>