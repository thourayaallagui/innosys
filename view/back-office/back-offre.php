<?php

require_once __DIR__ . '/../../controller/OffreController.php';

require_once __DIR__ . '/../../controller/SponsorController.php';

$offreController = new OffreController();
$sponsorController = new SponsorController();


// Actions de création, mise à jour et suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'create') {
            $offreController->createOffre();
        } elseif ($_POST['action'] === 'update') {
            $offreController->updateOffre();
        } elseif ($_POST['action'] === 'delete') {
            $offreController->deleteOffre();
        }
    }
}

// Récupération des offres
$offres = $offreController->index();
$sponsors = $sponsorController->index();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
        <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
        <style> 
  table thead.custom-blue {
            background-color: #007bff !important; /* Fond bleu */
            color: blue !important; /* Texte blanc */
        }

        /* Applique un fond bleu et texte blanc spécifiquement sur chaque cellule th */
        table thead.custom-blue th {
            color: blue !important; /* Texte en blanc */
        }
         </style>
    <!-- CSS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JS de Bootstrap (tardif, avant la fermeture de body) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
        <div class="wrapper sidebar_minimize">
       <!-- Sidebar -->
       <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                    <img src="assets/img/logo.png"
     alt="navbar brand"
     class="navbar-brand"
     height="100" />

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
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="dashboard">
                                <ul class="nav nav-collapse">
                                    <li href="#">

                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                            <h4 class="text-section">Components</h4>
                        </li>
                        <li class="nav-item active">
                            <a href="back-offre.php">
                                <i class="fas fa-layer-group"></i>
                                <p>Offres</p>
                                <span class="caret"></span>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a  href="back-sponsor.php">
                                <i class="fas fa-th-list"></i>
                                <p>Sponsors</p>
                                <span class="caret"></span>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#forms">
                                <i class="fas fa-pen-square"></i>
                                <p>Forms</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="forms">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="forms/forms.html">
                                            <span class="sub-item">Basic Form</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#tables">
                                <i class="fas fa-table"></i>
                                <p>-</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="tables">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="tables/tables.html">
                                            <span class="sub-item">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tables/datatables.html">
                                            <span class="sub-item">-</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#charts">
                                <i class="far fa-chart-bar"></i>
                                <p>Charts</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="charts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="charts/charts.html">
                                            <span class="sub-item">Chart Js</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="charts/sparkline.html">
                                            <span class="sub-item">Sparkline</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
                                <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
                    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                        <div class="container-fluid">
                            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                                    </div>
                                    <input type="text" placeholder="Search ..." class="form-control" />
                                </div>
                            </nav>

                            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                                        <form class="navbar-left navbar-form nav-search">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search ..." class="form-control" />
                                            </div>
                                        </form>
                                    </ul>
                                </li>
                                <li class="nav-item topbar-icon dropdown hidden-caret">
                                    <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                                        <li>
                                            <div class="dropdown-title d-flex justify-content-between align-items-center">
                                                Messages
                                                <a href="#" class="small">Mark all as read</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="message-notif-scroll scrollbar-outer">
                                                <div class="notif-center">
                                                    <a href="#">
                                                        <div class="notif-img">
                                                            <img src="assets/img/jm_denis.jpg" alt="Img Profile" />
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="subject">Jimmy Denis</span>
                                                            <span class="block"> How are you ? </span>
                                                            <span class="time">5 minutes ago</span>
                                                        </div>
                                                    </a>
                                                    <a href="#">
                                                        <div class="notif-img">
                                                            <img src="assets/img/chadengle.jpg" alt="Img Profile" />
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="subject">Chad</span>
                                                            <span class="block"> Ok, Thanks ! </span>
                                                            <span class="time">12 minutes ago</span>
                                                        </div>
                                                    </a>
                                                    <a href="#">
                                                        <div class="notif-img">
                                                            <img src="assets/img/mlane.jpg" alt="Img Profile" />
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="subject">Jhon Doe</span>
                                                            <span class="block">
                                Ready for the meeting today...
                              </span>
                                                            <span class="time">12 minutes ago</span>
                                                        </div>
                                                    </a>
                                                    <a href="#">
                                                        <div class="notif-img">
                                                            <img src="assets/img/talha.jpg" alt="Img Profile" />
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="subject">Talha</span>
                                                            <span class="block"> Hi, Apa Kabar ? </span>
                                                            <span class="time">17 minutes ago</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                      </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item topbar-icon dropdown hidden-caret">
                                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bell"></i>
                                        <span class="notification">4</span>
                                    </a>
                                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                        <li>
                                            <div class="dropdown-title">
                                                You have 4 new notification
                                            </div>
                                        </li>
                                        <li>
                                            <div class="notif-scroll scrollbar-outer">
                                                <div class="notif-center">
                                                    <a href="#">
                                                        <div class="notif-icon notif-primary">
                                                            <i class="fa fa-user-plus"></i>
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="block"> New user registered </span>
                                                            <span class="time">5 minutes ago</span>
                                                        </div>
                                                    </a>
                                                    <a href="#">
                                                        <div class="notif-icon notif-success">
                                                            <i class="fa fa-comment"></i>
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="block">
                                Rahmad commented on Admin
                              </span>
                                                            <span class="time">12 minutes ago</span>
                                                        </div>
                                                    </a>
                                                    <a href="#">
                                                        <div class="notif-img">
                                                            <img src="assets/img/profile2.jpg" alt="Img Profile" />
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="block">
                                Reza send messages to you
                              </span>
                                                            <span class="time">12 minutes ago</span>
                                                        </div>
                                                    </a>
                                                    <a href="#">
                                                        <div class="notif-icon notif-danger">
                                                            <i class="fa fa-heart"></i>
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="block"> Farrah liked Admin </span>
                                                            <span class="time">17 minutes ago</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i>
                      </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item topbar-icon dropdown hidden-caret">
                                    <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                        <i class="fas fa-layer-group"></i>
                                    </a>
                                    <div class="dropdown-menu quick-actions animated fadeIn">
                                        <div class="quick-actions-header">
                                            <span class="title mb-1">Quick Actions</span>
                                            <span class="subtitle op-7">Shortcuts</span>
                                        </div>

                                </li>

                                <li class="nav-item topbar-user dropdown hidden-caret">
                                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                        <div class="avatar-sm">
                                            <img src="assets/img/logo.png" alt="..." class="avatar-img rounded-circle" />
                                        </div>
                                        <span class="profile-username">
                      <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Admin</span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                                        <div class="dropdown-user-scroll scrollbar-outer">
                                            <li>
                                                <div class="user-box">
                                                    <div class="avatar-lg">
                                                        <img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                                                    </div>
                                                    <div class="u-text">
                                                        <h4>Hizrian</h4>
                                                        <p class="text-muted">hello@example.com</p>
                                                        <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                                                        <a class="dropdown-item" href="#">My Balance</a>
                                                        <a class="dropdown-item" href="#">Inbox</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Account Setting</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Logout</a>
                                            </li>
                                            </div>
                                    </ul>
                                </li>
                            </ul>
                            </div>
                    </nav>
                    <!-- End Navbar -->
                    </div>

                    <div class="container mt-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="fw-bold">Dashboard</h3>
                                
                            </div>

                        </div>
                        <!-- Ce bouton ne doit PAS être dans un formulaire -->
                        <button class="btn btn-primary" style="transform: translate(1260px, 30px);" data-bs-toggle="modal" data-bs-target="#addOffreModal">
                  Ajouter une Offre
              </button>


                        <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                        <?php endif; ?>

                        <h1 class="mb-3">Liste des Offres</h1>
                        <table class="table table-striped table-hover">
                        <thead class="custom-blue">
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Montant de réduction</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Conditions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($offres as $offre): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($offre['titre']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($offre['description']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($offre['montant_reduction']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($offre['date_debut']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($offre['date_fin']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($offre['conditions']) ?>
                                    </td>
                                    <td>    <!-- Modifier -->
                                    <button type="button"
        class="btn btn-warning btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#editOffreModal"
        data-id="<?= $offre['id_offre'] ?>"
        data-titre="<?= htmlspecialchars($offre['titre']) ?>"
        data-description="<?= htmlspecialchars($offre['description']) ?>"
        data-montant="<?= htmlspecialchars($offre['montant_reduction']) ?>"
        data-date-debut="<?= htmlspecialchars($offre['date_debut']) ?>"
        data-date-fin="<?= htmlspecialchars($offre['date_fin']) ?>"
        data-conditions="<?= htmlspecialchars($offre['conditions']) ?>"
        data-idspons="<?= htmlspecialchars($offre['id_spons']) ?>">
    Modifier
</button>
            <form method="post" action="back-offre.php" style="display:inline">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id_offre" value="<?= $offre['id_offre'] ?>">
              <button type="submit" class="btn btn-danger btn-sm"
                      onclick="return confirm('Confirmer la suppression ?');">
                Supprimer
              </button>
            </form>
          </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal d'ajout d'offre -->
                    <div class="modal fade" id="addOffreModal" tabindex="-1" aria-labelledby="addOffreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="back-offre.php" id="offreForm" novalidate>
                <input type="hidden" name="action" value="create">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOffreModalLabel">Ajouter une Offre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" name="titre" id="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="montant_reduction" class="form-label">Montant de réduction</label>
                        <input type="number" class="form-control" name="montant_reduction" id="montant_reduction" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date début</label>
                        <input type="date" class="form-control" name="date_debut" id="date_debut" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date fin</label>
                        <input type="date" class="form-control" name="date_fin" id="date_fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="conditions" class="form-label">Conditions</label>
                        <textarea class="form-control" name="conditions" id="conditions" required></textarea>
                    </div>
                    <div class="mb-3">
  <label for="id_spons" class="form-label">Sponsor</label>
  <select class="form-select" name="id_spons" id="id_spons" required>
    <option value="" disabled selected>— Sélectionnez un sponsor —</option>
    <?php foreach ($sponsors as $sponsor): ?>
      <option value="<?= htmlspecialchars($sponsor['id_sponsor']) ?>">
        <?= htmlspecialchars($sponsor['id_sponsor']) ?> 
      </option>
    <?php endforeach; ?>
  </select>
</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>


                    </div>
 <!-- Modal de modification d'une offre -->
<div class="modal fade" id="editOffreModal" tabindex="-1" aria-labelledby="editOffreModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editOffreForm" action="back-offre.php" method="POST" class="needs-validation" novalidate>
        <!-- Champs cachés -->
        <input type="hidden" name="action" value="update">
        <input type="hidden" id="editOffreId" name="id_offre" value="">

        <div class="modal-header">
          <h5 class="modal-title" id="editOffreModalLabel">Modifier l'Offre</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>

        <div class="modal-body">
          <!-- Titre -->
          <div class="mb-3">
            <label for="editTitre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="editTitre" name="titre" required>
            <div class="invalid-feedback" id="editTitreFeedback"></div>
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="editDescription" class="form-label">Description</label>
            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
            <div class="invalid-feedback" id="editDescriptionFeedback"></div>
          </div>

          <!-- Montant de réduction -->
          <div class="mb-3">
            <label for="editMontantReduction" class="form-label">Montant de réduction</label>
            <input type="number" class="form-control" id="editMontantReduction" name="montant_reduction" min="0" required>
            <div class="invalid-feedback" id="editMontantReductionFeedback"></div>
          </div>

          <!-- Dates -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editDateDebut" class="form-label">Date début</label>
              <input type="date" class="form-control" id="editDateDebut" name="date_debut" required>
              <div class="invalid-feedback" id="editDateDebutFeedback"></div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editDateFin" class="form-label">Date fin</label>
              <input type="date" class="form-control" id="editDateFin" name="date_fin" required>
              <div class="invalid-feedback" id="editDateFinFeedback"></div>
            </div>
          </div>

          <!-- Conditions -->
          <div class="mb-3">
            <label for="editConditions" class="form-label">Conditions</label>
            <textarea class="form-control" id="editConditions" name="conditions" rows="2" required></textarea>
            <div class="invalid-feedback" id="editConditionsFeedback"></div>
          </div>

          <!-- ID Sponsor (pas de feedback JS custom ici) -->
          <div class="mb-3">
            <label for="editIdSpons" class="form-label">ID Sponsor</label>
            <input type="number" class="form-control" id="editIdSpons" name="id_spons" min="1" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Sauvegarder</button>
        </div>
      </form>
    </div>
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

                    <!-- Custom template | don't include it in your project! -->
                    <div class="custom-template">
                        <div class="title">Settings</div>
                        <div class="custom-content">
                            <div class="switcher">
                                <div class="switch-block">
                                    <h4>Logo Header</h4>
                                    <div class="btnSwitch">
                                        <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                                        <br />
                                        <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                                        <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                                    </div>
                                </div>
                                <div class="switch-block">
                                    <h4>Navbar Header</h4>
                                    <div class="btnSwitch">
                                        <button type="button" class="changeTopBarColor" data-color="dark"></button>
                                        <button type="button" class="changeTopBarColor" data-color="blue"></button>
                                        <button type="button" class="changeTopBarColor" data-color="purple"></button>
                                        <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                                        <button type="button" class="changeTopBarColor" data-color="green"></button>
                                        <button type="button" class="changeTopBarColor" data-color="orange"></button>
                                        <button type="button" class="changeTopBarColor" data-color="red"></button>
                                        <button type="button" class="selected changeTopBarColor" data-color="white"></button>
                                        <br />
                                        <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                                        <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                                        <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                                        <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                                        <button type="button" class="changeTopBarColor" data-color="green2"></button>
                                        <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                                        <button type="button" class="changeTopBarColor" data-color="red2"></button>
                                    </div>
                                </div>
                                <div class="switch-block">
                                    <h4>Sidebar</h4>
                                    <div class="btnSwitch">
                                        <button type="button" class="changeSideBarColor" data-color="white"></button>
                                        <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                                        <button type="button" class="changeSideBarColor" data-color="dark2"></button>
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
                <script>document.addEventListener('DOMContentLoaded', function () {
    // Récupérer le formulaire
    const form = document.querySelector('#offreForm');
    
    // Ajouter un écouteur pour l'événement de soumission
    form.addEventListener('submit', function (event) {
        let valid = true;

        // Récupérer les champs du formulaire
        const titre = form.querySelector('input[name="titre"]');
        const description = form.querySelector('textarea[name="description"]');
        const montantReduction = form.querySelector('input[name="montant_reduction"]');
        const dateDebut = form.querySelector('input[name="date_debut"]');
        const dateFin = form.querySelector('input[name="date_fin"]');
        const conditions = form.querySelector('textarea[name="conditions"]');
        const idSponsor = form.querySelector('input[name="id_spons"]');
        
        // Réinitialiser les messages d'erreur
        resetErrors();

        // Validation des champs
        if (titre.value.trim() === '') {
            showError(titre, 'Le titre est requis.');
            valid = false;
        } else if (!/^[A-Za-z\s]+$/.test(titre.value.trim())) {  // Expression régulière pour vérifier les lettres et espaces
            showError(titre, 'Le titre ne peut contenir que des lettres et des espaces.');
            valid = false;
        }

        if (description.value.trim() === '') {
            showError(description, 'La description est requise.');
            valid = false;
        }
        if (montantReduction.value <= 0) {
            showError(montantReduction, 'Le montant de réduction doit être supérieur à zéro.');
            valid = false;
        }
        if (!dateDebut.value) {
            showError(dateDebut, 'La date de début est requise.');
            valid = false;
        } else {
            const today = new Date().toISOString().split('T')[0]; // Récupère la date d'aujourd'hui au format yyyy-mm-dd
            if (dateDebut.value < today) {
                showError(dateDebut, 'La date de début doit être supérieure ou égale à aujourd\'hui.');
                valid = false;
            }
        }
        if (!dateFin.value) {
            showError(dateFin, 'La date de fin est requise.');
            valid = false;
        } else if (new Date(dateFin.value) < new Date(dateDebut.value)) {
            showError(dateFin, 'La date de fin ne peut pas être antérieure à la date de début.');
            valid = false;
        }
        if (conditions.value.trim() === '') {
            showError(conditions, 'Les conditions sont requises.');
            valid = false;
        }
        if (idSponsor.value <= 0) {
            showError(idSponsor, 'L\'ID Sponsor doit être un nombre positif.');
            valid = false;
        }

        // Empêcher la soumission du formulaire si une erreur est détectée
        if (!valid) {
            event.preventDefault();
        }
    });

    // Fonction pour afficher un message d'erreur sous un champ
    function showError(element, message) {
        const errorMessage = document.createElement('div');
        errorMessage.classList.add('invalid-feedback');
        errorMessage.textContent = message;
        element.classList.add('is-invalid');
        element.parentElement.appendChild(errorMessage);
    }

    // Fonction pour réinitialiser les erreurs
    function resetErrors() {
        const formFields = form.querySelectorAll('.form-control');
        formFields.forEach(field => {
            field.classList.remove('is-invalid');
            const errorMessages = field.parentElement.querySelectorAll('.invalid-feedback');
            errorMessages.forEach(msg => msg.remove());
        });
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('editOffreModal')
  .addEventListener('show.bs.modal', function (event) {
    const btn   = event.relatedTarget;
    document.getElementById('editOffreId').value        = btn.getAttribute('data-id');
    document.getElementById('editTitre').value          = btn.getAttribute('data-titre');
    document.getElementById('editDescription').value    = btn.getAttribute('data-description');
    document.getElementById('editMontantReduction').value = btn.getAttribute('data-montant');
    document.getElementById('editDateDebut').value      = btn.getAttribute('data-date-debut');
    document.getElementById('editDateFin').value        = btn.getAttribute('data-date-fin');
    document.getElementById('editConditions').value     = btn.getAttribute('data-conditions');
    // **Nouveau** : on récupère aussi l'ID sponsor
    document.getElementById('editIdSpons').value       = btn.getAttribute('data-idspons');
});
</script>


<script>
(function(){
  const form = document.getElementById('editOffreForm');

  // Liste des champs à valider + message
  const checks = [
    { id: 'editTitre',            msg: 'Le titre doit contenir uniquement des lettres et espaces.' },
    { id: 'editDescription',      msg: 'La description est obligatoire.' },
    { id: 'editMontantReduction', msg: 'Le montant doit être un entier > 0.' },
    { id: 'editDateDebut',        msg: 'La date de début est obligatoire.' },
    { id: 'editDateFin',          msg: 'La date de fin doit être ≥ date de début.' },
    { id: 'editConditions',       msg: 'Les conditions sont obligatoires.' }
  ];

  form.addEventListener('submit', function(e){
    let valid = true;

    // Reset des erreurs
    checks.forEach(c => {
      const el = document.getElementById(c.id);
      const fb = document.getElementById(c.id + 'Feedback');
      el.classList.remove('is-invalid');
      fb.textContent = '';
    });

    // Contrôles basiques + spécifiques
    checks.forEach(c => {
      const el  = document.getElementById(c.id);
      const val = el.value.trim();

      if (c.id === 'editTitre') {
        // Regex lettres + espaces (lettres accentuées incluses)
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
        if (!regex.test(val)) {
          markInvalid(c.id, c.msg);
          valid = false;
        }
      }
      else if (c.id === 'editMontantReduction') {
        // Entier > 0
        const num = Number(val);
        if (!Number.isInteger(num) || num <= 0) {
          markInvalid(c.id, c.msg);
          valid = false;
        }
      }
      else {
        // Champ vide
        if (!val) {
          markInvalid(c.id, c.msg);
          valid = false;
        }
      }
    });

    // Contrôle cohérence des dates
    if (valid) {
      const d1 = document.getElementById('editDateDebut').value;
      const d2 = document.getElementById('editDateFin').value;
      if (d1 > d2) {
        markInvalid('editDateFin', 'La date de fin doit être postérieure ou égale à la date de début.');
        valid = false;
      }
    }

    if (!valid) {
      e.preventDefault();
      e.stopPropagation();
    }
  });

  // Retrait de l'erreur dès modification du champ
  checks.forEach(c => {
    document.getElementById(c.id).addEventListener('input', function(){
      this.classList.remove('is-invalid');
      document.getElementById(c.id + 'Feedback').textContent = '';
    });
  });

  function markInvalid(id, msg) {
    const el = document.getElementById(id);
    const fb = document.getElementById(id + 'Feedback');
    el.classList.add('is-invalid');
    fb.textContent = msg;
  }

  // Remplissage dynamique inchangé
  document.getElementById('editOffreModal')
    .addEventListener('show.bs.modal', function(event){
      const btn = event.relatedTarget;
      document.getElementById('editOffreId').value          = btn.getAttribute('data-id');
      document.getElementById('editTitre').value            = btn.getAttribute('data-titre');
      document.getElementById('editDescription').value      = btn.getAttribute('data-description');
      document.getElementById('editMontantReduction').value = btn.getAttribute('data-montant');
      document.getElementById('editDateDebut').value        = btn.getAttribute('data-date-debut');
      document.getElementById('editDateFin').value          = btn.getAttribute('data-date-fin');
      document.getElementById('editConditions').value       = btn.getAttribute('data-conditions');
      document.getElementById('editIdSpons').value          = btn.getAttribute('data-idspons');
    });
})();
</script>


    </body>

    </html>