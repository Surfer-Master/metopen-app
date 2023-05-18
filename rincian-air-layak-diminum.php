<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

require 'conn.php';
include "./Model/data.model.php";
include "./Controller/data.controller.php";
include "./View/data.view.php";
$datas = new DataView();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | Rincian Air Layak Diminum</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/sidebars.css" />
    <link rel="shortcut icon" href="public/image/untan.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <div class="sidebar d-flex flex-column flex-shrink-0 p-1 p-md-3 bg-body-secondary">
        <a href="" class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4 fw-bold text-text-center">
                <img src="public/image/untan.png" width="30px" class="mx-1 me-md-2">
                <span class="text-dashboard-item">Metopen App</span>
            </span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="index.php" class="nav-link active text-dashboard-item">
                    Dashboard
                </a>
                <a href="index.php" class="nav-link active icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard">
                    <i class="bi bi-speedometer fs-5"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="data-tables.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Data Grafik
                </a>
                <a href="data-tables.php" class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Data Grafik">
                    <i class="bi bi-table fs-5"></i>
                </a>
            </li>
            <li>
                <a href="all-grafik.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Semua Grafik
                </a>
                <a href="all-grafik.php" class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Semua Grafik">
                    <i class="bi bi-graph-up fs-5"></i>
                </a>
            </li>
            <li>
                <a href="nic.php" class="nav-link link-body-emphasis text-dashboard-item">
                    NIC
                </a>
                <a href="nic.php" class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="NIC">
                    <i class="bi bi-ui-checks-grid fs-5"></i>
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-3 me-2"></i>

                <strong class="text-dashboard-item"><?= $_SESSION['admin-name'] ?></strong>
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li>
                    <form action="logout.php" method="POST">
                        <button type="submit" class="dropdown-item" name="logout">
                            <span>
                                Log Out <i class="bi bi-box-arrow-right fs-5"></i>
                            </span></button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="container scrollarea">
            <div class="row">
                <div class="col-md-12 pt-3 pb-3 border-bottom bg index">
                    <a href="" class="d-flex align-items-center me-md-auto text-dark text-decoration-none">
                        <span class="fs-6 text-muted me-2">Dashboard </span><span class="fs-4 text-muted"> - </span><span class="ms-2 fs-6 fw-bold"> Data <?= $_GET['asal-air'] ?></span>
                    </a>
                </div>
            </div>
            <div class="row m-2 mt-5">
                <div class="col-md-12 shadow-lg border border-0 rounded-4 mt-5 mb-5">
                    <div class="row mb-2">
                        <div class="col-md-12 bg-primary text-center border-0 border-bottom rounded-top-4 p-2">
                            <span class="fs-5 text-white fw-bold">
                                Tabel Semua Data <?= $_GET['asal-air'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="container p-3">
                        <div class="col-md-12 table-responsive text-center">
                            <table class="table table-striped align-middle" id="data_grafik_table">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">No</th>
                                        <th class="align-middle text-center">Waktu</th>
                                        <th class="align-middle text-center">PH Air</th>
                                        <th class="align-middle text-center">Suhu Air (°C)</th>
                                        <th class="align-middle text-center">Kekeruhan (NTU)</th>
                                        <th class="align-middle text-center">Suhu Lingkungan (°C)</th>
                                        <th class="align-middle text-center">Kelembaban (%)</th>
                                        <th class="align-middle text-center">Asal Air</th>
                                        <th class="align-middle text-center">Status</th>
                                        <th class="align-middle text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $asal_air = $_GET['asal-air'];
                                    $query = "SELECT data.*, asal_air.asal AS asal_air_asal, status_air.status AS status_air_status FROM data JOIN asal_air ON data.asal_air_id = asal_air.id JOIN status_air ON data.status_air_id = status_air.id WHERE kelayakan = true && asal = ?";
                                    $stmt = $mysqli->prepare($query);
                                    $stmt->bind_param("s", $asal_air);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['kelayakan'] == true) {
                                            $keterangan = "Layak Diminum";
                                        } else {
                                            $keterangan = "Tidak Layak Diminum";
                                        } ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><?= $row['ph_air'] ?></td>
                                            <td><?= $row['suhu_air'] ?></td>
                                            <td><?= $row['kekeruhan'] ?></td>
                                            <td><?= $row['suhu_lingkungan'] ?></td>
                                            <td><?= $row['kelembaban_lingkungan'] ?></td>
                                            <td><?= $row['asal_air_asal'] ?></td>
                                            <td><?= $row['status_air_status'] ?></td>
                                            <td><?= $keterangan ?></td>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/sidebars.js"></script>
    <script src="public/js/script.js"></script>
</body>

</html>