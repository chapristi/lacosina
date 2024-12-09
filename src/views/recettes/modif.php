<h1>
   Modifier la recette
</h1>


<form action="?url=recettes&a=enregistrer&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data" >
    <div class="mb-3">
        <label for="titre" class="form-label">Titre de la recette</label>
        <input type="text" name="titre" class="form-control" value="<?= $recette['titre'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description de la recette</label>
        <input type="text" name="description" class="form-control" value="<?= $recette['description'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Mail de l'auteur</label>
        <input type="email" name="email" class="form-control" value="<?= $recette['auteur'] ?>" required>
    </div>
    <div class="mb-3">
        <input type="file" name="image" id="image" class="form-control" value="<?=$recette['image']?>">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" id="enregistrer" >Enregistrer</button>
    </div>
</form>