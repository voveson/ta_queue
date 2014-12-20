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
});