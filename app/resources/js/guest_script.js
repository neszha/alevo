function scrollSet()
{
	var x = $(window).scrollTop();
	var p = $('header');
	if (x >= 10)
	{
		p.addClass('scroll');
	}else{
		p.removeClass('scroll');
	}
}


$(document).ready(function()
{
	var win = $(window);
	var doc = $(document);

	win.scroll(function() // Scroll event
	{
		scrollSet();
	});

	scrollSet(); // Set scroll when document load

	$('input#input_nisn').characterCounter(); // NISN max value

	// Duplicate nav link
	var nav = $('header .nav-col.dekstop').html();
	$('header .nav-col.mobile .nav-toggle').append(nav);

	// Nav Toggle
	doc.on('click', '.mobile .menu-icon', function()
	{
		var _this = $(this);
		var n = $('.nav-toggle');
		var attr = _this.attr('data-open');

		if (attr == 'open')
		{
			n.show();
			setTimeout(function()
			{
				n.addClass('active');
			}, 10);
			_this.attr('data-open', 'close');
			_this.find('i').text('clear');
		}else{
			n.removeClass('active');
			setTimeout(function()
			{
				n.show();
			}, 500);
			_this.attr('data-open', 'open');
			_this.find('i').text('menu');
		}

		console.log(attr);
	});


});