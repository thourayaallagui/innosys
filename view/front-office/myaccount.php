<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location:login.php");
}

if (isset($_GET['logout'])) {
  // Destroy the session
  session_destroy();
  // Redirect to the login page
  header("Location: login.php");
}
include('../../controller/userC.php');

$error = "";



// create an instance of the controller
$userC = new userC();
// create user
$user = $userC->findone($_SESSION['id']);
if (
  isset($_POST["nom"]) &&
  isset($_POST["prenom"]) &&
  isset($_POST["email"]) &&
  isset($_POST["password"]) &&
  isset($_POST["age"]) &&
  isset($_POST["type"])
) {
  if (
    !empty($_POST["nom"]) &&
    !empty($_POST['prenom']) &&
    !empty($_POST["email"]) &&
    !empty($_POST["password"]) &&
    !empty($_POST["age"]) &&
    !empty($_POST["type"])
  ) {
    $user = new user(
      $_POST['nom'],
      $_POST['prenom'],
      $_POST['email'],
      $_POST['password'],
      $_POST['age'],
      $_POST['type']
    );
    $userC->update($user, $id);
    header('Location:index.php');
  } else
    $error = "Missing information";
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

      <a href="index.php" class="logo d-flex align-items-center me-auto">
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

          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="myaccount.php">My account</a>

    </div>
  </header>

  <main class="main">



    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <div class="container">


        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-8">
            <script>
              let myform = document.getElementById('formr');
              myform.addEventListener('submit', function(e) {
                let nameinput = document.getElementById('nom');
                let lnameinput = document.getElementById('prenom');
                let age = document.getElementById('age');
                let pw = document.getElementById('password');
                let email = document.getElementById('email');
                const regex = /^[a-zA-Z-\s]+$/;
                if (lnameinput.value === '') {
                  let lnameer = document.getElementById('prenomr');
                  lnameer.innerHTML = "le champs prenom est vide . ";
                  lnameer.style.color = 'red';
                  e.preventDefault();
                } else if (!(regex.test(lnameinput.value))) {
                  let lnameer = document.getElementById('nomr');
                  lnameer.innerHTML = "le prenom doit comporter des lettres,et tirets seulements.";
                  lnameer.style.color = 'red';
                  e.preventDefault();
                }
                if (nameinput.value === '') {
                  let nameer = document.getElementById('nomr');
                  nameer.innerHTML = "le champs nom est vide . ";
                  nameer.style.color = 'red';
                  e.preventDefault();
                } else if (!(regex.test(nameinput.value))) {
                  let nameer = document.getElementById('nomr');
                  nameer.innerHTML = "le nom doit comporter des lettres,et tirets seulements.";
                  nameer.style.color = 'red';
                  e.preventDefault();
                }
                ////////////
                if (pw.value === '') {
                  let pwr = document.getElementById('passwordr');
                  pwr.innerHTML = "le champs mot de pass est vide . ";
                  pwr.style.color = 'red';
                  e.preventDefault();
                }
                if (email.value === '') {
                  let emailr = document.getElementById('emailr');
                  emailr.innerHTML = "le champs email est vide . ";
                  emailr.style.color = 'red';
                  e.preventDefault();
                }
                if (age.value === '') {
                  let ager = document.getElementById('ager');
                  ager.innerHTML = "le champs age est vide . ";
                  ager.style.color = 'red';
                  e.preventDefault();
                } else if (!(/^[1-9]+$/.test(age.value))) {
                  let ager = document.getElementById('ager');
                  ager.innerHTML = "l age doit comporter que des numero";
                  ager.style.color = 'red';
                  e.preventDefault();
                }

              });
            </script>
            <h5 class="card-title mt-5 fw-semibold mb-4">Modifier mes info</h5>
            <div class="mt-5 card">
              <div class="card-body">
                <form action="" id="formr" method="post">
                  <div class="mb-3">
                    <label class="form-label">Nom :</label>
                    <input type="text" class="form-control" value="<?= $user['nom'] ?>" id="nom" name="nom">
                    <span id="nomr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Prenom :</label>
                    <input type="text" class="form-control" value="<?= $user['prenom'] ?>" id="prenom" name="prenom">
                    <span id="prenomr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Age :</label>
                    <input min=8 max=90 type="number" value="<?= $user['age'] ?>" class="form-control" id="age" name="age">
                    <span id="ager"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" value="<?= $user['email'] ?>" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    <span id="emailr"></span>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" value="<?= $user['password'] ?>" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <span id="passwordr"></span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Type :</label>
                    <select name="type" class="form-control" id="typeinput">
                      <option value="admin">admin</option>
                      <option value="client">client</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>


      </div><!-- End Contact Form -->

      </div>


    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.php" class="logo d-flex align-items-center">
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
  <script src="controle.js"></script>


</body>

</html>