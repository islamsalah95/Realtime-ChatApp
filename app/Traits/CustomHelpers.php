<?php
namespace App\Traits;

use App\Models\web\Cart;
use App\Traits\ApiTraits;
use App\Models\web\Paying;
use Illuminate\Support\Facades\Auth;

trait CustomHelpers{

 public static function sendMail($sndTo,$text,$value){
    $curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://rapidprod-sendgrid-v1.p.rapidapi.com/mail/send",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "{\r
    \"personalizations\": [\r
        {\r
            \"to\": [\r
                {\r
                    \"email\": \"$sndTo\"\r
                }\r
            ],\r
            \"subject\": \"Hello, World!\"\r
        }\r
    ],\r
    \"from\": {\r
        \"email\": \"from_address@example.com\"\r
    },\r
    \"content\": [\r
        {\r
            \"type\": \"text/plain\",\r
            \"value\": \"$text  $value\"\r
        }\r
    ]\r
}",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: rapidprod-sendgrid-v1.p.rapidapi.com",
		"X-RapidAPI-Key: 18513f9b63mshfcf6b8031c512f9p1767b8jsn07411e49faf6",
		"content-type: application/json"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
 }




 public static function generateCode(){
    return rand(10000,99999);
 }






}
