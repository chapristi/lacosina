
<div class="container">
    <h1 class="mb-4">Commentaires</h1>



    <?php foreach ($commentaires as $commentaire): ?>
        <div class="card mb-3 border-dark">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong><?= htmlspecialchars($commentaire['pseudo']) ?></strong>
                <a  class="btn btn-sm btn-danger supprimer" title="Supprimer" data-id="<?=$commentaire['id']?> ">
                    <i class="bi bi-trash"></i>
                </a>
            </div>
            <div class="card-body">
                <p class="card-text"><?= htmlspecialchars($commentaire['commentaire']) ?></p>
                <small class="text-muted">Posté le : <?= htmlspecialchars($commentaire['create_time']) ?></small>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script type="text/javascript" src="src/views/js/comment.js"></script>

