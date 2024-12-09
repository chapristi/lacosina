<div class="container">
    <h1 class="row">Recettes</h1>

    <div class="row">
        <div class="container mt-5">
            <form>
                <div class="mb-3">
                    <div class="btn-group" role="group" aria-label="Type de plat">
                        <button type="button" class="btn-filtre btn btn-outline-primary selected bg-primary text-white" data-id="">Toutes les recettes</button>

                        <button type="button" class="btn-filtre btn btn-outline-primary" id="plat" data-id="plat">Plat</button>
                        <button type="button" class="btn-filtre btn btn-outline-primary" id="entree" data-id="entree">Entrée</button>
                        <button type="button" class="btn-filtre btn btn-outline-primary" id="dessert" data-id="dessert">Dessert</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row" id="listeRecettes">
            <?php foreach ($recipes as $recipe) : ?>
                <div class="col-md-5 p-2">

                    <div class="d-flex">
                        <?php if (!empty($_SESSION['id'])) : ?>
                            <?php if ($recipe['is_favorite'] === 0): ?>
                                <span class="heart" data-id="<?= $recipe['id'] ?>" data-isfav="<?= $recipe['is_favorite'] ?>">
                                    <i class="bi bi-heart heart-icon"></i>
                                </span>
                            <?php else:  ?>
                                <span class="heart" data-id="<?= $recipe['id'] ?>" data-isfav="<?= $recipe['is_favorite'] ?>">
                                    <i class="bi bi-heart-fill heart-icon"></i>
                                </span>
                            <?php endif;  ?>
                            <span class="update" data-id="<?= $recipe['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
                            </span>
                        <?php endif; ?>
                        <img src="<?= $recipe['image'] ?>" alt="image recette" class="img-fluid rounded shadow me-3 h-150" style="max-width: 200px;">
                        <div class="card recipe" data-id="<?= $recipe['id'] ?>">
                            <div class="card-body">
                                <h2 class="card-title">
                                    <?= $recipe['titre']; ?>
                                </h2>
                                <p class="card-text">
                                    <?= $recipe['description']; ?>
                                </p>
                                <a href="mailto:<?= $recipe['auteur']; ?>"><?= $recipe['auteur']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <a href="?url=acceuil" class="btn btn-primary"> Retour à l'acceuil</a>
</div>

<script type="text/javascript" src="src/views/js/recipes.js"></script>
