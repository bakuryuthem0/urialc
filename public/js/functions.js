if ($('#example1').length > 0) {
    var table = initDataTable();

};
function initDataTable () {
	return $('#example1').DataTable({
    	"language": {
	      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	    },
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": true,
      	"autoWidth": true
    });
}
function getRootUrl () {
  return $('.baseUrl').val();
}
function hideModalContent (btn) {
	$('.show-after-load').removeClass('invisible');
	$('.hide-after-load').addClass('visible');
	btn.val('');
}
function shoModalContent () {
	$('.show-after-load').addClass('visible');
	$('.hide-after-load').removeClass('invisible');
}
function activeteStatus (inp,toAdd, toRemove) {
	inp.addClass(toAdd).removeClass(toRemove);
}
function startAjax (btn) {
	btn.prevAll('.miniLoader').addClass('active');
	btn.addClass('disabled').attr('disabled', true);
}
function endAjax (response, btn) {
	btn.prevAll('.miniLoader').removeClass('active');
	removeResponseAjax();
	$('.responseAjax').addClass('alert-'+response.type).addClass('active');
}
function startIconAjax (btn) {
	btn.find('.fa').addClass('hidden');
	startAjax(btn);
}
function ajaxErrorWithIcon (btn) {
	btn.find('.fa-times').removeClass('hidden');
	ajaxError(btn);
}

function responseMsg(response)
{

	if (typeof response.msg === "object") {
		$('.responseAjax').children('p').html('<ul class="listErrors"></ul>');
		$.each(response.msg, function(index, val) {
			$('.listErrors').append('<li>'+val+'</li>');
		});
	}else
	{
		$('.responseAjax').children('p').html(response.msg);
	}
}
function ajaxError (btn) {
	endAjax ({ type: 'danger'}, btn);
	btn.removeClass('disabled').attr('disabled', false);
	$('.responseAjax').children('p').html('Ups, ha habido un error.');
}
function addValToElim (toAdd, esto) {
	esto.addClass('to-elim');
	esto.parent().parent().addClass('row-to-elim');
	$(toAdd).val(esto.val()).attr('data-url',esto.data('url')).attr('data-tosend',esto.data('tosend'));
}
function closeModalElim (boton) {
	$('.to-elim').removeClass('to-elim');
	$(boton).removeClass('disabled').attr('disabled', false);
	removeResponseAjax();
}
function elimSuccess (response, btn) {
	endAjax(response, btn)
	responseMsg(response);
	if (response.type === 'danger') {
		btn.removeClass('disabled').attr('disabled', false);
	}else
	{
        table.row('.row-to-elim').remove().draw( false );
		
	}
}
function loadContentWithIcon (response, btn) {
	btn.find('.fa-check').removeClass('hidden');
	loadContent(response, btn);
}
function startLoadContent (btn) {
	btn.addClass('disabled').attr('disabled',true);
	$(btn.data('toremove')).remove();
}
function loadContent (response, btn) {
	btn.removeClass('disabled').attr('disabled', false);
	$(btn.data('target')).append(response);
}
function login (response, btn) {
	endAjax(response, btn)
	$('.responseAjax').children('p').html(response.msg);

	if (response.type === 'danger') {
		btn.removeClass('disabled').attr('disabled',false);
	}else
	{
		btn.addClass('disabled').attr('disabled',true);
		setTimeout(function() {
			window.location.reload();	
		},2000);
	}
}
function changePassSuccess(response, btn) {
	endAjax(response, btn);
	responseMsg(response);
	if (response.type != 'danger') {
		$('.validate-input').val('');
	}
	btn.removeClass('disabled').attr('disabled', false);

}
function removeResponseAjax() {
	$('.responseAjax').removeClass('alert-success');
	$('.responseAjax').removeClass('alert-danger');
	$('.responseAjax').removeClass('active');

}
function checkEmpty(inp) {
	if (inp.val() === "") {
		activeteStatus(inp, 'is-invalid', 'is-valid');
		return 0;
	}else
	{
		activeteStatus(inp, 'is-valid','is-invalid');
		return 1;
	}
}
function restoreInput (inp) {
	inp.removeClass('is-invalid');
	inp.nextAll('.control-label').remove();
}
function addHtml (inp,toShow,msg) {
	var $content = $('<small></small>');
	$content.html(msg).addClass('control-label').addClass(toShow);
	inp.nextAll('.control-label').remove();
	inp.after($content);
}
function validateEmail(inp) {

	var atpos = inp.val().indexOf("@");
    var dotpos = inp.val().lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=inp.val().length) {
        return false;
    }
	return true;
}
function validate($ele) {
	var proceed = 1;
	$ele.each(function(index, el) {
		var msg;
		restoreInput($(el)); 
		if ($(el).is('input')) {
			if ($(el).attr('type') === "text") {
				if (checkEmpty($(el)) == 0) {
					msg = 'El campo '+$(el).data('name')+' es obligatorio';
					addHtml($(el),'is-invalid',msg);
					proceed = 0;
				}
			}else if($(el).attr('type') == "email")
			{
				if(checkEmpty($(el)) === 0 || validateEmail($(el)) === false)
				{
					msg = 'El campo '+$(el).data('name')+' es obligatorio y debe ser un email valido';
					addHtml($(el),'is-invalid',msg);
					proceed = 0;
				}
			}else if($(el).attr('type') === "number"){
				if (checkEmpty($(el)) === 0) {
					msg = 'El campo '+$(el).data('name')+' es obligatorio';
					addHtml($(el),'is-invalid',msg);
					proceed = 0;
				}else if(isNaN($(el).val()) || $(el).val() < 1)
				{
					msg = 'El campo '+$(el).data('name')+' debe ser un numero mayor a 0';
					addHtml($(el),'is-invalid',msg);
					proceed = 0;
				}
			}
		}else if($(el).is('select'))
		{
			if($(el).val() === "")
			{
				msg = 'El campo '+$(el).data('name')+' seleccionado es invalido';
				addHtml($(el),'is-invalid',msg);
				proceed = 0;
			}
		}
		else if($(el).is('textarea'))
		{
			if(checkEmpty($(el)) === 0)
			{
				msg = 'El campo '+$(el).data('name')+' es obligatorio';
				addHtml($(el),'is-invalid',msg);
				proceed = 0;
			}
		}

	});
	return proceed;
}
function doAjax(url, method, dataType, dataPost, btn, beforeSendCallback, successCallback, errorCallback) {
	$.ajax({
		url: url,
		type: method,
		dataType: dataType,
		data: dataPost,
		beforeSend: function(){
			beforeSendCallback(btn)
		},
		success: function(response){
			successCallback(response, btn);
		},
		error: function(){
			errorCallback(btn)
		}
	});
}
function clonarInput (target, name, btn) {
	var toClone = $('.'+target);
	var cloned = toClone.clone();
	toClone.removeClass(target).addClass('active');
	var inputs = toClone.find('.input-lang');
	inputs.each(function(index, el) {
		if (!btn.hasClass('no-lang')) {
			var lang = $('.lang-val')[index];
			if (btn.hasClass('btn-new')) {
				$(el).attr('name',name+'['+$(lang).val()+'][]');
			}else
			{
				$(el).attr('name',name+'['+$(lang).val()+']');
			}
		}else
		{
				$(el).attr('name',name);
		}
	});
	toClone.after(cloned);
	return toClone;
}
function applyAffix ($top, $bottom) {
	if ($(window).width() >= 768 && $(window).width() < 1024 && $('.filters-menu').length > 0) {
		$('.filters-menu').affix({
		 	offset: {
		    	top: $top.offset().top,
		    	bottom: function () {
		      		return this.bottom = parseInt($bottom.offset().top)+parseInt($('.filters-menu').height())
		    	}
			}
		});
	}
}
function beforeMisc(btn){
	var attr = btn.find('.miniLoader').attr('src');
	btn.html('<img src="'+attr+'" class="miniLoader active">');
}

