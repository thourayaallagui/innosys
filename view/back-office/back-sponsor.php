
<?php

require_once __DIR__ . '/../../controller/SponsorController.php';

$controller = new SponsorController();
$controller->createSponsor();
$controller->updateSponsor();
$controller->deleteSponsor();
$sponsors = $controller->index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Click&Go</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/kaiadmin/logo_light.svg" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
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
                        <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="100" />
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
                        <li class="nav-item">
                            <a href="back-offre.php">
                                <i class="fas fa-layer-group"></i>
                                <p>Offres</p>
                                <span class="caret"></span>
                            </a>

                        </li>
                        <li class="nav-item active submenu">
                            <a href="back-sponsor.php">
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
               

            <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Dashboard</h3>
            
        </div>
        <button class="btn btn-primary" style="transform: translate(-50px, 65px);" data-bs-toggle="modal" data-bs-target="#addSponsorModal">Ajouter un Sponsor</button>
    </div>

    <h4 class="mb-4">Liste des Sponsors</h4>
    <table class="table table-striped table-hover">
    <thead class="custom-blue">
            <tr>
                <th>Nom</th>
                <th>Montant</th>
                <th>Type</th>
                <th>Date</th>
                <th>Engagement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($sponsors as $s): ?>
        <tr>
            <td><?= htmlspecialchars($s['nom_entreprise']) ?></td>
            <td><?= htmlspecialchars($s['montant_sponsor']) ?> </td>
            <td><?= htmlspecialchars($s['type_sponsor']) ?></td>
            <td><?= htmlspecialchars($s['date_acceptation']) ?></td>
            <td><?= htmlspecialchars($s['engagement']) ?></td>
            <td>
                <div class="d-flex gap-2">
                    <!-- Modifier Button -->
                    <button class="btn btn-sm btn-warning edit-btn" 
                            data-id="<?= $s['id_sponsor'] ?>" 
                            data-nom="<?= htmlspecialchars($s['nom_entreprise']) ?>" 
                            data-montant="<?= htmlspecialchars($s['montant_sponsor']) ?>" 
                            data-type="<?= htmlspecialchars($s['type_sponsor']) ?>" 
                            data-date="<?= htmlspecialchars($s['date_acceptation']) ?>" 
                            data-engagement="<?= htmlspecialchars($s['engagement']) ?>">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                        </form>
                        <form method="POST" class="delete-form">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id_sponsor" value="<?= $s['id_sponsor'] ?>">
                            <button type="button" class="btn btn-sm btn-danger delete-button"><i class="fas fa-trash-alt"></i> Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>

<!-- Modal d'ajout de sponsor -->
<div class="modal fade" id="addSponsorModal" tabindex="-1" aria-labelledby="addSponsorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSponsorModalLabel">Ajouter un Sponsor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" novalidate id="sponsorForm">
    <div class="modal-body">
        <input type="hidden" name="action" value="create">
        <div class="mb-3">
            <label for="nom_entreprise">Nom Entreprise</label>
            <input type="text" id="nom_entreprise" class="form-control" name="nom_entreprise" required>
            <div class="error-message" id="nom_entreprise_error"></div>
        </div>
        <div class="mb-3">
            <label for="montant_sponsor">Montant</label>
            <input type="number" id="montant_sponsor" class="form-control" name="montant_sponsor" required>
            <div class="error-message" id="montant_sponsor_error"></div>
        </div>
        <div class="mb-3">
            <label for="type_sponsor">Type</label>
            <input type="text" id="type_sponsor" class="form-control" name="type_sponsor" required>
            <div class="error-message" id="type_sponsor_error"></div>
        </div>
        <div class="mb-3">
            <label for="date_acceptation">Date Acceptation</label>
            <input type="date" id="date_acceptation" class="form-control" name="date_acceptation" required>
            <div class="error-message" id="date_acceptation_error"></div>
        </div>
        <div class="mb-3">
            <label for="engagement">Engagement</label>
            <textarea id="engagement" class="form-control" name="engagement" rows="3" required></textarea>
            <div class="error-message" id="engagement_error"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Ajouter</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
    </div>
</form>
        </div>
    </div>
</div>

