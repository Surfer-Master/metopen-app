<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
include "conn.php";
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/sidebars.css" />
    <link rel="shortcut icon" href="public/image/untan.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card {
            border-radius: 5px;
            background-color: indigo;
        }

        .card:hover {
            background-color: blue;
        }

        .card2 {
            border-radius: 5px;
            background-color: green;
        }

        .card2:hover {
            background-color: blue;
        }
    </style>
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
            <li class="nav-item">
                <a href="index.php" class="nav-link active text-dashboard-item">
                    Dashboard
                </a>
                <a href="index.php" class="nav-link active icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard">
                    <i class="bi bi-speedometer fs-5"></i>
                </a>
            </li>
            <li>
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
                        <button type="submit" class="dropdown-item " name="logout">
                            <span>
                                Log Out <i class="bi bi-box-arrow-right fs-5"></i>
                            </span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="container scrollarea">
            <div class="row">
                <div class="col-md-12 border-bottom bgi index bg-white">
                    <a href="" class="d-flex align-items-center me-md-auto text-dark text-decoration-none">
                        <span class="fs-6 text-muted me-2 fw-bold">Dashboard </span>
                    </a>
                </div>
            </div>
            <div class="mt-5 pt-3">
                <div class="row mt-2 ms-1 me-1 mt-lg-4 ms-lg-4 me-lg-4 ">
                    <div class="col-md-12">
                        <div class="card bg-warning rounded-0 mb-4 rounded-3">
                            <div class="card-body pt-0 mt-3">
                                <h5 class="card-title">Selamat Datang, <span class="text text-black fw-boldest"><?= $_SESSION['admin-name'] ?></span></h5>
                                <p class="card-text fw-bold">Di Sistem Informasi Monitoring Air.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-4 mt-0">
                    <div class="col-md-12">
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <div class="card hoverable card-xl-stretch mb-5 mb-xl-8 rounded-1">
                                    <div class="shadow">
                                        <a class="text-decoration-none card" href="air-layak-minum.php">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-moisture text-white" viewBox="0 0 16 16">
                                                        <path d="M13.5 0a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V7.5h-1.5a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V15h-1.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V.5a.5.5 0 0 0-.5-.5h-2zM7 1.5l.364-.343a.5.5 0 0 0-.728 0l-.002.002-.006.007-.022.023-.08.088a28.458 28.458 0 0 0-1.274 1.517c-.769.983-1.714 2.325-2.385 3.727C2.368 7.564 2 8.682 2 9.733 2 12.614 4.212 15 7 15s5-2.386 5-5.267c0-1.05-.368-2.169-.867-3.212-.671-1.402-1.616-2.744-2.385-3.727a28.458 28.458 0 0 0-1.354-1.605l-.022-.023-.006-.007-.002-.001L7 1.5zm0 0-.364-.343L7 1.5zm-.016.766L7 2.247l.016.019c.24.274.572.667.944 1.144.611.781 1.32 1.776 1.901 2.827H4.14c.58-1.051 1.29-2.046 1.9-2.827.373-.477.706-.87.945-1.144zM3 9.733c0-.755.244-1.612.638-2.496h6.724c.395.884.638 1.741.638 2.496C11 12.117 9.182 14 7 14s-4-1.883-4-4.267z" />
                                                    </svg>
                                                    <div class="text-white fw-bolder fs-1 mb-2 mt-5 text-end">
                                                        <?php $datas->jumlahAirLayakMinum() ?>
                                                    </div>
                                                </div>
                                                <div class="fw-bold text-white text-end fs-6">Jumlah Layak Diminum</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card2 hoverable card-xl-stretch mb-5 mb-xl-8 rounded-1">
                                    <div class="shadow">
                                        <a class="text-decoration-none card2" href="air-tidak-layak-diminum.php">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-moisture text-white" viewBox="0 0 16 16">
                                                        <path d="M13.5 0a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V7.5h-1.5a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V15h-1.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V.5a.5.5 0 0 0-.5-.5h-2zM7 1.5l.364-.343a.5.5 0 0 0-.728 0l-.002.002-.006.007-.022.023-.08.088a28.458 28.458 0 0 0-1.274 1.517c-.769.983-1.714 2.325-2.385 3.727C2.368 7.564 2 8.682 2 9.733 2 12.614 4.212 15 7 15s5-2.386 5-5.267c0-1.05-.368-2.169-.867-3.212-.671-1.402-1.616-2.744-2.385-3.727a28.458 28.458 0 0 0-1.354-1.605l-.022-.023-.006-.007-.002-.001L7 1.5zm0 0-.364-.343L7 1.5zm-.016.766L7 2.247l.016.019c.24.274.572.667.944 1.144.611.781 1.32 1.776 1.901 2.827H4.14c.58-1.051 1.29-2.046 1.9-2.827.373-.477.706-.87.945-1.144zM3 9.733c0-.755.244-1.612.638-2.496h6.724c.395.884.638 1.741.638 2.496C11 12.117 9.182 14 7 14s-4-1.883-4-4.267z" />
                                                    </svg>
                                                    <div class="text-white fw-bolder fs-1 mb-2 mt-5 text-end">
                                                        <?php $datas->jumlahAirTidakLayakMinum() ?>
                                                    </div>
                                                </div>
                                                <div class="fw-bolder text-end fs-6 text-white">Jumlah Tidak Layak Diminum</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/sidebars.js"></script>
</body>

</html>