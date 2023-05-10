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
    $query1 = "SELECT * FROM `data` WHERE asal_air_id = 1"; // Bukit Kelam
    $stmt1 = $mysqli->prepare($query1);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    $query2 = "SELECT * FROM `data` WHERE asal_air_id = 2"; // PDAM Kubu Raya
    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $query3 = "SELECT * FROM `data` WHERE asal_air_id = 3"; // Kota Bandung
    $stmt3 = $mysqli->prepare($query3);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    $query4 = "SELECT * FROM `data` WHERE asal_air_id = 4"; // Tanray
    $stmt4 = $mysqli->prepare($query4);
    $stmt4->execute();
    $result4 = $stmt4->get_result();

    $dataPhAir = array(
        'labels' => array(),
        'datasets' => array(
            array(
                'label' => "Bukit Kelam",
                'data' => array(),
                'fill' => false,
                'borderColor' => "red",
                'borderWidth' => 2,
                'tension' => 0.1
            )
        )
    );
    $dataPhAir['datasets'][] = array(
        'label' => "PDAM Kubu Raya",
        'data' => array(),
        'fill' => false,
        'borderColor' => "blue",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataPhAir['datasets'][] = array(
        'label' => "Kota Bandung",
        'data' => array(),
        'fill' => false,
        'borderColor' => "grey",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataPhAir['datasets'][] = array(
        'label' => "Tanray",
        'data' => array(),
        'fill' => false,
        'borderColor' => "green",
        'borderWidth' => 2,
        'tension' => 0.1
    );

    $dataSuhuAir = array(
        'labels' => array(),
        'datasets' => array(
            array(
                'label' => "Suhu Air",
                'data' => array(),
                'fill' => false,
                'borderColor' => "red",
                'borderWidth' => 2,
                'tension' => 0.1
            )
        )
    );
    $dataSuhuAir['datasets'][] = array(
        'label' => "PDAM Kubu Raya",
        'data' => array(),
        'fill' => false,
        'borderColor' => "blue",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataSuhuAir['datasets'][] = array(
        'label' => "Kota Bandung",
        'data' => array(),
        'fill' => false,
        'borderColor' => "grey",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataSuhuAir['datasets'][] = array(
        'label' => "Tanray",
        'data' => array(),
        'fill' => false,
        'borderColor' => "green",
        'borderWidth' => 2,
        'tension' => 0.1
    );

    $dataKekeruhanAir = array(
        'labels' => array(),
        'datasets' => array(
            array(
                'label' => "Kekeruhan Air",
                'data' => array(),
                'fill' => false,
                'borderColor' => "red",
                'borderWidth' => 2,
                'tension' => 0.1
            )
        )
    );
    $dataKekeruhanAir['datasets'][] = array(
        'label' => "PDAM Kubu Raya",
        'data' => array(),
        'fill' => false,
        'borderColor' => "blue",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataKekeruhanAir['datasets'][] = array(
        'label' => "Kota Bandung",
        'data' => array(),
        'fill' => false,
        'borderColor' => "grey",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataKekeruhanAir['datasets'][] = array(
        'label' => "Tanray",
        'data' => array(),
        'fill' => false,
        'borderColor' => "green",
        'borderWidth' => 2,
        'tension' => 0.1
    );

    $dataSuhuLingkungan = array(
        'labels' => array(),
        'datasets' => array(
            array(
                'label' => "Suhu Lingkungan",
                'data' => array(),
                'fill' => false,
                'borderColor' => "red",
                'borderWidth' => 2,
                'tension' => 0.1
            )
        )
    );
    $dataSuhuLingkungan['datasets'][] = array(
        'label' => "PDAM Kubu Raya",
        'data' => array(),
        'fill' => false,
        'borderColor' => "blue",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataSuhuLingkungan['datasets'][] = array(
        'label' => "Kota Bandung",
        'data' => array(),
        'fill' => false,
        'borderColor' => "grey",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataSuhuLingkungan['datasets'][] = array(
        'label' => "Tanray",
        'data' => array(),
        'fill' => false,
        'borderColor' => "green",
        'borderWidth' => 2,
        'tension' => 0.1
    );

    $dataKekeruhanAir = array(
        'labels' => array(),
        'datasets' => array(
            array(
                'label' => "Kekeruhan Air",
                'data' => array(),
                'fill' => false,
                'borderColor' => "red",
                'borderWidth' => 2,
                'tension' => 0.1
            )
        )
    );
    $dataKekeruhanAir['datasets'][] = array(
        'label' => "PDAM Kubu Raya",
        'data' => array(),
        'fill' => false,
        'borderColor' => "blue",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataKekeruhanAir['datasets'][] = array(
        'label' => "Kota Bandung",
        'data' => array(),
        'fill' => false,
        'borderColor' => "grey",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataKekeruhanAir['datasets'][] = array(
        'label' => "Tanray",
        'data' => array(),
        'fill' => false,
        'borderColor' => "green",
        'borderWidth' => 2,
        'tension' => 0.1
    );

    $dataKelembabanLingkungan = array(
        'labels' => array(),
        'datasets' => array(
            array(
                'label' => "Kelembaban Lingkungan",
                'data' => array(),
                'fill' => false,
                'borderColor' => "red",
                'borderWidth' => 2,
                'tension' => 0.1
            )
        )
    );
    $dataKelembabanLingkungan['datasets'][] = array(
        'label' => "PDAM Kubu Raya",
        'data' => array(),
        'fill' => false,
        'borderColor' => "blue",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataKelembabanLingkungan['datasets'][] = array(
        'label' => "Kota Bandung",
        'data' => array(),
        'fill' => false,
        'borderColor' => "grey",
        'borderWidth' => 2,
        'tension' => 0.1
    );
    $dataKelembabanLingkungan['datasets'][] = array(
        'label' => "Tanray",
        'data' => array(),
        'fill' => false,
        'borderColor' => "green",
        'borderWidth' => 2,
        'tension' => 0.1
    );

    while ($row1 = $result1->fetch_assoc()) {
        // $dataPhAir['labels'][] = $row['created_at'] = date("H:i:s");
        $dataPhAir['labels'][] = $row1['created_at'];
        $dataPhAir['datasets'][0]['data'][] = $row1['ph_air'];

        $dataSuhuAir['labels'][] = $row1['created_at'];
        $dataSuhuAir['datasets'][0]['data'][] = $row1['suhu_air'];

        $dataKekeruhanAir['labels'][] = $row1['created_at'];
        $dataKekeruhanAir['datasets'][0]['data'][] = $row1['kekeruhan'];

        $dataSuhuLingkungan['labels'][] = $row1['created_at'];
        $dataSuhuLingkungan['datasets'][0]['data'][] = $row1['suhu_lingkungan'];

        $dataKelembabanLingkungan['labels'][] = $row1['created_at'];
        $dataKelembabanLingkungan['datasets'][0]['data'][] = $row1['kelembaban_lingkungan'];
    }
    while ($row2 = $result2->fetch_assoc()) {
        $dataPhAir['labels'][] = $row2['created_at'];
        $dataPhAir['datasets'][1]['data'][] = $row2['ph_air'];

        $dataSuhuAir['labels'][] = $row2['created_at'];
        $dataSuhuAir['datasets'][1]['data'][] = $row2['suhu_air'];

        $dataKekeruhanAir['labels'][] = $row2['created_at'];
        $dataKekeruhanAir['datasets'][1]['data'][] = $row2['kekeruhan'];

        $dataSuhuLingkungan['labels'][] = $row2['created_at'];
        $dataSuhuLingkungan['datasets'][1]['data'][] = $row2['suhu_lingkungan'];

        $dataKelembabanLingkungan['labels'][] = $row2['created_at'];
        $dataKelembabanLingkungan['datasets'][1]['data'][] = $row2['kelembaban_lingkungan'];
    }
    while ($row3 = $result3->fetch_assoc()) {
        $dataPhAir['labels'][] = $row3['created_at'];
        $dataPhAir['datasets'][2]['data'][] = $row3['ph_air'];

        $dataSuhuAir['labels'][] = $row3['created_at'];
        $dataSuhuAir['datasets'][2]['data'][] = $row3['suhu_air'];

        $dataKekeruhanAir['labels'][] = $row3['created_at'];
        $dataKekeruhanAir['datasets'][2]['data'][] = $row3['kekeruhan'];

        $dataSuhuLingkungan['labels'][] = $row3['created_at'];
        $dataSuhuLingkungan['datasets'][2]['data'][] = $row3['suhu_lingkungan'];

        $dataKelembabanLingkungan['labels'][] = $row3['created_at'];
        $dataKelembabanLingkungan['datasets'][2]['data'][] = $row3['kelembaban_lingkungan'];
    }
    while ($row4 = $result4->fetch_assoc()) {
        $dataPhAir['labels'][] = $row4['created_at'];
        $dataPhAir['datasets'][3]['data'][] = $row4['ph_air'];

        $dataSuhuAir['labels'][] = $row4['created_at'];
        $dataSuhuAir['datasets'][3]['data'][] = $row4['suhu_air'];

        $dataKekeruhanAir['labels'][] = $row4['created_at'];
        $dataKekeruhanAir['datasets'][3]['data'][] = $row4['kekeruhan'];

        $dataSuhuLingkungan['labels'][] = $row4['created_at'];
        $dataSuhuLingkungan['datasets'][3]['data'][] = $row4['suhu_lingkungan'];

        $dataKelembabanLingkungan['labels'][] = $row4['created_at'];
        $dataKelembabanLingkungan['datasets'][3]['data'][] = $row4['kelembaban_lingkungan'];
    }

    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
    $stmt4->close();
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