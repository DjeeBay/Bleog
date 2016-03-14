$(function() {
	$('#sub').on('click', function(e) {
		//$.post(/*'newsletter.php'*//*'./index.php'*/form.prop('action'),{ newsletter_email: $('#mail').val(), _token: $('input[name]=_token').val() },
				//function(data) {
					//$('#emldiv').replaceWith(data);
		//});
		e.preventDefault();
		$.ajax({
            type: 'POST',
            url: form.prop('action'),
            success: function(data){
            	$('#emldiv').replaceWith(data);
            }
        });
		e.preventDefault();
	});
});