<!-- Modal pour Modifier un Sponsor -->
<div class="modal fade" id="editSponsorModal" tabindex="-1" aria-labelledby="editSponsorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSponsorModalLabel">Modifier le Sponsor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editSponsorForm" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" id="edit_id_sponsor" name="id_sponsor">
                    
                    <div class="mb-3">
                        <label for="edit_nom_entreprise">Nom Entreprise</label>
                        <input type="text" id="edit_nom_entreprise" class="form-control" name="nom_entreprise" required>
                        <div id="edit_nom_entreprise_error" class="text-danger small"></div> <!-- Message d'erreur -->
                    </div>
                    <div class="mb-3">
                        <label for="edit_montant_sponsor">Montant</label>
                        <input type="number" id="edit_montant_sponsor" class="form-control" name="montant_sponsor" required>
                        <div id="edit_montant_sponsor_error" class="text-danger small"></div> <!-- Message d'erreur -->
                    </div>
                    <div class="mb-3">
                        <label for="edit_type_sponsor">Type</label>
                        <input type="text" id="edit_type_sponsor" class="form-control" name="type_sponsor" required>
                        <div id="edit_type_sponsor_error" class="text-danger small"></div> <!-- Message d'erreur -->
                    </div>
                    <div class="mb-3">
                        <label for="edit_date_acceptation">Date Acceptation</label>
                        <input type="date" id="edit_date_acceptation" class="form-control" name="date_acceptation" required>
                        <div id="edit_date_acceptation_error" class="text-danger small"></div> <!-- Message d'erreur -->
                    </div>
                    <div class="mb-3">
                        <label for="edit_engagement">Engagement</label>
                        <textarea id="edit_engagement" class="form-control" name="engagement" rows="3" required></textarea>
                        <div id="edit_engagement_error" class="text-danger small"></div> <!-- Message d'erreur -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Modifier</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmation pour la suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce sponsor ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Supprimer</button>
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
    </div>

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
    document.getElementById('sponsorForm').addEventListener('submit', function(event) {
        let valid = true;

        // Reset all error messages
        document.querySelectorAll('.error-message').forEach(function(element) {
            element.textContent = '';
            element.style.color = '';
        });

        // Nom Entreprise (must be a string)
        const nomEntreprise = document.getElementById('nom_entreprise').value;
        if (!nomEntreprise) {
            document.getElementById('nom_entreprise_error').textContent = 'Ce champ est requis';
            document.getElementById('nom_entreprise_error').style.color = 'red';
            valid = false;
        }

        // Montant Sponsor (must be an integer)
        const montantSponsor = document.getElementById('montant_sponsor').value;
        if (!montantSponsor || !Number.isInteger(Number(montantSponsor))) {
            document.getElementById('montant_sponsor_error').textContent = 'Le montant doit être un nombre entier';
            document.getElementById('montant_sponsor_error').style.color = 'red';
            valid = false;
        }

        // Type Sponsor (must be a string)
        const typeSponsor = document.getElementById('type_sponsor').value;
        if (!typeSponsor) {
            document.getElementById('type_sponsor_error').textContent = 'Ce champ est requis';
            document.getElementById('type_sponsor_error').style.color = 'red';
            valid = false;
        }

        // Date Acceptation (must be greater than today's date)
        const dateAcceptation = document.getElementById('date_acceptation').value;
        const today = new Date().toISOString().split('T')[0]; 
        if (!dateAcceptation || dateAcceptation <= today) {
            document.getElementById('date_acceptation_error').textContent = 'La date doit être supérieure à aujourd\'hui';
            document.getElementById('date_acceptation_error').style.color = 'red';
            valid = false;
        }

        // Engagement (must be a string)
        const engagement = document.getElementById('engagement').value;
        if (!engagement) {
            document.getElementById('engagement_error').textContent = 'Ce champ est requis';
            document.getElementById('engagement_error').style.color = 'red';
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
</script>
<script>
    // Écouteur d'événement pour les boutons "Modifier"
    document.querySelectorAll('.edit-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Récupérer les données de la ligne sélectionnée
            const id = this.getAttribute('data-id');
            const nom = this.getAttribute('data-nom');
            const montant = this.getAttribute('data-montant');
            const type = this.getAttribute('data-type');
            const date = this.getAttribute('data-date');
            const engagement = this.getAttribute('data-engagement');

            // Remplir le formulaire du modal avec les données récupérées
            document.getElementById('edit_id_sponsor').value = id;
            document.getElementById('edit_nom_entreprise').value = nom;
            document.getElementById('edit_montant_sponsor').value = montant;
            document.getElementById('edit_type_sponsor').value = type;
            document.getElementById('edit_date_acceptation').value = date;
            document.getElementById('edit_engagement').value = engagement;

            // Afficher le modal
            const myModal = new bootstrap.Modal(document.getElementById('editSponsorModal'));
            myModal.show();
        });
    });
