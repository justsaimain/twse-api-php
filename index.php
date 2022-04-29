<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

header('Content-type: application/json');

$url = "https://www.twse.com.tw/rsrc/data/zh/home/marquee.json";

$client = new Client([
    'base_uri' => $url
]);

$response = $client->request('GET');

$arr_data = json_decode($response->getBody(), true);
$taiex = $arr_data['taiex'];

$return_data = [
    'buy' => (string) $taiex['index'],
    'sell' =>  (string) $taiex['volume'],
    'buy1' => substr($taiex['index'], -1),
    'sell1' => substr(explode('.', $taiex['volume'])[0], -1)
];

echo json_encode($return_data);
