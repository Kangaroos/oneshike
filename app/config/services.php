<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => array(
		'domain' => 'sandbox8acbb9a202df4432b108e2e2ba6a8775.mailgun.org',
		'secret' => 'key-8b6361a56482b285bfa51003b0680238',
	),

	'mandrill' => array(
		'secret' => 'FPjKlaszNLmpNJPXzeeIew',
	),

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),

);
