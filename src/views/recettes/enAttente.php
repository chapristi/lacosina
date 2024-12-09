<div class="container">
    <h1 class="text-center mb-4">Mes recettes en attente</h1>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($recettes as $recette): ?>
        <tr>
            <td><?= $recette['titre']?></td>
            <td><?= $recette['description'] ?></td>

        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>