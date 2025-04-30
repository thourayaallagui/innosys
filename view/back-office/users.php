<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location:login.php");
  exit();
} else if ($_SESSION['type'] == "client") {
  header("Location:login.php");
  exit();
}

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit();
}

include('../../controller/userC.php');
$userC = new userC();

// Récupération des utilisateurs avec tri ou recherche
if (isset($_GET['search']) && !empty($_GET['search'])) {
  $users = $userC->search(htmlspecialchars($_GET['search']));
} elseif (isset($_GET['sort']) && isset($_GET['order'])) {
  $users = $userC->sortBy($_GET['sort'], $_GET['order']);
} else {
  $users = $userC->read();
}

$userC->delete();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Click&Go</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/kaiadmin/logo_light.svg" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
</head>
<body>
<div class="wrapper">
  <div class="main-panel">
    <div class="container">
      <div class="page-inner">
        <div class="row">
          <h1 class="mt-5">Gérer les utilisateurs</h1>
          <div class="mt-4 mb-3 d-flex justify-content-between">
            <a class="btn btn-primary" href="adduser.php">Ajouter utilisateur</a>
            <form method="GET" action="users.php" class="d-flex" style="max-width: 300px;">
              <input type="text" class="form-control me-2" placeholder="Chercher..." name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
              <button type="submit" class="btn btn-secondary">Rechercher</button>
            </form>
          </div>

          <table class="table mt-3">
            <thead>
              <tr>
                <th>
                  # 
                  <a href="?sort=id&order=asc">🔼</a>
                  <a href="?sort=id&order=desc">🔽</a>
                </th>
                <th>
                  NOM 
                  <a href="?sort=nom&order=asc">🔼</a>
                  <a href="?sort=nom&order=desc">🔽</a>
                </th>
                <th>
                  PRÉNOM 
                  <a href="?sort=prenom&order=asc">🔼</a>
                  <a href="?sort=prenom&order=desc">🔽</a>
                </th>
                <th>
                  EMAIL 
                  <a href="?sort=email&order=asc">🔼</a>
                  <a href="?sort=email&order=desc">🔽</a>
                </th>
                <th>
                  ÂGE 
                  <a href="?sort=age&order=asc">🔼</a>
                  <a href="?sort=age&order=desc">🔽</a>
                </th>
                <th>
                  TYPE 
                  <a href="?sort=type&order=asc">🔼</a>
                  <a href="?sort=type&order=desc">🔽</a>
                </th>
                <th>OPTION</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $u): ?>
                <tr>
                  <td><?= $u['id'] ?></td>
                  <td><?= htmlspecialchars($u['nom']) ?></td>
                  <td><?= htmlspecialchars($u['prenom']) ?></td>
                  <td><?= htmlspecialchars($u['email']) ?></td>
                  <td><?= htmlspecialchars($u['age']) ?></td>
                  <td><?= htmlspecialchars($u['type']) ?></td>
                  <td>
                    <a href="?delete=<?= $u['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?');">supprimer</a> || 
                    <a href="updateuser.php?update=<?= $u['id'] ?>">modifier</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="assets/js/core/jquery-3.7.1.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/kaiadmin.min.js"></script>
</body>
</html>
