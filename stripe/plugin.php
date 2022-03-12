<?php
// PLUGIN INFORMATION
$GLOBALS['plugins']['Stripe'] = array( // Plugin Name
	'name' => 'Stripe', // Plugin Name
	'author' => 'Enielka&JamesAdams', // Who wrote the plugin
	'category' => 'Utilities', // One to Two Word Description
	'link' => '', // Link to plugin info
	'license' => 'personal', // License Type use , for multiple
	'idPrefix' => 'STRIPE', // html element id prefix (All Uppercase)
	'configPrefix' => 'STRIPE', // config file prefix for array items without the hypen (All Uppercase)
	'version' => '0.0.1', // SemVer of plugin
	'image' => 'api/plugins/stripe/logo.png', // 1:1 non transparent image for plugin
	'settings' => true, // does plugin need a settings modal?
	'bind' => true, // use default bind to make settings page - true or false
	'api' => 'api/v2/plugins/stripe/settings', // api route for settings page (All Lowercase)
	'homepage' => false // Is plugin for use on homepage? true or false
);

class StripePlugin extends Organizr
{
	public function _pluginGetSettings()
	{
		return array(
			'custom' => '
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								<span lang="en">Notice</span>
							</div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">
									<ul class="list-icons">
										<li><i class="fa fa-chevron-right text-danger"></i> <a href="https://dashboard.stripe.com/login" target="_blank"><span lang="en">Login in on Stripe</span></a></li>
										<li><i class="fa fa-chevron-right text-danger"></i> <span lang="en">Go to Dashboard top right</span></li>
										<li><i class="fa fa-chevron-right text-danger"></i> <span lang="en">On left menu, click on API keys</span></li>
										<li><i class="fa fa-chevron-right text-danger"></i> <span lang="en">Create new secret key</span></li>
										<li><i class="fa fa-chevron-right text-danger"></i> <span lang="en">Copy the secret key that was generated</span></li>
										<li><i class="fa fa-chevron-right text-danger"></i> <span lang="en">Past the secret key on plugin config</span></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			',
			'Config' => array(
				array(
					'type' => 'password-alt',
					'name' => 'STRIPE-secret-key-api-prod-include',
					'label' => 'Stripe secret key api prod',
					'value' => $this->config['STRIPE-secret-key-api-prod-include'],
				),
				array(
					'type' => 'select',
					'name' => 'STRIPE-Auth-include',
					'label' => 'Minimum Authentication for see stripe client pannel',
					'value' => $this->config['STRIPE-Auth-include'],
					'options' => $this->groupSelect()
				)
			),
			'Error message' => array(
				array(
					'type' => 'text',
					'name' => 'STRIPE-menu-label-include',
					'label' => 'Menu label',
					'value' => $this->config['STRIPE-menu-label-include']
				),
				array(
					'type' => 'text',
					'name' => 'STRIPE-error-get-user-id-label-include',
					'label' => 'Error message if user doesn\'t have a stripe subscribe',
					'value' => $this->config['STRIPE-error-get-user-id-label-include']
				),
				array(
					'type' => 'number',
					'name' => 'STRIPE-error-get-user-id-time-include',
					'label' => 'Time when the error message are display if user doesn\'t have a stripe subscribe',
					'value' => $this->config['STRIPE-error-get-user-id-time-include']
				),
			),
		);
	}
}
