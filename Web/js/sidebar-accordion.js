$(document).ready(function() {
	$('.nav li ul li a').click(function() {
		event.stopPropagation();
		window.location.href = $(this).attr('href');
	})
		
	$('.nav li:has(ul)').click(function(e) {
		e.preventDefault();

		if($(this).hasClass('activado')) {
			$(this).removeClass('activado');
			$(this).children('ul').slideUp();
		} else {
			$('.nav li ul').slideUp();
			$('.nav li').removeClass('activado');
			$(this).addClass('activado');
			$(this).children('ul').slideDown();
		}

		
	});
});