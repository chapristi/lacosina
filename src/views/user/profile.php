<div class="container mt-5">
        <h1>Profil de l'utilisateur : 
            <span id="profil_identifiant_titre"><?php echo $_SESSION['identifiant']; ?></span>
        </h1>

        <div class="row">
            <div class="col">
                <img class="w-75 rounded mx-auto img-fluid" 
                     src="<?= "upload/12996329_085-1994-rachmaninov-29-x-39.jpg" ?> "
                     alt="<?= $_SESSION['identifiant']; ?>" 
                     class="card-img-top">
            </div>

            <div class="col">
                <p><b>Identifiant : </b>
                    <span id="profil_identifiant" 
                          data-id="<?= $_SESSION['id']; ?>" 
                          contenteditable="true">
                          <?= $_SESSION['identifiant'] ?>
                    </span>
                </p>

                <p><b>Email : </b>
                    <span id="profil_mail" 
                          data-id="<?= $_SESSION['id']; ?>" 
                          contenteditable="true">
                          <?= $_SESSION['mail'] ; ?>
                    </span>
                </p>
            </div>
        </div>

        <hr>

        <div id="boutons">
            <button id="bouton_modifier_profil" class="btn btn-primary d-none">Modifier le profil</button>
            <a href="?url=home" class="btn btn-primary">Retour à l'accueil</a>
        </div>
    </div>
    <script type="text/javascript" src="src/views/js/user.js"></script>

