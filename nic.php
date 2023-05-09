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
    <title>Dashboard | NIC</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/sidebars.css" />
    <link rel="shortcut icon" href="public/image/untan.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/2.0.1/chartjs-plugin-zoom.min.js" integrity="sha512-wUYbRPLV5zs6IqvWd88HIqZU/b8TBx+I8LEioQ/UC0t5EMCLApqhIAnUg7EsAzdbhhdgW07TqYDdH3QEXRcPOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-body-secondary" style="width: 280px;">
        <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4 fw-bold"><img src="public/image/untan.png" width="30px" class="me-2">Metopen App</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link link-body-emphasis">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="datatables.php" class="nav-link link-body-emphasis">
                    Data Grafik
                </a>
            </li>
            <li>
                <a href="nic.php" class="nav-link active">
                    NIC
                </a>
            </li>

        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-3 me-2"></i>

                <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li>
                    <form action="logout.php" method="POST">
                        <button type="submit" class="dropdown-item" name="logout">Log out</button>
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
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-3 pb-3 border-bottom bg">
                    <a href="" class="d-flex align-items-center me-md-auto text-dark text-decoration-none">
                        <span class="fs-6 text-muted me-2">Dashboard </span><span class="fs-4 text-muted"> - </span><span class="ms-2 fs-6 fw-bold"> NIC</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
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
</body>

</html>