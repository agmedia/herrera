<?php
    
    $str = 'TOMISLAV_AGMEDIAtomislav2023';
	$md5pass = md5($str);


	$string = '<?xml version="1.0" encoding="UTF-8"?>
	<request>
        <login username="TOMISLAV_AGMEDIA" md5pass="d1ec7fbdfd48ed2f9914c728dddaac46" token="5DC91B74D6BC0D00B45E039D03E4A5E3" />
     

         <method name="ProductImageGet">
                <!-- Product code / SKU -->
                <parameter name="productCode" value="00003" />
        </method>


</request>';

    $array = [
        "username"   => 'TOMISLAV_AGMEDIA',
        "md5pass"    => 'd1ec7fbdfd48ed2f9914c728dddaac46',
        "token"      => '5DC91B74D6BC0D00B45E039D03E4A5E3',
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
	