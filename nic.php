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
    <title>Home | NIC</title>
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
                    <a href="/Project/metopen-app/" class="nav-link link-body-emphasis">
                        <!-- <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg> -->
                        Home
                    </a>
                </li>
                <li>
                    <a href="" class="nav-link active">
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
        $query = "SELECT * FROM nic";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $dataDelay = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => "Delay",
                    'data' => array(),
                    'fill' => false,
                    'borderColor' => "red",
                    'borderWidth' => 2,
                    'tension' => 0.1
                )
            )
        );

        while ($row = $result->fetch_assoc()) {
            $dataDelay['labels'][] = $row['id'];
            $dataDelay['datasets'][0]['data'][] = $row['delay_time'];
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
                                    <h5 class="mb-0 text-center"><strong class="text-white">Grafik Delay</strong></h5>
                                </div>
                                <div class="card-body">
                                    <canvas class="my-4 w-100" id="chartDelay" height="380"></canvas>
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

        let dataDelay = <?= json_encode($dataDelay) ?>;
        let ctxDelay = document.getElementById("chartDelay").getContext("2d");
        let chartDelay = new Chart(ctxDelay, {
            type: 'line',
            data: dataDelay,
            options: options
        });
    </script>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/sidebars.js"></script>
    <script src="public/js/script.js"></script>
</body>

</html>