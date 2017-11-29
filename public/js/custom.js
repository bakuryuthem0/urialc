function showMenu () {
	$('.body').addClass('menu-active');
}
function hideMenu () {
	$('.body.menu-active').removeClass('menu-active');
	$('.navigation.is-visible').removeClass('is-visible');
}
function beforeActivate (btn) {
	btn.next('.miniLoader').addClass('active');
	btn.addClass('d-none');
}
function successActivate (response, btn) {
	console.log(btn);
	btn.next('.miniLoader').removeClass('active');
	btn.removeClass('d-none');
	if (response.type == "success") {
		if (response.state == 1) {
			btn.removeClass('btn-ligth').addClass('btn-dark').html('No Mostrar');
		}else
		{
			btn.removeClass('btn-dark').addClass('btn-ligth').html('Mostrar');
		}
	}else if(response.type == "danger")
	{
		$('.responseActive').addClass('active').addClass('alert-danger').children('p').html(response.msg).focus();
		setTimeout(5000,function(){
			removeResponseAjax();
		});
	}
}
jQuery(document).ready(function($) {
	$('.btn-send').on('click', function(event) {
		var btn = $(this);
		var proceed = 0;
		proceed = validate($('.validate-input'));
		if (proceed == 1) {
			$(btn.data('target')).submit();
		}
	});
	$(document).on('click','.menu-close, .body.menu-active', function(event) {
		hideMenu();
	});
	$(document).on('click','.menu-btn', function(event) {
		if (!$('.body').hasClass('menu-active')) {
			showMenu();
		}
	});
	if ($(window).width() < 991) {
		var hammer = $('.body').hammer();
		hammer.on("swipeleft",function(ev){
	  		showMenu();
		});
		hammer.on("swiperight",function(ev){
	  		hideMenu();
		});

	};
	var whichTransitionEvent = function(){
	    var t;
	    var el = document.createElement('fakeelement');
	    var transitions = {
	      'transition':'transitionend',
	      'OTransition':'oTransitionEnd',
	      'MozTransition':'transitionend',
	      'WebkitTransition':'webkitTransitionEnd'
	    };
	    for(t in transitions){
	      if( el.style[t] !== undefined ){
	        return transitions[t];
	      }
	    }
	};
	var transitionEvent = whichTransitionEvent();

	// With that sorted...
	if(transitionEvent){
		$('.body').on(transitionEvent, function() {
			if ($('.body').hasClass('menu-active')) {
				$('.navigation').addClass('is-visible');
			}
		});
	}

	$('.category').on('change', function(event) {
		if ($(this).val() != "") {
			var btn = $(this);
			var dataPost = {
				id : btn.val()
			}

			doAjax(btn.data('url'), 'GET', 'html', dataPost, btn, startLoadContent, loadContent, ajaxError);
		};

	});
	$('.btn-activate').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			id: btn.val()
		};
		doAjax(btn.data('url'), 'GET', 'json', dataPost, btn, beforeActivate, successActivate, endSelectLoadAjax);
	});
});