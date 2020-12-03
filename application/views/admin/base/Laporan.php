<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Laporan <a href="<?=base_url('Admin/pdf/').$get?>" class="float-right btn btn-success btn-sm"><i class="fa fa-print"></i> Print</a></h5>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text"  id="dates" class="form-control">
                            <div class="input-group-append">
                                <button type="button" id="cari" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Project</th>
                                    <th scope="col">Luas Tanah</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($all as $value) {?>
                                    <tr>
                                        <th scope="row"><?=$i++?></th>
                                        <td><?=$value['nama_project']?></td>
                                        <td><?=$value['luas_total']?></td>
                                        <td><?=$value['tanggal']?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
