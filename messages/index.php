<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

require '../vendor/autoload.php';

$request = [];

$request = json_decode(file_get_contents("php://input"));

if (!empty($request->body)) {
    $request = $request->body;
}

if (!empty($request->type)) {
    $type = $request->type;
} else {
    $type = "";
}
switch ($type) {
    case "default":
        $payload = $request->payload;
        $inputs = $payload->inputs;
        if (empty($inputs)) {
            header("HTTP/1.1 400 Bad Request");
            exit();
        }
        $baseuri = "http://nightcode-phobos.cleverapps.io/input/messages";
        foreach ($inputs as $input) {
            if (!empty($input->msg)) {
                $response = [
                    "external_id" => $input->uuid,
                    "content" => $input->msg
                ];

                $client = new Client([
                    'base_uri' => $baseuri,
                ]);
                $response = json_encode($response);

                $request = new Request('POST', '',
                    [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'x-api-key' => 'f5849aa8e9a7b4df436902587209058011484473a0c66c0db0440985671a2589'

                    ], $response);

                try {
                    $responsePost = $client->send($request);
                } catch (RequestException $e) {
                    header("HTTP/1.1 400 Bad Request");
                    exit();
                }
            } else {
                header("HTTP/1.1 400 Bad Request");
                exit();
            }
        }
        break;
    case "message-to-mom":
        $payload = $request->payload;
        $messages = $payload->messages;
        if (empty($messages)) {
            header("HTTP/1.1 400 Bad Request");
            exit();
        }
        $baseuri = "http://nightcode-phobos.cleverapps.io/input/moms-messages/add";
        foreach ($messages as $message) {
            if (!empty($message->text)) {
                $response = [
                    "external_id" => $message->uuid,
                    "message" => $message->text
                ];

                $client = new Client([
                    'base_uri' => $baseuri,
                ]);
                $response = json_encode($response);

                $request = new Request('POST', '',
                    [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'x-api-key' => 'f5849aa8e9a7b4df436902587209058011484473a0c66c0db0440985671a2589'

                    ], $response);

                try {
                    $responsePost = $client->send($request);
                } catch (RequestException $e) {
                    header("HTTP/1.1 400 Bad Request");
                    exit();
                }
            } else {
                header("HTTP/1.1 400 Bad Request");
                exit();
            }
        }
        break;
    case "for-mr-clerentin":
        $messages = $request->messages;
        if (empty($messages)) {
            header("HTTP/1.1 400 Bad Request");
            exit();
        }
        $baseuri = "http://nightcode-phobos.cleverapps.io/input/clerentins-messages/add";
        foreach ($messages as $message) {
            if (!empty($message->text)) {
                $response = [
                    "external_id" => $message->uuid,
                    "message" => $message->text
                ];

                $client = new Client([
                    'base_uri' => $baseuri,
                ]);
                $response = json_encode($response);

                $request = new Request('POST', '',
                    [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'x-api-key' => 'f5849aa8e9a7b4df436902587209058011484473a0c66c0db0440985671a2589'

                    ], $response);

                try {
                    $responsePost = $client->send($request);
                } catch (RequestException $e) {
                    header("HTTP/1.1 400 Bad Request");
                    exit();
                }
            } else {
                header("HTTP/1.1 400 Bad Request");
                exit();
            }
        }
        break;
    default:
        header("HTTP/1.1 400 Bad Request");
        exit();
        break;
}