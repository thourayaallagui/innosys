<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['type'] === "client") {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

include('../../controller/userC.php');
$userC = new userC();

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $users = $userC->search(htmlspecialchars($_GET['search']));
} elseif (isset($_GET['sort']) && isset($_GET['order'])) {
    $users = $userC->sortBy($_GET['sort'], $_GET['order']);
} else {
    $users = $userC->read();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Backoffice - Utilisateurs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Styles personnalisés -->
    <style>
        body {
            background-color: #e0f7ff;
            font-family: Arial, sans-serif;
            color: #003f5c;
        }

        .main-panel {
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #007acc;
        }

        .btn-primary {
            background-color: #00bfff;
            border-color: #00bfff;
        }

        .btn-primary:hover {
            background-color: #00a3cc;
            border-color: #00a3cc;
        }

        .btn-secondary {
            background-color: #b3e5fc;
            border-color: #b3e5fc;
            color: #004c6d;
        }

        .btn-secondary:hover {
            background-color: #81d4fa;
        }

        .table thead {
            background-color: #b3e5fc;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        a {
            color: #007acc;
        }

        a:hover {
            color: #005a8d;
            text-decoration: underline;
        }

        .form-control-sm {
            font-size: 0.875rem;
            padding: 0.25rem 0.5rem;
        }

        .search-bar {
            max-width: 250px;
        }
    </style>

    <!-- jQuery -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="main-panel">
        <div class="container">
            <h1 class="mb-4">Gérer les utilisateurs</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a class="btn btn-primary" href="adduser.php">Ajouter utilisateur</a>

                <form method="GET" action="users.php" class="d-flex search-bar">
                    <input type="text" class="form-control form-control-sm me-2" placeholder="Chercher..." name="search" id="search">
                    <button type="submit" class="btn btn-secondary btn-sm">Rechercher</button>
                </form>
            </div>

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th># 
                        <a href="?sort=id&order=asc">🔼</a>
                        <a href="?sort=id&order=desc">🔽</a>
                    </th>
                    <th>NOM 
                        <a href="?sort=nom&order=asc">🔼</a>
                        <a href="?sort=nom&order=desc">🔽</a>
                    </th>
                    <th>PRÉNOM 
                        <a href="?sort=prenom&order=asc">🔼</a>
                        <a href="?sort=prenom&order=desc">🔽</a>
                    </th>
                    <th>EMAIL 
                        <a href="?sort=email&order=asc">🔼</a>
                        <a href="?sort=email&order=desc">🔽</a>
                    </th>
                    <th>ÂGE 
                        <a href="?sort=age&order=asc">🔼</a>
                        <a href="?sort=age&order=desc">🔽</a>
                    </th>
                    <th>TYPE 
                        <a href="?sort=type&order=asc">🔼</a>
                        <a href="?sort=type&order=desc">🔽</a>
                    </th>
                    <th>OPTION</th>
                </tr>
                </thead>
                <tbody id="user-table-body">
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

<!-- AJAX Live Search -->
<script>
$(document).ready(function () {
    $('#search').on('input', function () {
        const query = $(this).val().trim();

        $.ajax({
            url: 'search.php',
            method: 'GET',
            data: { query: query },
            success: function (data) {
                try {
                    const users = JSON.parse(data);
                    let tbody = '';

                    users.forEach(u => {
                        tbody += `<tr>
                            <td>${u.id}</td>
                            <td>${u.nom}</td>
                            <td>${u.prenom}</td>
                            <td>${u.email}</td>
                            <td>${u.age}</td>
                            <td>${u.type}</td>
                            <td>
                                <a href="?delete=${u.id}" onclick="return confirm('Supprimer cet utilisateur ?');">supprimer</a> || 
                                <a href="updateuser.php?update=${u.id}">modifier</a>
                            </td>
                        </tr>`;
                    });

                    $('#user-table-body').html(tbody);
                } catch (error) {
                    console.error("Erreur parsing JSON:", error);
                }
            }
        });
    });
});
</script>

<!-- Bootstrap -->
<script src="assets/js/core/bootstrap.min.js"></script>
</body>
</html>
