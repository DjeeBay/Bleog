$(function() {
	$('#sub').submit(function(e) {
		e.preventDefault();
		$.ajax({
			  type: 'POST',
			  url: ($(this).prop('action')),
			  data: {
				  newsletter_email: $('#inputEmail').val(),
				  _token: $('input[name=_token]').val()
				  },
			  success: function(data){
				  $('#emldiv').replaceWith(data);
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
				  $('#labMail').html('<span class="glyphicon glyphicon-warning-sign"></span> Veuillez entrer une adresse email valide.');
			  }
		});
	});
});