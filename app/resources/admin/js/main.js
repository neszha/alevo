$(document).ready(function()
{
	$(document).on('click', 'button[btn-href]', function(event) 
	{
		event.preventDefault();
		var onClick = $(this).attr('btn-on-click');
		if(onClick !== undefined) $(this).text(onClick);
		window.location = $(this).attr('btn-href');
	});

	$(document).on('click', 'button[get-siswa-access]', function(event) 
	{
		event.preventDefault();
		var id = $(this).attr('data-id');
		var link = baseUrl + '/admin/siswa/' + id + '/set-admin-access';
		window.open(link);
	});

	$(document).on('click', 'button[verifikasi-data-siswa]', function(event) 
	{
		event.preventDefault();
		var _this = $(this);
		var id = _this.attr('data-id');
		var link = baseUrl + '/admin-api/siswa/verifikasi/' + id;
		_this.text('Loading...');
		$.post(link, null, function(res)
		{
			_this.parents('tr').remove();
		});
	});

	$('.btn-for-all').click(function()
	{
		var _this = $(this);
		_this.text('Loading....');
		var place = $('#p-1 tbody tr');
		$.each(place, function(i, x)
		{
			$(x).find('button[verifikasi-data-siswa]').click();
		});
		setTimeout(function()
		{
			_this.hide();	
		}, 500);
	});

});