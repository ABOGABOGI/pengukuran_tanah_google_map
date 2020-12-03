 <style type="text/css">
 	#color-palette {
 		clear: both;
 	}

 	.color-button {
 		width: 14px;
 		height: 14px;
 		font-size: 0;
 		margin: 2px;
 		float: right;
 		margin-top: 20px;
 		margin-bottom: 20px;
 		cursor: pointer;
 	}
 </style>
 <div class="dashboard-wrapper">
 	<div class="container-fluid  dashboard-content">
 		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
 			<div class="card">
 				<div class="card-header d-flex" id="card_">
 					<h4 class="card-header-title"><?=$this->db->get_where('luas_tanah',["id"=>$this->session->userdata('project')['id']])->row_array()['nama_project']?></h4>
 					<div class="toolbar ml-auto">
 						<?php if(empty($this->session->userdata('project')['id'])){?>
 						<button id="start" class="btn btn-primary btn-sm ">Mulai</button>
 						<?php } ?>
 						<?php if(!empty($this->session->userdata('project')['id'])){?>
 							<button class="btn btn-light btn-sm" id="laporan">Compail</button>
 						<?php } ?>
 						<button class="btn btn-light btn-sm" id="selesai">Selesai</button>
 						<a href="<?=base_url("Admin/newProject/")?>" class="btn btn-info btn-sm" id="selesai">New Project</a>
 					</div>
 				</div>
 				<?php if(empty($this->session->userdata('project')['id'])){?>
 					<div class="card-body">
 						<div class="form-group">
 							<label for="inputText3" class="col-form-label">Nama Project</label>
 							<input id="nama_tanah" type="text" class="form-control">
 						</div>
 					</div>
 				<?php }else{ ?>
 				<div class="card-body" id="campas_map">
 					<div class="text-right" style="width: 100%">
 						<button class="btn btn-warning btn-xs" id="delete-button" onclick="measureTool.end()">clear</button>
 						<div id="color-palette"></div>
 						<hr>	
 					</div>
 					<div style="width: 100%" id="hasil_">
 						<div class="row">
 							<div class="col-md-12" >
 								<div class="card">
 									<div class="card-header d-flex" style="background-color: #ccc">
 										<h4 class="mb-0" style="color: #fff">Card Header</h4>
 									</div>
 									<div class="card-body">
 										<table style="width:100%">
 											<thead>
 												<tr>
 													<td style="width: 30%">Nama Pengguna</td>
 													<td style="width: 2%">:</td>
 													<td style=""><?=$this->db->get_where('profil',["username"=>$this->session->userdata('us')])->row_array()['nama']?></td>
 												</tr>
 												<tr>
 													<td style="width: 30%">Nama Project</td>
 													<td style="width: 2%">:</td>
 													<td style=""><?=$this->db->get_where('luas_tanah',["id"=>$this->session->userdata('project')['id']])->row_array()['nama_project']?></td>
 												</tr>
 												<tr>
 													<td style="width: 30%">Luas Bidang</td>
 													<td style="width: 2%">:</td>
 													<td style="" id="bidang"></td>
 												</tr>
 											</table>
 											<div style="width: 100%" id="koordinat"></div>
 										</div>
 										<div class="card-footer">
 											<button class="btn btn-info btn-xs float-right" style="margin-left: 10px;" id="rep">Laporan</button><button class="btn btn-primary btn-xs float-right" id="save_area">Save</button>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>


 						<div id="map" style="width: 100%;height: 400px; background-color: #ccc"></div>
 						<input type="hidden" id="tx" name="">
 					</div>
 				<?php } ?>

 				</div>
 			</div>
 		</div>
 	</div>


 	<!-- onclick="" -->

