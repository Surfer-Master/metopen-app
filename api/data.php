<?php
include '../conn.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    // Invalid data
    echo "Invalid data.";
} else if (isset($data["delay_time"])) {
    try {
        $delay_time = $data['delay_time'];
        // $asal_air_id = $data['asal_air_id'];

        $asal_air_id = 1; // Air Bukit Kelam
        // $asal_air_id = 2; // Air PDAM Kuburaya
        // $asal_air_id = 3; // Air PDAM Tanjung Raya

        $query  = "INSERT INTO nic (delay_time, asal_air_id) VALUES (?,?)";
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param("di", $delay_time, $asal_air_id);
        $stmt->execute();

        http_response_code(201);
        echo 'Data delay berhasil disimpan';

        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo 'Data delay gagal disimpan';
        echo 'Exception: ' . $e->getMessage();
    }
} else if (isset($data["ph_air"]) && isset($data["suhu_air"]) && isset($data["kekeruhan"]) && isset($data["suhu_lingkungan"]) && isset($data["kelembaban_lingkungan"]) && isset($data["asal_air_id"]) && isset($data["status_air_id"]) && isset($data["kelayakan"])) {
    try {
        $ph_air = $data['ph_air'];
        $suhu_air = $data['suhu_air'];
        $kekeruhan = $data['kekeruhan'];
        $suhu_lingkungan = $data['suhu_lingkungan'];
        $kelembaban_lingkungan = $data['kelembaban_lingkungan'];
        // $asal_air_id = $data['asal_air_id'];

        $asal_air_id = 1; // Air Bukit Kelam
        // $asal_air_id = 2; // Air PDAM Kuburaya
        // $asal_air_id = 3; // Air PDAM Tanjung Raya

        $status_air_id = $data['status_air_id'];
        $kelayakan = $data['kelayakan'];

        $query  = "INSERT INTO data (ph_air, suhu_air, kekeruhan, suhu_lingkungan, kelembaban_lingkungan, asal_air_id, status_air_id, kelayakan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("dddddiii", $ph_air, $suhu_air, $kekeruhan, $suhu_lingkungan, $kelembaban_lingkungan, $asal_air_id, $status_air_id, $kelayakan);
        $stmt->execute();

        http_response_code(201);
        echo 'Data sensor berhasil disimpan';

        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo 'Data sensor gagal disimpan';
        echo 'Exception: ' . $e->getMessage();
    }
}
