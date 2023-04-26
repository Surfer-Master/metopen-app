<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/sidebars.css" />
    <link rel="shortcut icon" href="public/image/untan.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <main class="d-flex flex-nowrap">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-secondary" style="width: 280px;">
            <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <span class="fs-4 fw-bold"><img src="public/image/untan.png" width="30px" class="me-2">Metopen App</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <!-- <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg> -->
                        Home
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-body-emphasis">
                        <!-- <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2" />
                        </svg> -->
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-body-emphasis">
                        <!-- <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#table" />
                        </svg> -->
                        NIC
                    </a>
                </li>

            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2"> -->

                    <i class="bi bi-person-circle fs-3 me-2"></i>

                    <strong>Admin</strong>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="logout.php" method="POST">
                            <button type="submit" class="dropdown-item" name="logout">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <?php
        require 'conn.php';
        $query = "SELECT * FROM data";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $dataPhAir = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => "PH Air",
                    'data' => array(),
                    'fill' => false,
                    'borderColor' => "red",
                    'borderWidth' => 2,
                    'tension' => 0.1
                )
            )
        );
        $dataSuhuAir = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => "Suhu Air",
                    'data' => array(),
                    'fill' => false,
                    'borderColor' => "darkgreen",
                    'borderWidth' => 2,
                    'tension' => 0.1
                )
            )
        );
        $dataKekeruhanAir = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => "Kekeruhan Air",
                    'data' => array(),
                    'fill' => false,
                    'borderColor' => "grey",
                    'borderWidth' => 2,
                    'tension' => 0.1
                )
            )
        );
        $dataSuhuLingkungan = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => "Suhu Lingkungan",
                    'data' => array(),
                    'fill' => false,
                    'borderColor' => "blue",
                    'borderWidth' => 2,
                    'tension' => 0.1
                )
            )
        );
        $dataKelembabanLingkungan = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => "Kelembaban Lingkungan",
                    'data' => array(),
                    'fill' => false,
                    'borderColor' => "yellow",
                    'borderWidth' => 2,
                    'tension' => 0.1
                )
            )
        );

        while ($row = $result->fetch_assoc()) {
            $dataPhAir['labels'][] = $row['created_at'];
            $dataPhAir['datasets'][0]['data'][] = $row['ph_air'];

            $dataSuhuAir['labels'][] = $row['created_at'];
            $dataSuhuAir['datasets'][0]['data'][] = $row['suhu_air'];

            $dataKekeruhanAir['labels'][] = $row['created_at'];
            $dataKekeruhanAir['datasets'][0]['data'][] = $row['kekeruhan'];

            $dataSuhuLingkungan['labels'][] = $row['created_at'];
            $dataSuhuLingkungan['datasets'][0]['data'][] = $row['suhu_lingkungan'];

            $dataKelembabanLingkungan['labels'][] = $row['created_at'];
            $dataKelembabanLingkungan['datasets'][0]['data'][] = $row['kelembaban_lingkungan'];
        }

        $stmt->close();
        $mysqli->close();

        ?>




        <div class="container scrollarea">
            <div class="row mb-6 justify-content-around">
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

    </main>

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
    <script src="public/js/script.js"></script>
</body>

</html>