<script type="text/javascript">
	$("#cari").click(function() {
		window.location ="<?=base_url('Admin/laporan/')?>"+$('#dates').val();
	});
	var date = document.getElementById('dates');
	function checkValue(str, max) {
		if (str.charAt(0) !== '0' || str == '00') {
			var num = parseInt(str);
			if (isNaN(num) || num <= 0 || num > max) num = 1;
			str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
		};
		return str;
	};

	date.addEventListener('input', function(e) {
		this.type = 'text';
		var input = this.value;
		if (/\D\/$/.test(input)) input = input.substr(0, input.length - 2);
		var values = input.split('-').map(function(v) {
			return v.replace(/\D/g, '')
		});
  // if (values[0]) values[0] = checkValue(values[0], 31);
  if (values[1]) values[1] = checkValue(values[1], 12);
  var output = values.map(function(v, i) {
  	return v.length == 4 && i < 2 ? v + '-' : v;
  });
  this.value = output.join('').substr(0, 7);
});
</script>