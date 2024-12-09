<div class="container w-75 m-auto">
    <h1><?= $recipe['titre']; ?></h1>
    <p><?= $recipe['description']; ?></p>
    <p class="badge bg-primary"><?= $recipe['type_plat']; ?></p>
    <br/>
    <a href="mailto:<?= $recipe['auteur'] ?>"><?= $recipe['auteur'] ?></a>
    <br>
    <img src="<?= $recipe['image'] ?>" alt="image recette" class="img-fluid rounded shadow">
    <div class="mt-2">
        <a href="?url=recettes&a=index" class="btn btn-primary">Retour à la liste de recettes</a>
        <?php if (!empty($_SESSION['id'])) : ?>
        <a href="?url=recettes&a=afficherFormulaireModification&id=<?= $_GET['id'] ?>" class="btn btn-primary">Modifier la recette</a>
        <a href="?url=recettes&a=supprimer&id=<?= $_GET['id'] ?>" class="btn btn-danger">Supprimer la recette</a>
        <?php if ($isFav) : ?>
            <a href="?url=favori&a=supprimer&id=<?= $_GET['id'] ?>" class="btn btn-warning btn-favorite">
                <i class="fas fa-heart"></i> Supprimer des favoris
            </a>
        <?php else : ?>
            <a href="?url=favori&a=ajouter&id=<?= $_GET['id'] ?>" class="btn btn-warning btn-favorite">
                <i class="fas fa-heart"></i> Ajouter aux favoris
            </a>

        <?php endif ?>
        <?php endif ?>
        <a  id="btn-ajout-commentaire" class="btn btn-primary" data-id="<?= $_GET['id'] ?>">Ajouter un commentaire</a>



    </div>
    <div id="div-comments">

    </div>
    <h2>Commentaires</h2>
    <div class="comments border rounded p-3 mt-3">
        <?php if (empty($commentaires)) : ?>
            <div class="alert alert-info" role="alert">
                Aucun commentaire sur cette recette.
            </div>
        <?php else : ?>
            <?php foreach ($commentaires as $comment) : ?>
                <div class="comment mb-3 p-3 border rounded bg-light">
                    <p class="mb-1"><strong><?= htmlspecialchars($comment['pseudo']) ?></strong></p>
                    <p class="mb-1"><?= nl2br(htmlspecialchars($comment['commentaire'])) ?></p>
                    <small class="text-muted">Posté le <?= htmlspecialchars($comment['create_time']) ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
<style>
    .btn-favorite:hover {
        background-color: #ffcc00;
        color: #fff;
        transform: scale(1.05);
    }
</style>
<script type="text/javascript" src="src/views/js/comment.js"></script>
