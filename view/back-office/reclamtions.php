<?php

include('../../controller/ReclamationC.php');
include('../../controller/ReponseC.php');

$ReclamtionC = new ReclamationC();
$ReponseC = new ReponseC();
$ReponseC->delete();
$Reclamtions = $ReclamtionC->read(); // Fetch all Reclamtions
$ReclamationC = new ReclamationC();
$statut = isset($_GET['statut']) ? $_GET['statut'] : '';
$reclamations = $ReclamationC->findByStatut($statut);
$reclamationC = new ReclamationC();
$statistiques = $reclamationC->getStatistiquesParStatut();





$reclamationsEnAttente = $ReclamtionC->findByStatut('en attente');
$nombreEnAttente = count($reclamationsEnAttente);

?>



<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                href="reclamtions.php">
                <i class="fas fa-home"></i>
                <p>Gerer Reclamation</p>
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
        <h1 class="mt-5">Gerer les reclamations</h1>
            <br><br>
            
            <div class="mt-5">
              <div class="row">
                <div class="col-6">
                  
                </div>
              </div>
            </div>
            <table class="table mt-5">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Objet</th>
                  <th scope="col">Date</th>
                  <th scope="col">Statut</th>
                  <th scope="col">Réponse</th>
                  <th scope="col">Option</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($Reclamtions as $rec) { ?>
                  <tr>
                    <th scope="row"><?= $rec['id_reclamation'] ?></th>
                    <td><?= htmlspecialchars($rec['objet']) ?></td>
                    <td><?= $rec['date_creation'] ?></td>
                    <td><?= $rec['statut'] ?></td>
                    <td>
                      <?= !empty($rec['reponse_message']) ? htmlspecialchars($rec['reponse_message']) : '<span class="text-muted">Aucune</span>' ?>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="updateRecAdmin.php?id=<?= $rec['id_reclamation'] ?>">Modifier statut</a>
                      <?php if ($rec['statut'] != 'Résolue') { ?>
                        <a class="btn btn-sm btn-success" href="respondRec.php?id=<?= $rec['id_reclamation'] ?>">Répondre</a>
                      <?php } ?>
                      <?php if ($rec['statut'] == 'Résolue') { ?>
                        <a class="btn btn-sm btn-success" href="respondRec.php?id=<?= $rec['id_reclamation'] ?>">Modifier reponse</a>
                        <a class="btn btn-sm btn-danger" href="?delete=<?= $rec['id_reclamation'] ?>">Supprimer reponse</a>

                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>

          

<?php

$reclamationC = new ReclamationC();

if (isset($_GET['statut']) && !empty($_GET['statut'])) {
    $Reclamtions = $reclamationC->findByStatut($_GET['statut']);
} else {
    $Reclamtions = $reclamationC->read();
}
?>

<!-- Barre de recherche par statut -->
<form method="GET" class="mt-3">
  <div class="row">
    <div class="col-4">
      <select name="statut" class="form-control">
        <option value=""> tous </option>
        <option value="En cours" <?= (isset($_GET['statut']) && $_GET['statut'] == 'En cours') ? 'selected' : '' ?>>En cours</option>
        <option value="En attente" <?= (isset($_GET['statut']) && $_GET['statut'] == 'En attente') ? 'selected' : '' ?>>En attente</option>
        <option value="Résolue" <?= (isset($_GET['statut']) && $_GET['statut'] == 'Résolue') ? 'selected' : '' ?>>Résolue</option>
      </select>
    </div>
    <div class="col-2">
      <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
  </div>
</form>



<!-- Tableau des réclamations -->
<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Objet</th>
      <th scope="col">Date</th>
      <th scope="col">Statut</th>
      <th scope="col">Réponse</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Reclamtions as $rec) { ?>
      <tr>
        <th scope="row"><?= $rec['id_reclamation'] ?></th>
        <td><?= htmlspecialchars($rec['objet']) ?></td>
        <td><?= $rec['date_creation'] ?></td>
        <td><?= $rec['statut'] ?></td>
        <td>
          <?= !empty($rec['reponse_message']) ? htmlspecialchars($rec['reponse_message']) : '<span class="text-muted">Aucune</span>' ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>




<?php

$reclamationC = new ReclamationC();

$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'ASC';
$Reclamtions = $reclamationC->readSortedByDate($order);
?>

<form method="GET" class="mt-3">
  <div class="row">
    <div class="col-4">
      <select name="order" class="form-control">
        <option value="">Trier par date</option>
        <option value="ASC" <?= (isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'selected' : '' ?>>Date croissante</option>
        <option value="DESC" <?= (isset($_GET['order']) && $_GET['order'] == 'DESC') ? 'selected' : '' ?>>Date décroissante</option>
      </select>
    </div>
    <div class="col-2">
      <button type="submit" class="btn btn-info">Trier</button>
    </div>
  </div>
</form>

<?php if (!empty($Reclamtions)) { ?>
  <table class="table mt-5">
    <thead>
      <tr>
        <th>#</th>
        <th>Objet</th>
        <th>Date</th>
        <th>Statut</th>
        <th>Réponse</th>
      
      </tr>
    </thead>
    <tbody>
      <?php foreach ($Reclamtions as $rec) { ?>
        <tr>
          <td><?= $rec['id_reclamation'] ?></td>
          <td><?= htmlspecialchars($rec['objet']) ?></td>
          <td><?= $rec['date_creation'] ?></td>
          <td><?= $rec['statut'] ?></td>
          <td><?= !empty($rec['reponse_message']) ? htmlspecialchars($rec['reponse_message']) : 'Aucune' ?></td>
          <td><!-- Actions ici --></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } else { ?>
  <p class="mt-4 text-muted">Aucune réclamation trouvée.</p>
<?php } ?>


<h3 class="mt-5">Répartition des réclamations par statut</h3>
<canvas id="statutPieChart" style="max-width: 350px; max-height: 350px;"></canvas>


<script>
  const ctx = document.getElementById('statutPieChart').getContext('2d');

  const data = {
    labels: <?= json_encode(array_column($statistiques, 'statut')) ?>,
    datasets: [{
      label: 'Réclamations',
      data: <?= json_encode(array_column($statistiques, 'total')) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'pie',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          
        }
      }
    },
  };

  new Chart(ctx, config);
</script>



<?php if ($nombreEnAttente > 0): ?>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const toast = document.createElement('div');
      toast.style.position = 'fixed';
      toast.style.bottom = '20px';
      toast.style.right = '20px';
      toast.style.backgroundColor = '#fff3cd';
      toast.style.color = '#856404';
      toast.style.padding = '15px 20px';
      toast.style.borderRadius = '8px';
      toast.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.2)';
      toast.style.borderLeft = '6px solid #ffc107';
      toast.style.fontFamily = 'Arial, sans-serif';
      toast.style.zIndex = '9999';
      toast.style.minWidth = '300px';
      toast.style.transition = 'opacity 0.4s ease';
      toast.style.opacity = '0';

      toast.innerHTML = `
        <strong>Réclamations en attente</strong><br>
        Vous avez <strong><?= $nombreEnAttente ?></strong> réclamation(s) à traiter.
        <span style="float: right; cursor: pointer;" onclick="this.parentElement.remove()">&times;</span>
      `;

      document.body.appendChild(toast);
      setTimeout(() => toast.style.opacity = '1', 100);

      // Auto-disparition après 5 secondes
      setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 1000);
      }, 5000);
    });
  </script>
<?php endif; ?>




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