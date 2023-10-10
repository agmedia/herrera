<?php
//create curl resource
$ch = curl_init();
//set url
curl_setopt($ch, CURLOPT_URL, 'https://e-racuni.com/H5h/API-CLI/SalesQuoteCreate');
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//HTTP post
curl_setopt($ch, CURLOPT_POST, 1);
//define POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, '&SalesQuote={"vatTransactionType":"0","buyerName":"tomislav
>juresa","buyerStreet":"MArticeva
>67","buyerPostalcode":"10000","buyerCity":"zagreb","buyerEmail":"
>tomislav@agmedia.hr","buyerPhone":"0992153975","methodOfPayment":"BankTransfer","Address":{"street":"MArticeva
>67","postalCode":"10000","city":"Zagreb","type":"Delivery"},"Items":[{"productCode":"A.0041","productName":"Kutija
>razvodna za \u0161uplje zidove 3xfi60
>A.0041","quantity":2,"price":1},{"productCode":"A.0010","productName":"Kutija
>razvodna za \u0161uplje zidove 2xfi60 A.0010","quantity":1,"price":1}]}');
//define user credentials
curl_setopt($ch, CURLOPT_USERPWD, 'TOMISLAV_AGMEDIA:54D4DBEAB8C30D00850D447D093BAFEB_f93ff2cdb12c43bec44dd9f0f2462fed');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>