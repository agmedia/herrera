<?php
    
    $str = 'TOMISLAV_AGMEDIAtomislav2023';
	$md5pass = md5($str);


	$string = '<?xml version="1.0" encoding="UTF-8"?>
	<request>
        <login username="TOMISLAV_AGMEDIA" md5pass="f93ff2cdb12c43bec44dd9f0f2462fed" token="0CB8388F48C40D0083F58A4F0E65B21B" />
     

         <method name="ProductImageGet">
                <!-- Product code / SKU -->
                <parameter name="productCode" value="00003" />
        </method>


</request>';

    $array = [
        "username"   => 'TOMISLAV_AGMEDIA',
        "md5pass"    => 'f93ff2cdb12c43bec44dd9f0f2462fed6',
        "token"      => '0CB8388F48C40D0083F58A4F0E65B21B',
        "method"     => "ProductImageGet",
        "parameters" => [
            "productCode" => '00003'
        ]
    ];


	$server = "https://e-racuni.com/H5h/API-CLI"; 
	$ch = curl_init($server);
	curl_setopt($ch, CURLOPT_HEADER, ("Content-Type: application/json"));
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	$data = htmlentities(curl_exec($ch));
	
	$curl_errno = curl_errno($ch);
	$curl_error = curl_error($ch);

	curl_close($ch);
	if ($curl_errno > 0) {
		echo ('cURL Error ($curl_errno): $curl_error\n');
		exit;
	} else {
		print_r($data);
	}
	exit;
?>
	