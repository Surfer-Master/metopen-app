<?php

$data = json_decode(file_get_contents('php://input'), true);
if (!$data == NULL) {

    # code...
    print_r($data);

    print("var_dump");
    var_dump($data);
    $sensor = $data['sensor'];
    $nilai = $data['nilai'];

    print(file_get_contents('php://input'));
}


if (isset($_POST['FingerID']) && isset($_POST['device_id'])) {
    $fingerID = $_POST['FingerID'];
    $device_id = $_POST['device_id'];
}
