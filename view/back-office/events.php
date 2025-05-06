<?php

include('../../controller/evenementC.php');

$eventC = new EvenementC();
if (isset($_GET['search'])) {
  $eventC = new EvenementC();
  $events = $eventC->search($_GET['search']);
} else if (isset($_GET['sort'])) {
  $eventC = new EvenementC();
  $events = $eventC->sort($_GET['sort']);
} else {
  $eventC = new EvenementC();
  $events = $eventC->read();
}
$eventC->delete(); // Handle deletion
$tevents= $eventC->getTop3Evenements();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Click&Go</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />
  <link
    rel="icon"
    href="assets/img/kaiadmin/logo_light.svg"
    type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">

          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item active">
              <a
                data-bs-toggle="collapse"
                href="#dashboard"
                class="collapsed"
                aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
                <span class="caret"></span>
              </a>

            </li>
            <li class="nav-item active">
              <a
                href="events.php">
                <i class="fas fa-home"></i>
                <p>Gerer evenments</p>
              </a>

            </li>
            <li class="nav-item active">
              <a
                href="reservations.php">
                <i class="fas fa-home"></i>
                <p>Gerer reservation</p>
              </a>

            </li>


          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
                src="assets/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="40" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav
          class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <nav
              class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input
                  type="text"
                  placeholder="Search ..."
                  class="form-control" />
              </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li
                class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  href="#"
                  role="button"
                  aria-expanded="false"
                  aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input
                        type="text"
                        placeholder="Search ..."
                        class="form-control" />
                    </div>
                  </form>
                </ul>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="messageDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  <i class="fa fa-envelope"></i>
                </a>
                <ul
                  class="dropdown-menu messages-notif-box animated fadeIn"
                  aria-labelledby="messageDropdown">
                  <li>
                    <div
                      class="dropdown-title d-flex justify-content-between align-items-center">
                      Messages
                      <a href="#" class="small">Mark all as read</a>
                    </div>
                  </li>
                  <li>

                  </li>
                  <li>
                    <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="notifDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  <i class="fa fa-bell"></i>
                  <span class="notification">4</span>
                </a>
                <ul
                  class="dropdown-menu notif-box animated fadeIn"
                  aria-labelledby="notifDropdown">




              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="row">
            <br>
            <h1 class="mt-5">Gerer les evenements</h1>
            <br><br>
            <div class="mt-5">
              <div class="row">
                <div class="col-6">
                  <a class="btn btn-primary" href="addevent.php">ajouter evenement</a>
                </div>
                <div class="col-6">
                  <form action="?search" method="get">
                    <input type="text" class=" form-control" placeholder="Chercher .. " name="search">
                  </form>
                </div>
              </div>
            </div>
            <table class="table mt-5">
              <thead>
                <tr>
                  <th scope="col"><a href="?sort=id">#</a></th>
                  <th scope="col"><a href="?sort=nom">Nom</a></th>
                  <th scope="col">Organisateur</th>
                  <th scope="col">Description</th>
                  <th scope="col">Type</th>
                  <th scope="col"><a href="?sort=date">Date</a></th>
                  <th scope="col"><a href="?sort=place">Lieu</a></th>
                  <th scope="col">Option</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($events as $e) { ?>
                  <tr>
                    <th scope="row"><?= $e['id'] ?></th>
                    <td><?= $e['nom'] ?></td>
                    <td><?= $e['organisateur'] ?></td>
                    <td><?= $e['description'] ?></td>
                    <td><?= $e['type'] ?></td>
                    <td><?= $e['date'] ?></td>
                    <td><?= $e['place'] ?></td>
                    <td>
                      <a href="?delete=<?= $e['id'] ?>">supprimer</a> ||
                      <a href="updateevent.php?update=<?= $e['id'] ?>">modifier</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <h2>Top 3 des Événements les Plus Réservés</h2>
              <table>
                  <thead>
                      <tr>
                          <th>Nom</th>
                          <th>Organisateur</th>
                          <th>Date</th>
                          <th>Lieu</th>
                          <th>Nombre de Réservations</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      foreach ($tevents as $event) {
                          echo "<tr>";
                          echo "<td>" . htmlspecialchars($event['nom']) . "</td>";
                          echo "<td>" . htmlspecialchars($event['organisateur']) . "</td>";
                          echo "<td>" . htmlspecialchars($event['date']) . "</td>";
                          echo "<td>" . htmlspecialchars($event['place']) . "</td>";
                          echo "<td>" . $event['nombre_reservations'] . "</td>";
                          echo "</tr>";
                      }
                      ?>
                  </tbody>
              </table>

          </div>
        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="http://www.themekita.com">
                  ThemeKita
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Help </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Licenses </a>
              </li>
            </ul>
          </nav>
          <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="http://www.themekita.com">ThemeKita</a>
          </div>
          <div>
            Distributed by
            <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
          </div>
        </div>
      </footer>
    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
      <div class="title">Settings</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Header</h4>
            <div class="btnSwitch">
              <button
                type="button"
                class="selected changeLogoHeaderColor"
                data-color="dark"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="blue"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="purple"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="light-blue"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="green"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="orange"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="red"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="white"></button>
              <br />
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="dark2"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="blue2"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="purple2"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="light-blue2"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="green2"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="orange2"></button>
              <button
                type="button"
                class="changeLogoHeaderColor"
                data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Navbar Header</h4>
            <div class="btnSwitch">
              <button
                type="button"
                class="changeTopBarColor"
                data-color="dark"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="blue"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="purple"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="light-blue"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="green"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="orange"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="red"></button>
              <button
                type="button"
                class="selected changeTopBarColor"
                data-color="white"></button>
              <br />
              <button
                type="button"
                class="changeTopBarColor"
                data-color="dark2"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="blue2"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="purple2"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="light-blue2"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="green2"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="orange2"></button>
              <button
                type="button"
                class="changeTopBarColor"
                data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Sidebar</h4>
            <div class="btnSwitch">
              <button
                type="button"
                class="changeSideBarColor"
                data-color="white"></button>
              <button
                type="button"
                class="selected changeSideBarColor"
                data-color="dark"></button>
              <button
                type="button"
                class="changeSideBarColor"
                data-color="dark2"></button>
            </div>
          </div>
        </div>
      </div>
      <div class="custom-toggle">
        <i class="icon-settings"></i>
      </div>
    </div>
    <!-- End Custom template -->
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo.js"></script>
  <script src="assets/js/demo.js"></script>
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
</body>

</html>