<div class="container">
    <h1 class="text-center mb-4">Recettes à approuver</h1>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">Auteur</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($recettes as $recette): ?>
        <tr>
            <td><?= $recette['titre']?></td>
            <td><?= $recette['description'] ?></td>
            <td><?= $recette['auteur'] ?> </td>
            <td>
                <a href="#" class="btn btn-primary btn-sm">Voir</a>
                <a href="?url=recettes&a=approuver&id=<?= $recette['id'] ?>" class="btn btn-success btn-sm">Approuver</a>
                <a href="#" class="btn btn-danger btn-sm">Rejeter</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>