$(document).ready(function()
{
	$('.tooltipped').tooltip();
	$('.sidenav').sidenav();
	$('.materialboxed').materialbox();
	$('input.length').characterCounter();
	$('select').formSelect();
	var options = {
		format: 'dd-mm-yyyy',
		yearRange: 20
	};
	var elems = document.querySelectorAll('.datepicker');
	var instances = M.Datepicker.init(elems, options);

	$('input#memiliki_wali').change(function()
	{
		$('main').toggleClass('hide-form');
		if (!$(this).is(':checked')) 
		{
			$('form button[type=submit]').removeAttr('disabled');
		}else{
			regexLoadCheck();
		}
	});

	$('button[input-click]').click(function()
	{
		var x = $(this).attr('input-click');
		$(x).click();
	});

	$('input.document-input').change(function(event)
	{
		var file = event.target.files[0];
		if (file.size <= 300000)
		{
			var preview = window.URL.createObjectURL(file);
			$(this).parent().find('img').attr('src', preview);
		}else{
			if(audio) audio.play();
			M.toast({html: 'Ukuran file harus kurang dari 300 kb', classes: 'rounded deep-orange darken-1'});
		}
	});

	// Validasi form dengan event

	$('input[number-only]').keyup(function(event) 
	{
		regexNumberOnly($(this));
	});

	$('input[email]').keyup(function(event) 
	{
		regexEmail($(this));
	});

	// Validasi form ketika di load
	regexLoadCheck();
	regexEmail($('input[email]'));
	

});