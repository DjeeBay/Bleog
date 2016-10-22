$(function() {
	$('#unsus').submit(function(e) {
		e.preventDefault();
		$.ajax({
			  type: 'POST',
			  url: ($(this).prop('action')),
			  data: {
				  _token: $('input[name=_token]').val()
				  },
			  success: function(data){
				  $('#confirm').replaceWith(data);
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
				  $('#test').html('Une erreur s\'est produite. Veuillez réessayer plus tard.');
			  }
		});
	});
});