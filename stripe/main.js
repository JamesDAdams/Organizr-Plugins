/* TEST PLUGIN JS FILE */
/* This file is loaded when Organizr is loaded */
// Load once Organizr loads
$('body').arrive('#activeInfo', {onceOnly: true}, function() {
	stripeLaunch();
});
function stripeLaunch(){
	if(activeInfo.plugins["STRIPE-enabled"] == true && 
		activeInfo.plugins.includes["STRIPE-secret-key-api-prod-include"] && 
		activeInfo.user.loggedin === true && 
		activeInfo.user.groupID <= activeInfo.plugins.includes["STRIPE-Auth-include"]) 
		{
		var menuList = `
		<li>
			<a class=""  href="javascript:void(0)" onclick="tabActions(event,'stripe','plugin');getStripeUserId();">
				<i class="fa fa-cc-stripe"></i> 
				<span lang="en">` + activeInfo.plugins.includes["STRIPE-menu-label-include"] + `</span>
				<small class="chat-counter label label-rouded label-info pull-right hidden">0</small>
			</a>
		</li>`;
	$('.append-menu').after(menuList);
	pageLoad();
	}
}

function getStripeUserId() {
	console.log('CLICK');
	let url = 'https://api.stripe.com/v1/customers?email='+ activeInfo.user.email;
	let token = activeInfo.plugins.includes['STRIPE-secret-key-api-prod-include']
	console.log('token :', token);
  
	let h = new Headers();
	h.append('Authorization', 'Bearer ' + token);
  
	let req = new Request(url, {
	  method: 'GET',
	  mode: 'cors',
	  headers: h
	});
	fetch(req)
	  .then(resp => resp.json())
	  .then(data => {
		const userId = data['data'][0].id
		console.log('user id: ' + userId);
		redirectStripeClientPanel(userId, token, h)
	   })
		 .catch(err => {
		   console.error('error :', err.message);
		   messageSingle(
				'',
				activeInfo.plugins.includes['STRIPE-error-get-user-id-label-include'],
		   		activeInfo.settings.notifications.position,
		   		'#FFF',
				'error', 
				activeInfo.plugins.includes['STRIPE-error-get-user-id-time-include']
			);
		 })
}

function redirectStripeClientPanel(userId, token, h) {
	console.log('CLICK1');
	let url = 'https://api.stripe.com/v1/billing_portal/sessions?customer=' + userId
  
	let req = new Request(url, {
	  method: 'POST',
	  mode: 'cors',
	  headers: h
	});
	fetch(req)
	  .then(resp => resp.json())
	  .then(data => {
		console.log('data: ' + data.url);
		window.location.replace(data.url);
	   })
		 .catch(err => {
		   console.error(err.message);
		 })
  }