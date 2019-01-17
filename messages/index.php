<?php

if (!empty($_POST['payload'])) {
    $payload = [];

    $payload = json_decode($_POST['payload']);

    $responsejson = [];

    var_dump($payload);

    $inputs = $payload->inputs;

    var_dump($inputs);

    foreach ($inputs as $input)
        $response[] = [
            "external_id" => $input->uuid,
            "content" => $input->msg
        ];

    $responsejson = json_encode($response);

    echo $responsejson;
}