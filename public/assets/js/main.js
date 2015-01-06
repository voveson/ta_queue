$(function() {

	var modal_top = $(window).height() / 2;
	modal_top -= $('#ta-modal').height() / 2;
	var modal_left = $(window).width() / 2;
	modal_left -= $('#ta-modal').width() / 2;

	$('#ta-modal').css('top', modal_top);
	$('#ta-modal').css('left', modal_left);

	$('#q-students').on('click', '.ta-q-student', function(e) {
		var id = $(this).attr('id');
		var current_student = $('#hidden-data').attr('data-student');
		var name = $(this).attr('data-name');
		
		if(current_student != 'n/a' && id != current_student)
			return;
		
		$('#modal-help').attr('data-sid', id);
		$('#modal-putback').attr('data-sid', id);
		$('#modal-remove').attr('data-sid', id);

		if(current_student == 'n/a')
		{
			$('#modal-help').show();
			$('#modal-putback').hide();
		}
		else
		{
			$('#modal-help').hide();
			$('#modal-putback').show();
		}

		$('#modal-student').text(name);
		clearInterval(polling);
		$("#ta-modal").modal('show');
	});

	$('#modal-cancel').click(function(){
		polling = setInterval(function(){poll()}, 10000);
	});

	$('#modal-help').click(function() {
		var id = $(this).attr('data-sid');
		ta_action("ta_accept", id, "Helping student");
	});

	$('#modal-putback').click(function() {
		var id = $(this).attr('data-sid');
		ta_action("ta_putback", id, "Student was put back");
	});

	$('#modal-remove').click(function() {
		var id = $(this).attr('data-sid');
		ta_action("ta_remove", id, "Student was removed");
	});

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
				Android.showToast("Signed out");
				window.location.replace(after);
			},
			error: 		function(jqXHR, textStatus, errorThrown) {
				var message = $.parseJSON(jqXHR.responseText);
				Android.showToast("Error: Could not sign out");
				// TODO:  bootstrap error message
			}
		});
	});

	$('#ta-sign-out-q').click(function(e) {
		var url = $(this).attr('data-url');
		var after = $(this).attr('data-after');

		$.ajax({
			url:		url,
			type: 		"POST",
			success: 	function(data, textStatus, jqXHR) {
				Android.showToast("Signed out");
				window.location.replace(after);
			},
			error: 		function(jqXHR, textStatus, errorThrown) {
				var message = $.parseJSON(jqXHR.responseText);
				Android.showToast("Error: Could not sign out");
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
				if(Android !== undefined)
					Android.showToast("Queue state updated");
			},
			error: 		function(jqXHR, textStatus, errorThrown) {
				//var message = $.parseJSON(jqXHR.responseText);
				alert('Could not change state at this time.');
				// TODO:  bootstrap error message
			}
		});
	});
});


function poll()
{
	location.reload();
}

function ta_action(url_slug, id, message)
{
	var url = $('#hidden-data').attr('data-taurl');

	$.ajax({
		url:		url,
		type: 		"POST",
		data: 		{"slug":url_slug, "s_id":id},
		dataType: 	"json", 
		success: 	function(data, textStatus, jqXHR) {
			$("#ta-modal").modal('hide');
			Android.showToast(message);
			//alert(message);
			location.reload();
		},
		error: 		function(jqXHR, textStatus, errorThrown) {
			$("#ta-modal").modal('hide');
			Android.showToast("An error occurred");
			//alert('an error occurred');
			location.reload();
		}
	});
}