</script>


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
<script>
    // Fonction de validation avant l'envoi du formulaire
    document.getElementById('editSponsorForm').addEventListener('submit', function(event) {
        // Empêcher l'envoi du formulaire si la validation échoue
        event.preventDefault();

        let isValid = true;

        // Réinitialiser les erreurs
        clearErrors();

        // Récupérer les valeurs des champs
        const nomEntreprise = document.getElementById('edit_nom_entreprise').value.trim();
        const montantSponsor = document.getElementById('edit_montant_sponsor').value.trim();
        const typeSponsor = document.getElementById('edit_type_sponsor').value.trim();
        const dateAcceptation = document.getElementById('edit_date_acceptation').value.trim();
        const engagement = document.getElementById('edit_engagement').value.trim();

        // Vérification des champs
        if (nomEntreprise === "") {
            showError('edit_nom_entreprise', "Le nom de l'entreprise ne peut pas être vide.");
            isValid = false;
        } else if (/\d/.test(nomEntreprise)) { // Vérifier que ce n'est pas une chaîne contenant des chiffres
            showError('edit_nom_entreprise', "Le nom de l'entreprise ne doit pas contenir de chiffres.");
            isValid = false;
        }

        if (typeSponsor === "") {
            showError('edit_type_sponsor', "Le type de sponsor ne peut pas être vide.");
            isValid = false;
        } else if (/\d/.test(typeSponsor)) { // Vérifier que ce n'est pas une chaîne contenant des chiffres
            showError('edit_type_sponsor', "Le type de sponsor ne doit pas contenir de chiffres.");
            isValid = false;
        }

        if (montantSponsor === "" || isNaN(montantSponsor) || !Number.isInteger(parseFloat(montantSponsor))) {
            showError('edit_montant_sponsor', "Le montant doit être un nombre entier.");
            isValid = false;
        }

        // Vérifier que la date est bien supérieure à aujourd'hui
        const currentDate = new Date();
        const inputDate = new Date(dateAcceptation);
        if (dateAcceptation === "" || inputDate <= currentDate) {
            showError('edit_date_acceptation', "La date doit être supérieure à aujourd'hui.");
            isValid = false;
        }

        if (engagement === "") {
            showError('edit_engagement', "L'engagement ne peut pas être vide.");
            isValid = false;
        }

        // Si tout est valide, soumettre le formulaire
        if (isValid) {
            this.submit();
        }
    });

    // Fonction pour afficher une erreur sous le champ
    function showError(fieldId, message) {
        const errorDiv = document.getElementById(`${fieldId}_error`);
        if (errorDiv) {
            errorDiv.innerText = message;  // Mettre à jour le texte de l'erreur
        }
    }

    // Fonction pour nettoyer les erreurs
    function clearErrors() {
        const errorMessages = document.querySelectorAll('.text-danger');
        errorMessages.forEach(error => error.innerText = '');  // Réinitialiser les messages d'erreur
    }
</script>

<script>
    // Attendre que le DOM soit prêt
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');
        let formToSubmit;

        // Ajouter un gestionnaire d'événements pour chaque bouton "Supprimer"
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Récupérer le formulaire associé à ce bouton
                formToSubmit = button.closest('form');
                
                // Afficher la boîte de confirmation
                var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {
                    keyboard: false
                });
                myModal.show();
            });
        });

        // Ajouter un gestionnaire pour le bouton "Supprimer" dans le modal
        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            // Soumettre le formulaire de suppression
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });
    });
</script>
</body>

</html>