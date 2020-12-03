<script type="text/javascript">
	const ax = new ajax;
	$("#kec").change(function() {
		ax.post('<?=base_url('Admin/ajax_desa')?>',{"id_kec" : $(this).val()},desa,desa,desa);
		function desa(res){
			$("#desa").html(res);
		}
	});

	$("#edit").click(function() {
		let data = $(this).data("all");
		$("[name='nik']").val(data['nik']);
		$("[name='nama']").val(data['nama']);
		$("[name='t_lahir']").val(data['t_lahir']);
		$("[name='tgl_lahir']").val(data['tgl_lahir']);
		$("[name='pekerjaan']").val(data['pekerjaan']);
		$("[name='alamat_lengkap']").val(data['alamat_lengkap']);
		$("#save").text("Edit");
	});
</script>