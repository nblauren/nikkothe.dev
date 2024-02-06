$(function () {
	'use strict';
	
	window.sr = ScrollReveal({
		reset: true
	});

	sr.reveal('section', {
		duration: 1000
	});
});

$(window).bind("load", function() {
	'use strict';
	$('body').addClass('loaded');
});

$(document).on("click", '[data-toggle="lightbox"]', function (event) {
	'use strict';
	event.preventDefault();
	$(this).ekkoLightbox();
});
