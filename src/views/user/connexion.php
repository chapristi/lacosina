<h1>Connexion</h1>

<form action="?url=user&a=verifie_connexion" method="POST">
    
    <div class="mb-3">
        <label for="identifiant" class="form-label">
            Identifiant
        </label>
        <input type="text" class="form-control" name="identifiant" id="identifiant" required > 
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">
            Password
        </label>
        <input type="text" class="form-control" name="password" id="password" required > 
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"> Se connecter</button>
    </div>
</form>