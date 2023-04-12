<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Grafik</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/dashboard.css" />
    <link rel="shortcut icon" href="public/image/untan.png" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!--Main Navigation-->
<header>
    <!-- <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
          <div class="list-group list-group-flush mx-3 mt-4">
              <a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                  <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                  <span>Dashboard</span>
              </a>
              <a href="#" class="list-group-item list-group-item-action py-2 ripple active">
                  <i class="fas fa-chart-area fa-fw me-3"></i>
                  <span>Grafik</span>
              </a>
              <a href="#"class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-users fa-fw me-3"></i>
                  <span>Users</span>
              </a>
          </div>
      </div>
    </nav> -->

  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
        data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <div class="logo">
        <span><img src="public/image/untan.png" width="30px"><b> Metopen App</b></span>
      </div>

      <ul class="navbar-nav ms-auto d-flex flex-row">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" id="navbarDropdownMenuLink"
              role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
              <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22" alt="" loading="lazy"/>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" >
              <li><a class="dropdown-item" href="#">My profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px">
<div class="row mb-6">
  <div class="col-md-6">
    <div class="container pt-4">
      <section class="mb-4">
        <div class="card">
          <div class="card-header py-3 bg-danger">
            <h5 class="mb-0 text-center"><strong class="text-white">Grafik Temperatur</strong></h5>
          </div>
          <div class="card-body">
            <canvas class="my-4 w-100" id="myChart" height="380"></canvas>
          </div>
        </div>
      </section>
    </div>
  </div>
  <div class="col-md-6">
    <div class="container pt-4">
      <section class="mb-4">
        <div class="card">
          <div class="card-header py-3 bg-primary">
            <h5 class="mb-0 text-center"><strong class="text-white">Grafik Kelembaban</strong></h5>
          </div>
          <div class="card-body">
            <canvas class="my-4 w-100" id="myChart2" height="380"></canvas>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<div class="row mb-6">
  <div class="col-md-6">
    <div class="container pt-4">
      <section class="mb-4">
        <div class="card">
          <div class="card-header py-3 bg-warning">
            <h5 class="mb-0 text-center"><strong class="text-white">Grafik Kekeruhan</strong></h5>
          </div>
          <div class="card-body">
            <canvas class="my-4 w-100" id="myChart3" height="380"></canvas>
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
            <h5 class="mb-0 text-center"><strong class="text-white">Grafik Ph Air</strong></h5>
          </div>
          <div class="card-body">
            <canvas class="my-4 w-100" id="myChart4" height="380"></canvas>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
</main>
<!--Main layout-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="public/js/bootstrap.bundle.min.js"></script>
<script src="public/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>