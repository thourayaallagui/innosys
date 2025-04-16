<?php
// Include necessary files and classes
require_once('C:/xampp/htdocs/gevent/config.php');
include 'C:/xampp/htdocs/gevent/controller/reservationC.php';
include 'C:/xampp/htdocs/gevent/controller/evenementC.php';

// Fetch the event ID passed via GET
$event_id = isset($_GET['event']) ? $_GET['event'] : null;

if ($event_id) {
  $eventC = new EvenementC();
  $event = $eventC->findone($event_id); // Fetch event details by event_id
} else {
  // Handle the case where event_id is not provided
  echo "Event ID not found.";
  exit;
}
// Create an instance of ReservationC to manage reservations
$reservationC = new ReservationC();

if (
  isset($_POST["nomClient"]) &&
  isset($_POST["emailClient"]) &&
  isset($_POST["telClient"]) &&
  isset($_POST["dateReservation"]) &&
  isset($_POST["event_id"])
) {
  if (
    !empty($_POST["nomClient"]) &&
    !empty($_POST["emailClient"]) &&
    !empty($_POST["telClient"]) &&
    !empty($_POST["dateReservation"]) &&
    !empty($_POST["event_id"])
  ) {
    // Sanitize and assign the form inputs
    $nomClient = $_POST["nomClient"];
    $emailClient = $_POST["emailClient"];
    $telClient = $_POST["telClient"];
    $dateReservation = $_POST["dateReservation"];
    $event_id = $_POST["event_id"]; // The event ID comes from the URL or form input

    // Create a new Reservation object
    $reservation = new Reservation($nomClient, $emailClient, $telClient, $dateReservation, $event_id);

    // Call the create method from ReservationC to save the reservation
    $reservationC->create($reservation);

    // Redirect or show success message
    echo "Réservation ajoutée avec succès!";
  } else {
    // If any field is empty, show an error message
    $error = "Veuillez remplir tous les champs obligatoires.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - OnePage Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Click&Go</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="sponsors.html">Sponsors</a></li>

          <li><a href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="myaccount.php">My Account</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="assets/img/hero-bg-abstract.jpg" alt="" data-aos="fade-in" class="">

      <!-- Reservation Form -->
      <div class="container mt-5">
        <h3 class="text-center mb-4">Réservation pour l'Événement: <?= htmlspecialchars($event['nom']) ?></h3>

        <form id="reservationForm" method="POST">
          <!-- Event ID (Hidden) -->
          <input type="hidden" name="event_id" value="<?= $event_id ?>">

          <div class="mb-3">
            <label for="nomClient" class="form-label">Nom Client</label>
            <input type="text" class="form-control" id="nomClient" name="nomClient">
            <div id="nomClientError" class="text-danger"></div>
          </div>

          <div class="mb-3">
            <label for="emailClient" class="form-label">Email</label>
            <input type="email" class="form-control" id="emailClient" name="emailClient">
            <div id="emailClientError" class="text-danger"></div>
          </div>

          <div class="mb-3">
            <label for="telClient" class="form-label">Téléphone</label>
            <input type="tel" class="form-control" id="telClient" name="telClient">
            <div id="telClientError" class="text-danger"></div>
          </div>

          <div class="mb-3">
            <label for="dateReservation" class="form-label">Date de Réservation</label>
            <input type="date" class="form-control" id="dateReservation" name="dateReservation">
            <div id="dateReservationError" class="text-danger"></div>
          </div>

          <button type="submit" class="btn btn-primary">Réserver</button>
        </form>
      </div>

      <script>
        // Client-side validation with JS
        document.getElementById("reservationForm").addEventListener("submit", function(event) {
          let isValid = true;

          // Clear previous error messages
          document.getElementById("nomClientError").innerHTML = "";
          document.getElementById("emailClientError").innerHTML = "";
          document.getElementById("telClientError").innerHTML = "";
          document.getElementById("dateReservationError").innerHTML = "";

          // Validate Name (Only letters and spaces) and check if empty
          let nomClient = document.getElementById("nomClient").value;
          if (nomClient.trim() === "") {
            document.getElementById("nomClientError").innerHTML = "Le nom est obligatoire.";
            isValid = false;
          } else {
            let nameRegex = /^[a-zA-Z\s]+$/;
            if (!nameRegex.test(nomClient)) {
              document.getElementById("nomClientError").innerHTML = "Le nom ne peut contenir que des lettres et des espaces.";
              isValid = false;
            }
          }

          // Validate Email and check if empty
          let emailClient = document.getElementById("emailClient").value;
          if (emailClient.trim() === "") {
            document.getElementById("emailClientError").innerHTML = "L'email est obligatoire.";
            isValid = false;
          } else {
            let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailRegex.test(emailClient)) {
              document.getElementById("emailClientError").innerHTML = "Veuillez entrer un email valide.";
              isValid = false;
            }
          }

          // Validate Phone Number (Only digits, min length 10) and check if empty
          let telClient = document.getElementById("telClient").value;
          if (telClient.trim() === "") {
            document.getElementById("telClientError").innerHTML = "Le numéro de téléphone est obligatoire.";
            isValid = false;
          } else {
            let telRegex = /^[0-9]{8}$/;
            if (!telRegex.test(telClient)) {
              document.getElementById("telClientError").innerHTML = "Le numéro de téléphone doit comporter 8 chiffres.";
              isValid = false;
            }
          }

          // Validate Date of Reservation (can't be in the past) and check if empty
          let dateReservation = document.getElementById("dateReservation").value;
          if (dateReservation.trim() === "") {
            document.getElementById("dateReservationError").innerHTML = "La date de réservation est obligatoire.";
            isValid = false;
          } else {
            let currentDate = new Date().toISOString().split('T')[0];
            if (dateReservation < currentDate) {
              document.getElementById("dateReservationError").innerHTML = "La date de réservation ne peut pas être dans le passé.";
              isValid = false;
            }
          }

          if (!isValid) {
            event.preventDefault(); // Prevent form submission if validation fails
          }
        });
      </script>

    </section><!-- /Hero Section -->


  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">OnePage</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p>United States</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">OnePage</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>