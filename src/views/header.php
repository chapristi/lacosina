<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="src/views/js/search.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php?url=home&a=index">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?url=contact&a=contact">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?url=recettes&a=index">Voir les recettes</a>
        </li>
    </ul>
    <ul class="navbar-nav">

        <?php if (isset($_SESSION['id'])) : ?>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bienvenue <?= htmlspecialchars($_SESSION['identifiant']) ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item nav-link" href="index.php?url=recettes&a=ajouter">Ajouter une recette</a>
                    <a class="dropdown-item nav-link" href="index.php?url=user&a=profile">Mon profil</a>
                    <a class="dropdown-item nav-link" href="index.php?url=favori&a=favoris">Voir mes favoris</a>
                    <a class="dropdown-item nav-link" href="index.php?url=user&a=deconnexion">Déconnexion</a>
                    <a class="dropdown-item nav-link" href="index.php?url=recettes&a=enAttente">Mes recettes en attentes</a>

                    <?php if ($_SESSION['isAdmin'] == "1") : ?>
                        <a class="dropdown-item nav-link" href="index.php?url=comment&a=indexAdmin">Liste des commentaires</a>
                        <a class="dropdown-item nav-link" href="index.php?url=recettes&a=aApprouver">Recettes à approuver</a>

                    <?php endif ?>
                </div>
            </div>
        <?php else : ?>
            <li class="nav-item">
                <a class="btn btn-outline-dark" href="index.php?url=user&a=connexion">Connexion</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-outline-dark" href="index.php?url=user&a=enregistrer">Inscription</a>
            </li>
        <?php endif ?>
    </ul>


        <input type="search" id="search" placeholder="Rechercher une recette" class="navbar-brand">

</nav>

<?php if (isset($_SESSION['message'])) : ?>
    <?php foreach ($_SESSION['message'] as $type => $message) : ?>
        <div class="alert alert-<?= htmlspecialchars($type); ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['message']) ?>
<?php endif ?>
