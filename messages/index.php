<?php

$payload = $_POST['payload'];

if (!empty($payload)){

    $responsejson = new \StdClass();

    foreach ($payload['inputs'] as $inputs)
        $response = [
            "external_id" => $inputs['uuid'],
            "content" => $inputs['msg']
        ];

    $responsejson = json_encode($response);

    echo $responsejson;
}