function successMisc(response, btn){
	btn.html(response);
} 

function errorMisc(btn)
{
	btn.html('<div class="alert alert-danger">Ups, hubo un error, intentalo de nuevo</div>')
}
function endSelectLoadAjax (btn) {
	btn.removeClass('disabled').attr('disabled', false);
}
function beforeSelectLoad (btn) {
	$(btn.data('target')).find('.option-response').remove();
	btn.addClass('disabled').attr('disabled', true);
}
function successSelectLoad (response, btn) {
	endSelectLoadAjax(btn);
	$(btn.data('target')).append(response);
}
function beforeSelectSecondLoad (btn) {
	$(btn.data('target2')).find('.option-response').remove();
	btn.addClass('disabled').attr('disabled', true);
}
function successSelectSecondLoad(response, btn) {
	endSelectLoadAjax(btn);
	$(btn.data('target2')).append(response);
}
function loadSelectDoubleContent ($ele) {
	
	loadSelectContent($ele, 'municipio');

	var dataPost = {};
	dataPost.id = $ele.val();
	dataPost.type = 'ciudad';

	doAjax($('.btn-submit').data('url'), 'GET', 'html', dataPost, $ele, beforeSelectSecondLoad, successSelectSecondLoad, endSelectLoadAjax);
}
function loadSelectContent ($ele, type, old = null) {
	var dataPost = {};
	dataPost.id = $ele.val();
	dataPost.type = type;
	if (old) {		
		dataPost.old = old;
	}
	
	doAjax($('.btn-submit').data('url'), 'GET', 'html', dataPost, $ele, beforeSelectLoad, successSelectLoad, endSelectLoadAjax);
}
function loadCarreers (btn, old = null) {
	var dataPost = {}
	if (old) {		
		dataPost.old = old;
	}
	dataPost.id = btn.val();
	doAjax(btn.data('url'), 'GET', 'html', dataPost, btn, beforeSelectLoad, successSelectLoad, endSelectLoadAjax)
}
function successModalWithInput (response, btn) {
	endAjax(response, btn);
	responseMsg(response);
	if (response.type === 'danger') {
		btn.removeClass('disabled').attr('disabled', false);
	}else
	{
		$(btn.data('target')).val('');

	}

}
jQuery(document).ready(function($) {
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$('.contLoading').removeClass('active');
	$('.btn-submit').on('click', function(event) {
		var $ele = $('.validate-input');
		var proceed = validate($ele);
		
		if (proceed) {
			$('form').submit();
		};
	});
	$('.validate-input').on('focus', function(event) {
		restoreInput($(this)); 
	});
	$('#modalElim').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-elim')
	});
	$('.btn-elim-this').on('click', function(event) {
		var btn = $(this);
		$('.elim-title').html(btn.data('toelim'));
		addValToElim('.btn-elim',btn);
	});
	$('.btn-elim').on('click', function(event) {
		var btn = $(this);
		var url = btn.data('url');
		var dataPost = {};
		dataPost[btn.data('tosend')] = btn.val();
		doAjax(url, 'POST', 'json', dataPost, btn, startAjax, elimSuccess, ajaxError);
	});
});