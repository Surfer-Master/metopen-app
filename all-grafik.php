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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/2.0.1/chartjs-plugin-zoom.min.js" integrity="sha512-wUYbRPLV5zs6IqvWd88HIqZU/b8TBx+I8LEioQ/UC0t5EMCLApqhIAnUg7EsAzdbhhdgW07TqYDdH3QEXRcPOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                <a href="index.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Dashboard
                </a>
                <a href="index.php" class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard">
                    <i class="bi bi-speedometer fs-5"></i>
                </a>
            </li>
            <li>
                <a href="datatables.php" class="nav-link link-body-emphasis text-dashboard-item">
                    Data Grafik
                </a>
                <a href="datatables.php" class="nav-link link-body-emphasis icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Data Grafik">
                    <i class="bi bi-table fs-5"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="all-grafik.php" class="nav-link active text-dashboard-item">
                    Semua Grafik
                </a>
                <a href="all-grafik.php" class="nav-link active icon-dashboard-item p-0 m-0 py-1 text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Semua Grafik">
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

    <?php
    $colors = [
        1 => "red",
        2 => "blue",
        3 => "green",
        4 => "yellow",
        5 => "orange",
        6 => "purple",
        7 => "pink",
        8 => "brown",
        9 => "gray",
        10 => "cyan"
    ];
    $query = "SELECT * FROM `asal_air`";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $query1 = "SELECT * FROM `data` WHERE asal_air_id = {$row['id']}";
        $stmt1 = $mysqli->prepare($query1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        $dataPhAir['datasets'][] = array(
            'label' => $row['asal'],
            'data' => array(),
            'fill' => false,
            'borderColor' => $colors[$row['id']],
            'borderWidth' => 2,
            'tension' => 0.1
        );
        $dataSuhuAir['datasets'][] = array(
            'label' => $row['asal'],
            'data' => array(),
            'fill' => false,
            'borderColor' => $colors[$row['id']],
            'borderWidth' => 2,
            'tension' => 0.1
        );
        $dataKekeruhanAir['datasets'][] = array(
            'label' => $row['asal'],
            'data' => array(),
            'fill' => false,
            'borderColor' => $colors[$row['id']],
            'borderWidth' => 2,
            'tension' => 0.1
        );
        $dataSuhuLingkungan['datasets'][] = array(
            'label' => $row['asal'],
            'data' => array(),
            'fill' => false,
            'borderColor' => $colors[$row['id']],
            'borderWidth' => 2,
            'tension' => 0.1
        );
        $dataKelembabanLingkungan['datasets'][] = array(
            'label' =>  $row['asal'],
            'data' => array(),
            'fill' => false,
            'borderColor' => $colors[$row['id']],
            'borderWidth' => 2,
            'tension' => 0.1
        );

        while ($row1 = $result1->fetch_assoc()) {
            $dataPhAir['labels'][] = '';
            $dataPhAir['datasets'][$row['id'] - 1]['data'][] = $row1['ph_air'];

            $dataSuhuAir['labels'][] = '';
            $dataSuhuAir['datasets'][$row['id'] - 1]['data'][] = $row1['suhu_air'];

            $dataKekeruhanAir['labels'][] = '';
            $dataKekeruhanAir['datasets'][$row['id'] - 1]['data'][] = $row1['kekeruhan'];

            $dataSuhuLingkungan['labels'][] = '';
            $dataSuhuLingkungan['datasets'][$row['id'] - 1]['data'][] = $row1['suhu_lingkungan'];

            $dataKelembabanLingkungan['labels'][] = '';
            $dataKelembabanLingkungan['datasets'][$row['id'] - 1]['data'][] = $row1['kelembaban_lingkungan'];
        }
    }

    $stmt->close();
    $stmt1->close();
    $mysqli->close();
    ?>

    <div class="main-content">
        <div class="container scrollarea">
            <div class="row">
                <div class="col-md-12 pt-3 pb-3 border-bottom bg index">
                    <a href="#" class="d-flex align-items-center me-md-auto text-dark text-decoration-none">
                        <span class="fs-6 text-muted me-2">Dashboard </span>
                        <span class="fs-4 text-muted"> - </span>
                        <span class="ms-2 fs-6 fw-bold">Semua Grafik</span>
                    </a>
                </div>
            </div>
            <div class="row mt-5 justify-content-around">
                <div class="col-md-6">
                    <div class="container pt-4">
                        <section class="mb-4">
                            <div class="card">
                                <div class="card-header py-3 bg-secondary">
                                    <h5 class="mb-0 text-center"><strong class="text-white">Grafik Kekeruhan</strong></h5>
                                </div>
                                <div class="card-body">
                                    <canvas class="my-4 w-100" id="chartKekeruhanAir" height="380"></canvas>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container pt-4">
                        <section class="mb-4">
                            <div class="card">
                                <div class="card-header py-3 bg-success">
                                    <h5 class="mb-0 text-center"><strong class="text-white">Grafik Suhu Air</strong></h5>
                                </div>
                                <div class="card-body">
                                    <canvas class="my-4 w-100" id="chartSuhuAir" height="380"></canvas>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container pt-4">
                        <section class="mb-4">
                            <div class="card">
                                <div class="card-header py-3 bg-danger">
                                    <h5 class="mb-0 text-center"><strong class="text-white">Grafik PH Air</strong></h5>
                                </div>
                                <div class="card-body">
                                    <canvas class="my-4 w-100" id="chartPhAir" height="380"></canvas>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-md-6 justify-content-around">
                    <div class="container pt-4">
                        <section class="mb-4">
                            <div class="card">
                                <div class="card-header py-3 bg-primary">
                                    <h5 class="mb-0 text-center"><strong class="text-white">Grafik Suhu Lingkungan</strong></h5>
                                </div>
                                <div class="card-body">
                                    <canvas class="my-4 w-100" id="chartSuhuLingkungan" height="380"></canvas>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container pt-4">
                        <section class="mb-4">
                            <div class="card">
                                <div class="card-header py-3 bg-warning">
                                    <h5 class="mb-0 text-center"><strong class="text-white">Grafik Kelembaban</strong></h5>
                                </div>
                                <div class="card-body">
                                    <canvas class="my-4 w-100" id="chartKelembabanLingkungan" height="380"></canvas>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let options = {
            scales: {
                x: {
                    // type: 'time',
                    // time: {
                    //     displayFormats: {
                    //         quarter: 'MMM YYYY'
                    //     }
                    // }
                },
                y: {
                    // beginAtZero: true,
                },
            },
            plugins: {
                zoom: {
                    pan: {
                        enabled: true
                    },
                    zoom: {
                        wheel: {
                            enabled: true,
                        },
                        mode: 'xy',
                    }
                }
            }
        };

        let dataPhAir = <?= json_encode($dataPhAir) ?>;

        let ctxPhAir = document.getElementById("chartPhAir").getContext("2d");
        let chartPhAir = new Chart(ctxPhAir, {
            type: 'line',
            data: dataPhAir,
            options: options
        });

        let dataSuhuAir = <?= json_encode($dataSuhuAir) ?>;
        let ctxSuhuAir = document.getElementById("chartSuhuAir").getContext("2d");
        let chartSuhuAir = new Chart(ctxSuhuAir, {
            type: 'line',
            data: dataSuhuAir,
            options: options
        });

        let dataKekeruhanAir = <?= json_encode($dataKekeruhanAir) ?>;
        let ctxKekeruhanAir = document.getElementById("chartKekeruhanAir").getContext("2d");
        let chartKekeruhanAir = new Chart(ctxKekeruhanAir, {
            type: 'line',
            data: dataKekeruhanAir,
            options: options
        });

        let dataSuhuLingkungan = <?= json_encode($dataSuhuLingkungan) ?>;
        let ctxSuhuLingkungan = document.getElementById("chartSuhuLingkungan").getContext("2d");
        let chartSuhuLingkungan = new Chart(ctxSuhuLingkungan, {
            type: 'line',
            data: dataSuhuLingkungan,
            options: options
        });

        let dataKelembabanLingkungan = <?= json_encode($dataKelembabanLingkungan) ?>;
        let ctxKelembabanLingkungan = document.getElementById("chartKelembabanLingkungan").getContext("2d");
        let chartKelembabanLingkungan = new Chart(ctxKelembabanLingkungan, {
            type: 'line',
            data: dataKelembabanLingkungan,
            options: options
        });
    </script>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/sidebars.js"></script>
</body>

</html>