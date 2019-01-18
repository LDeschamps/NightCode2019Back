<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

require '../vendor/autoload.php';

$request = [];

$request = json_decode(file_get_contents("php://input"));

$payload = $request->payload;

$inputs = $payload->inputs;


$request = [];

$request = json_decode(file_get_contents("php://input"));

$payload = $request->payload;

$inputs = $payload->inputs;

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://nightcode-phobos.cleverapps.io/input/',
    // You can set any number of default request options.
    'timeout' => 2.0,
]);

foreach ($inputs as $input) {
    if (!empty($input->msg)) {
        $response = [
            "external_id" => $input->uuid,
            "content" => $input->msg
        ];
        $response = json_encode($response);

        $request = new Request('POST', 'messages',
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'x-api-key' => 'f5849aa8e9a7b4df436902587209058011484473a0c66c0db0440985671a2589'

            ], $response);

        try {
            $responsePost = $client->send($request);
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    } elseif (!empty($input->text)) {
        $response = [
            "external_id" => $input->uuid,
            "message" => $input->text
        ];
        $response = json_encode($response);

        $request = new Request('POST', 'moms-messages/add',
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'x-api-key' => 'f5849aa8e9a7b4df436902587209058011484473a0c66c0db0440985671a2589'

            ], $response);

        try {
            $responsePost = $client->send($request);
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    } elseif (!empty($input->content)){
        $response = [
            "external_id" => $input->uuid,
            "message" => $input->content
        ];
        $response = json_encode($response);

        $request = new Request('POST', 'clerentins-messages/add',
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'x-api-key' => 'f5849aa8e9a7b4df436902587209058011484473a0c66c0db0440985671a2589'

            ], $response);

        try {
            $responsePost = $client->send($request);
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }
    else{
        header("HTTP/1.1 400 Bad Request");
    }
}