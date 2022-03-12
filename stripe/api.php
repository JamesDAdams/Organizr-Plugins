<?php
$app->get('/plugins/stripe/settings', function ($request, $response, $args) {
	$StripePlugin = new StripePlugin();
	if ($StripePlugin->checkRoute($request)) {
		if ($StripePlugin->qualifyRequest(1, true)) {
			$GLOBALS['api']['response']['data'] = $StripePlugin->_pluginGetSettings();
		}
	}
	$response->getBody()->write(jsonE($GLOBALS['api']));
	return $response
		->withHeader('Content-Type', 'application/json;charset=UTF-8')
		->withStatus($GLOBALS['responseCode']);
});