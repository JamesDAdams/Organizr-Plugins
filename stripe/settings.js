/* TEST PLUGIN SETTINGS JS FILE */
/* This file is only loaded on the Organizr settings page */

// FUNCTIONS

// EVENTS and LISTENERS

// If you setup the plugin not use the bind settings function ('bind' => false) - You can override the js settings pane if you wish like this:
// REPLACE PLUGINNAME and pluginname with the actual name
$(document).on('click', 'STRIPE-settings-button', function() {
	ajaxloader(".content-wrap","in");
	organizrAPI2('GET','api/v2/plugins/stripe/settings').success(function(data) {
		let response = data.response;
		$('STRIPE-settings-items').html(buildFormGroup(response.data));
		// And any other items you want to do things with
	}).fail(function(xhr) {
		OrganizrApiError(xhr);
	});
	ajaxloader();
});