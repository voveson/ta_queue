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

	$('#q-state-select').change(function(e) {
		var value = $(this).val();
		var frozen = $(this).attr('data-frozen');
		var active = $(this).attr('data-active');
		var url = $(this).attr('data-url');
		var data;
		var color = '';

		if (value == 1)
		{
			data = { active:'1', frozen:'0', operation:'activate' };
			color = '#B2B2B2';
		}
		else if(value == 2)
		{
			data = { active:'0', operation:'activate' };
			color = '#FF9999';
		}
		else
		{
			data = { frozen:'1', operation:'freeze' };
			color = '#00CCFF';
		}

		$.ajax({
			url:		url,
			type: 		"POST",
			data: 		data, 
			dataType: 	'json',
			success: 	function(data, textStatus, jqXHR) {
				$('body').css('background-color', color);
				$('html').css('background-color', color);
				Android.showToast("Queue state updated");
			},
			error: 		function(jqXHR, textStatus, errorThrown) {
				//var message = $.parseJSON(jqXHR.responseText);
				alert('Could not change state at this time.');
				// TODO:  bootstrap error message
			}
		});
	});

	$('#q-students').on('click', '.ta-q-student', function(e) {
		var id = $(this).attr('id');
		//Android.showDialog("Pick one!");
	});
});


function poll()
{
	location.reload();
}

function ta_choice(i)
{
	$('#q-status').html("<h3>" +i+"</h3>");
}