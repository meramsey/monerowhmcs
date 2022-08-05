<?php

use Illuminate\Database\Capsule\Manager as Capsule;

function moneroEnable_config(): array {
	$result = Capsule::select("SELECT gateway, `value` FROM tblpaymentgateways WHERE setting = 'name' GROUP BY gateway");
	foreach ($result as $row) {
		$pays[] = $row->gateway;
	}

	$pays = implode(',', $pays);

	$configarray = [
		'name' => 'Monero Enabler',
		'description' => 'This module will allow you to disable fraud checking for Monero Payments.',
		'version' => '1.0',
		'author' => 'Monero',
		'fields' => [
			'option1' => ['FriendlyName' => 'Enable Checking', 'Type' => 'yesno', 'Size' => '25',
								  'Description' => 'Enable checking for payment method by module', ],
			'option2' => ['FriendlyName' => 'Disable on Method', 'Type' => 'dropdown', 'Options' => $pays,
								  'Description' => 'Select the Monero payment Gateway', ],
		]
	];

	return $configarray;
}
