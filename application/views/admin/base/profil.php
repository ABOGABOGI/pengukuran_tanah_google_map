  <div class="dashboard-wrapper">
  	<div class="container-fluid  dashboard-content">
  		<div class="row">
  			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  				<div class="card influencer-profile-data">
  					<div class="card-body">
  						<div class="row">
  							<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
  								<div class="text-center">
  									<img src="<?=empty($profil)?base_url('assets/concept-master/assets/images/avatar-1.jpg'):base_url('assets/upload/').$profil['image']?>" alt="User Avatar" class="rounded-circle user-avatar-xxl">
  								</div>
  							</div>
  							<div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
  								<div class="user-avatar-info">
  									<div class="m-b-20">
  										<div class="user-avatar-name">
  											<h2 class="mb-1"><?=empty($profil)?$nama:$profil['nama'] ?></h2>
  										</div>
  									</div>
  									<!--  <div class="float-right"><a href="#" class="user-avatar-email text-secondary">www.henrybarbara.com</a></div> -->
  									<div class="user-avatar-address">
  							 			<p class="border-bottom pb-3">
  											<span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary "></i>
                          <?=!empty($profil)?$this->db->get_where('kecamatan',["id_kec"=>$profil['kecamatan']])->row_array()['nama'].' / '.$this->db->get_where('desa',["id_desa"=>$profil['desa']])->row_array()['nama'].' / '.$profil['alamat_lengkap']:''?>
                        </span>
  										</p>
  										<div class="mt-3">
  											<a href="#" class="badge badge-light mr-1" id="edit" data-toggle="modal" data-target="#exampleModal" data-all='<?=json_encode($profil)?>'>Edit Profil</a>
  										</div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  					<div class="border-top user-social-box">
  						<div class="card-body">
  							<table class="table table-hover">
  								<tbody>
  									<tr>
  										<th style="width: 40%">Nik</th>
  										<td>:</td>
  										<td><?=empty($profil)?'':$profil['nik'] ?></td>
  									</tr>
  									<tr>
  										<th style="width: 40%">Nama</th>
  										<td style="width: 2%">:</td>
  										<td><?=empty($profil)?'':$profil['nama'] ?></td>
  									</tr>
  									<tr>
  										<th style="width: 40%">Tempat Lahir</th>
  										<td style="width: 2%">:</td>
  										<td><?=empty($profil)?'':$profil['t_lahir'] ?></td>
  									</tr>
  									<tr>
  										<th style="width: 40%">Tanggal Lahir</th>
  										<td style="width: 2%">:</td>
  										<td><?=empty($profil)?'':tgl_i($profil['tgl_lahir']) ?></td>
  									</tr>
  									<tr>
  										<th style="width: 40%">Pekerjaan</th>
  										<td style="width: 2%">:</td>
  										<td><?=empty($profil)?'':$profil['pekerjaan'] ?></td>
  									</tr>
  									<tr>
  										<th style="width: 40%">Kecamatan</th>
  										<td style="width: 2%">:</td>
  										<td><?=empty($profil)?'':$this->db->get_where('kecamatan',["id_kec"=>$profil['kecamatan']])->row_array()['nama'] ?></td>
  									</tr>
  									<tr>
  										<th style="width: 40%">Desa</th>
  										<td style="width: 2%">:</td>
  										<td><?=empty($profil)?'':$this->db->get_where('desa',["id_desa"=>$profil['desa']])->row_array()['nama'] ?></td>
  									</tr>
  									<tr>
  										<th style="width: 40%">Alamat Lengkap</th>
  										<td style="width: 2%">:</td>
  										<td><?=empty($profil)?'':$profil['alamat_lengkap'] ?></td>
  									</tr>
  								</tbody>
  							</table>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

  	<div class="modal-dialog modal-lg" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
  				<a href="#" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</a>
  			</div>
  			<form enctype="multipart/form-data" action="<?=base_url('Admin/proses_profil')?>" method="post">
  				<div class="modal-body">
  					<div class="row">
  						<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
  							<div class="form-group">
  								<label for="inputText3" class="col-form-label">Nik</label>
  								<input id="inputText3" name="nik" type="text" class="form-control">
  							</div>
  							<div class="form-group">
  								<label for="inputText3" class="col-form-label">Nama</label>
  								<input id="inputText3" name="nama" type="text" class="form-control">
  							</div>
  							<div class="form-group">
  								<label for="inputText3" class="col-form-label">Tempat Lahir</label>
  								<input id="inputText3" name="t_lahir" type="text" class="form-control">
  							</div>
  							<div class="form-group">
  								<label for="inputText3" class="col-form-label">Tanggal Lair</label>
  								<input id="inputText3" name="tgl_lahir" type="date" class="form-control">
  							</div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Pekerjaan</label>
                  <input id="inputText3" name="pekerjaan" type="text" class="form-control">
                </div>
  						</div>
  						<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
  							<div class="form-group">
                  <label for="inputText3" class="col-form-label">Kecamatan</label>
                  <select class="form-control" id="kec" name="kecamatan">
                    <option>Pilih Kecamatan</option>
                    <?php foreach ($kec as $value) {?>
                      <option value="<?=$value['id_kec']?>"><?=$value['nama']?></option>
                    <?php }?>
                  </select>
                </div>
  							<div class="form-group">
                  <label for="inputText3" class="col-form-label">Desa</label>
                  <select class="form-control" id="desa" name="desa">
                   
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Alamat Lengkap</label>
                  <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="2"></textarea>                        
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Gmabar Profil</label>
                  <input id="inputText3" type="file" name="gmabar" class="form-control">                 
                </div>
  						</div>
  					</div>
  				</div>
  				<div class="modal-footer">
  					<a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
  					<button class="btn btn-primary" id="save">Save changes</button>
  				</div>
  			</form>
  		</div>
  	</div>
  </div>