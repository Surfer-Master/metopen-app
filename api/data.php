<?php
include 'conn.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    // Invalid JSON data
    echo "Invalid JSON data.";
} else {
    print_r($data);

    print("var_dump");
    var_dump($data);
    $ph = $data['ph'];
    $kekeruhan = $data['kekeruhan'];
    $daya_konduksi = $data['daya_konduksi'];
    $karbon_dioksida = $data['karbon_dioksida'];
    $kelembaban = $data['kelembaban'];
    $suhu_air = $data['suhu_air'];

    $query  = "INSERT INTO sensors_data (ph, kekeruhan, daya_konduksi, karbon_dioksida, kelembaban, suhu_air) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("dddddd", $ph, $kekeruhan, $daya_konduksi, $karbon_dioksida, $kelembaban, $suhu_air);
    $stmt->execute();
}




// $json_data = $_POST['json_data'];
// $data = json_decode($json_data, true);

// if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
//     echo "Invalid JSON data.";
// } else {
//     var_dump($data);
// }
