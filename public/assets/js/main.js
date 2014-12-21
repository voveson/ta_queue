$(function() {
	$('.school_picker').click(function(e) {
		e.preventDefault();
		var form = $(this).attr('data-form');
		$(form).submit();
	});

	$('#student-radio').click(function(e) {
		$('#student-form-container').show();
		$('#ta-form-container').hide();
	});

	$('#ta-radio').click(function(e) {
		$('#student-form-container').hide();
		$('#ta-form-container').show();
	});

	$('#enter-q').click(function(e) {
		var auth = $('#hidden-data').attr('data-key');
		var url = $(this).attr('data-url');

		$.ajax({
			url:		url,
			type: 		"POST",
			success: 	function(data, textStatus, jqXHR) {
				$('#enter-q').hide();
				$('#exit-q').show();
				$('#q-students').html(data);
			},
			error: 		function(jqXHR, textStatus, errorThrown) {
				var message = $.parseJSON(jqXHR.responseText);
				alert(textStatus);
				// TODO:  bootstrap error message
			}
		});
	});

	$('#exit-q').click(function(e) {
		var auth = $('#hidden-data').attr('data-key');
		var url = $(this).attr('data-url');

		$.ajax({
			url:		url,
			type: 		"POST",
			success: 	function(data, textStatus, jqXHR) {
				$('#enter-q').show();
				$('#exit-q').hide();
				$('#q-students').html(data);
			},
			error: 		function(jqXHR, textStatus, errorThrown) {
				var message = $.parseJSON(jqXHR.responseText);
				alert(textStatus);
				// TODO:  bootstrap error message
			}
		});
	});

	$('#sign-out-q').click(function(e) {
		var url = $(this).attr('data-url');
		var after = $(this).attr('data-after');

		$.ajax({
			url:		url,
			type: 		"POST",
			success: 	function(data, textStatus, jqXHR) {
				window.location.replace(after);
			},
			error: 		function(jqXHR, textStatus, errorThrown) {
				var message = $.parseJSON(jqXHR.responseText);
				alert(textStatus);
				// TODO:  bootstrap error message
			}
		});
	});
});
