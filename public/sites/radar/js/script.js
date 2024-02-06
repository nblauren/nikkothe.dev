! function (a) {
	"use strict";
	a('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
		if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
			var e = a(this.hash);
			if ((e = e.length ? e : a("[name=" + this.hash.slice(1) + "]")).length) return a("html, body").animate({
				scrollTop: e.offset().top - 48
			}, 1e3, "easeInOutExpo"), !1
		}
	}), a(".js-scroll-trigger").click(function () {
		a(".navbar-collapse").collapse("hide")
	}), a("body").scrollspy({
		target: "#mainNav",
		offset: 54
	});
	var e = function () {
		a("#mainNav").offset().top > 100 ? a("#mainNav").addClass("navbar-shrink") : a("#mainNav").removeClass("navbar-shrink")
	};
	e(), a(window).scroll(e);

	
	window.sr = ScrollReveal();
	sr.reveal('div');
}(jQuery);

$(document).on("click", "#btnSubmitMesssage", function () {
	var triggerbutton = $(this);
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var email = $("#email").val();
	var telephone = $("#telephone").val();
	var comments = $("#comments").val();
	triggerbutton.prop("disabled", true);
	triggerbutton.html('<i class="fas fa-circle-notch fa-spin"></i> Warten');
	$.ajax({
		type: "post",
		url: "send_form_email.php",
		data: {
			'first_name': first_name,
			'last_name': last_name,
			'email': email,
			'telephone': telephone,
			'comments': comments
		},
		cache: false,
		success: function (html) {
			alert(html);
			$('#contactform').find('input:text, input:password, select, textarea').val('');
			triggerbutton.prop("disabled", false);
			triggerbutton.html('<i class="fas fa-paper-plane"></i> Sended');
		}
	});
	return false;
});
