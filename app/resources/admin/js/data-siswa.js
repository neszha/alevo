$(document).ready(function()
{
	// Tambah data siswa
	$('.for-input-data-siswa').click(function()
	{	
		$('#data-siswa-sederhana').click();
	});

	$('#data-siswa-sederhana').change(function(event)
	{
		getJsonFromXlsx(event);
	});

	$('#b-001').click(function()
	{
		$(this).parent().hide();
		$('#b-002').parent().show();	
		$.each($('#p-001 tr'), function(i, tr) 
		{
			inputDataSiswa(tr);
		});
	});

	$('#b-002').click(function()
	{
		window.location = window.location.href;
	});

	$(document).on('submit', '#search-data', function(event)
	{
		event.preventDefault();
		var str = $(this).find('input#sq').val();
		if(str.length > 0) getDataSiswa(str);
	});

	$(document).on('click', 'button[delete-data-siswa]', function(event) 
	{
		$(this).text('Loading...');
		var id = $(this).data('id');
		var url = baseUrl + '/admin-api/siswa/'+ id +'/delete';
		$.post(url, function(res) 
		{
			var array = JSON.parse(res);
			$('#data-siswa').bootstrapTable('remove', {
				field: 'siswa_akun',
				values: array,
			});
		});
	});

	$('#use-filter').click(function() 
	{
		var _this = $(this);
		var target = _this.data('target');
		$(target).toggle(100);
	});

	$('.set-filter p').click(function()
	{
		var _this = $(this);
		var p = _this.parents('.set-filter');
		var value = _this.data('value');
		p.find('p').removeClass('active');
		_this.addClass('active');
		p.find('input').val(value);
	});

	$('.data-preview p').click(function() 
	{
		var str = $('input#sq').val();
		if(str.length > 0){
			getDataSiswa(str);
		}else{
			getDataSiswa();
		}
	});

	$('#get-all-data-siswa').click(function()
	{
		getAllDataSiswa();
	});

});