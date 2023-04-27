<?php
include '../conn.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    // Invalid JSON data
    echo "Invalid JSON data.";
} else if (isset($data["delay_time"])) {
    try {
        $delay_time = $data['delay_time'];

        $query  = "INSERT INTO nic (delay_time) VALUES (?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $delay_time);
        $stmt->execute();

        http_response_code(201);
        echo 'Data delay berhasil disimpan';

        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo 'Data delay gagal disimpan';
        echo 'Exception: ' . $e->getMessage();
    }
} else if (isset($data["ph_air"]) && isset($data["suhu_air"]) && isset($data["kekeruhan"]) && isset($data["suhu_lingkungan"]) && isset($data["kelembaban_lingkungan"])) {
    try {
        $ph_air = $data['ph_air'];
        $suhu_air = $data['suhu_air'];
        $kekeruhan = $data['kekeruhan'];
        $suhu_lingkungan = $data['suhu_lingkungan'];
        $kelembaban_lingkungan = $data['kelembaban_lingkungan'];

        $query  = "INSERT INTO data (ph_air, suhu_air, kekeruhan, suhu_lingkungan, kelembaban_lingkungan) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ddddd", $ph_air, $suhu_air, $kekeruhan, $suhu_lingkungan, $kelembaban_lingkungan);
        $stmt->execute();

        http_response_code(201);
        // echo json_encode(['message' => 'Data berhasil disimpan']);
        echo 'Data sensor berhasil disimpan';

        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo 'Data sensor gagal disimpan';
        echo 'Exception: ' . $e->getMessage();
    }
}
