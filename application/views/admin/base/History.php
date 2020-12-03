 <div class="dashboard-wrapper">
  	<div class="container-fluid  dashboard-content">
  		<div class="row">
  			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  				<?php foreach ($all as $value) {?>
  				<div class="card influencer-profile-data">
  					<div class="card-body" style="padding: 10px;">
  						<span>
  							<label class="float-left" style="margin: 0; margin-right: 10px;">Nama Project : <?=$value['nama_project']?></label> <span class="badge badge-info"><label style="margin: 0; color: #fff;">Luas Tanah :<?=$value['luas_total']?></label></span>&nbsp;<span class="badge badge-secondary"><label style="margin: 0; color: #fff">Tanggal : <?=$value['tanggal']?></label></span>
  							<a href="<?=base_url('Admin/Hapus/').$value['id']?>" class="btn btn-danger btn-xs float-right">
  								<i class="fa fa-trash  float-right"> Hapus</i>
  							</a>

  							<a href="<?=base_url('Admin/viewAndEdit/').$value['nama_project']?>" class="btn btn-primary btn-xs float-right">
  								<i class="fas fa-map-marker-alt  float-right"> View</i>
  							</a>
  						</span>
  						
  					</div>
  				</div>
  			<?php } ?>

  			</div>
  		</div>
  	</div>
  </div>

