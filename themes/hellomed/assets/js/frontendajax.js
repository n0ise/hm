jQuery(document).ready(function($) {
	var data = {
		'action': 'awhitepixel_frontend_stuff',
		'something': 'Hello world',
		'another_thing': 14
	}
	$.post(Theme_Variables.ajax_url, data, function(response) {
		console.log(response);
	});
});