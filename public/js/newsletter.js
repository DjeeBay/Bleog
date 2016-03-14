$(function() {
	$('#sub').submit(function(e) {
		e.preventDefault();
		$.post($(this).prop('action'),{
			newsletter_email: $('#mail').val(),
			_token: $('input[name=_token]').val()
		}, function(data) {
					$('#emldiv').replaceWith(data);
		});
	});
});