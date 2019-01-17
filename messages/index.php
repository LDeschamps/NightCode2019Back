<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

require '../vendor/autoload.php';

if (!empty($_POST['payload'])) {
    $payload = [];

    $payload = json_decode($_POST['payload']);

    $responsejson = [];

    $inputs = $payload->inputs;

    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'http://nightcode-phobos.cleverapps.io/input/',
        // You can set any number of default request options.
        'timeout' => 2.0,
    ]);

    foreach ($inputs as $input) {
        $response = [
            "external_id" => $input->uuid,
            "content" => $input->msg
        ];

        $response = json_encode($response);

        $request = new Request('POST', 'messages',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'X-API-Key' => 'f5849aa8e9a7b4df436902587209058011484473a0c66c0db0440985671a2589'
                ]
            ],$response);

        $responsePost = $client->send($request);
        echo $responsePost->getStatusCode();
    }

    $responsejson = json_encode($response);

    echo $responsejson;
}