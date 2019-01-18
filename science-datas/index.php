<?php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
require '../vendor/autoload.php';
$php_input = file_get_contents("php://input");
if (isset($php_input)) {
    $request = [];
    $request = json_decode(file_get_contents("php://input"));
    if(!empty($request->uuid) && !empty($request->datas)){
        $uuid = $request->uuid;
        $datas = $request->datas;
        foreach($datas as $data){
            if(!empty($data->type) && !empty($data->unit) && !empty($data->value)){
                $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'http://nightcode-phobos.cleverapps.io/input/science-datas/',
                // You can set any number of default request options.
                'timeout' => 2.0,
                ]);
                switch($data->unit){
                        case "celsius-degrees":
                                $donnees[] = [
                                    "type" => $data->type,
                                    "unit" => "fahrenheit-degrees",
                                    "value" => ($data->value*9/5)+32
                                ];
                                break;
                        case "milli-pirate-ninjas":
                                $donnees[] = [
                                    "type" => $data->type,
                                    "unit" => "kilo-joules",
                                    "value" => $data->value
                                ];
                                break;
                        case "pounds":
                                $donnees[] = [
                                    "type" => $data->type,
                                    "unit" => "kilograms",
                                    "value" => $data->value/2.205
                                ];
                                break;
                        case "gallons":
                                $donnees[] = [
                                    "type" => $data->type,
                                    "unit" => "liters",
                                    "value" => $data->value*3.785
                                ];
                                break;
                        default:
                                break;
                }
                $response = [
                                "external_id" => $uuid,
                                "datas" => $donnees
                            ];
                $response = json_encode($response);
                $request = new Request('POST', 'add',
                    [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'x-api-key' => 'f5849aa8e9a7b4df436902587209058011484473a0c66c0db0440985671a2589'
                    ],$response);
                try {
                    $responsePost = $client->send($request);
                } catch (RequestException $e) {
                    echo Psr7\str($e->getRequest());
                    if ($e->hasResponse()) {
                        echo Psr7\str($e->getResponse());
                    }
                }
                $responsejson = json_encode($response);
            }
            else {
                header("HTTP/1.1 400 Bad Request");
            }
        }
    }
    else {
        //header("HTTP/1.1 400 Bad Request");
    }
}