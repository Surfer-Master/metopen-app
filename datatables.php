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
    <title>Dashboard | Data Grafik</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/sidebars.css" />
    <link rel="shortcut icon" href="public/image/untan.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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
                    <a href="index.php" class="nav-link link-body-emphasis">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="datatables.php" class="nav-link active">
                        Data Grafik
                    </a>
                </li>
                <li>
                    <a href="nic.php" class="nav-link link-body-emphasis">
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
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-3 pb-3 border-bottom bg">
                    <a href="" class="d-flex align-items-center me-md-auto text-dark text-decoration-none">
                        <span class="fs-6 text-muted me-2">Dashboard </span><span class="fs-4 text-muted"> - </span><span class="ms-2 fs-6 fw-bold"> Data Grafik</span>
                    </a>
                </div>
            </div>
            <div class="row m-2 mt-5">
                <div class="col-md-12 shadow-lg border border-0 rounded-4">
                    <div class="container p-3">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 mt-2">
                                            <select class="form-select form-select-sm bulan_harian">
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-2">
                                            <select class="form-select form-select-sm tahun_harian" id="years_pie_letter">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped" id="data_grafik_table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu</th>
                                        <th>PH Air</th>
                                        <th>Suhu Air</th>
                                        <th>Kekeruhan</th>
                                        <th>Lingkungan</th>
                                        <th>Kelembaban</th>
                                        <th>Asal Air</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include 'conn.php';
                                        $employee = mysqli_query($mysqli,"select * from data");
                                        $no = 1;
                                        while($row = mysqli_fetch_array($employee)){
                                            echo "<tr>
                                            <td>".$no."</td>
                                            <td>".$row['created_at'] = date("H:i:s")."</td>
                                            <td>".$row['ph_air']."</td>
                                            <td>".$row['suhu_air']."</td>
                                            <td>".$row['kekeruhan']."</td>
                                            <td>".$row['suhu_lingkungan']."</td>
                                            <td>".$row['kelembaban_lingkungan']."</td>
                                            <td>".$row['asal_air']."</td>
                                            <td>".$row['status']."</td>
                                            <td>
                                                <a class='text-decoration-none' href='grafik.php' data-id=".$row['id'].">
                                                    <i class='bi bi-journal-text me-2'></i>Detail                                                                                        
                                                </a>
                                                </td>
                                            </tr>";
                                            $no++;
                                        }
                                    ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/sidebars.js"></script>
    <script src="public/js/script.js"></script>
</body>

</html>