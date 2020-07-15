function regexNumberOnly(x)
{
	var length = x.attr('length');
	var regex = RegExp('^\\d+$', 'g');
	if (length != undefined) var regex = RegExp('^\\d{'+ length +'}$', 'g');
	var str = x.val();
	var y = regex.test(str);
	if (str.length == 0 || y) // true
	{
		x.removeClass('invalid');
	}else{
		x.addClass('invalid');
	}

	var invalid = x.parents('form').find('input.invalid').length;
	var btn = x.parents('form').find('button[type=submit]');
	if (invalid != 0) 
	{
		btn.attr('disabled', '');
	}else{
		btn.removeAttr('disabled');
	}
}

function regexLoadCheck()
{
	$.each($('input[number-only]'), function(i, x) 
	{
		regexNumberOnly($(x));
	});
}

function regexEmail(x) 
{
	var email = x.val();
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var result = re.test(email);

	if (result) 
	{
		x.removeClass('invalid');
	}else{
		x.addClass('invalid');	
	}

	var invalid = x.parents('form').find('input.invalid').length;
	var btn = x.parents('form').find('button[type=submit]');
	if (invalid != 0) 
	{
		btn.attr('disabled', '');
	}else{
		btn.removeAttr('disabled');
	}
}