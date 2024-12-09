<h1>
    Ajouter une recette
</h1>


<form action="?url=recettes&a=enregistrer" method="post" enctype="multipart/form-data" >
    <div class="mb-3">
        <label for="titre" class="form-label">Titre de la recette</label>
        <input type="text" name="titre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description de la recette</label>
        <input type="text" name="description" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Mail de l'auteur</label>
        <input type="email" value="<?= $_SESSION['mail'] ?>" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" name="type" id="type" required>
            <option value="" selected disabled>Sélectionnez un type</option>
            <option value="entree">Entrée</option>
            <option value="plat">Plat</option>
            <option value="dessert">Dessert</option>
        </select>
    </div>


    <input type="file" name="image" id="image" class="form-control" required>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" id="enregistrer" >Enregistrer</button>
    </div>
</form>