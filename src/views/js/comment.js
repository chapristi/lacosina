document.addEventListener("DOMContentLoaded",()=>{

    const deleteButtons = document.querySelectorAll('.supprimer');

    let divCommentaire = document.getElementById('div-comments');
    let btnAjoutCommentaire = document.getElementById('btn-ajout-commentaire');
    if( btnAjoutCommentaire){
    btnAjoutCommentaire.addEventListener('click',()=>{

        let formComment = document.createElement('form');
        formComment.method = 'POST';
        formComment.action = '?url=comment&a=enregistrer&id='+btnAjoutCommentaire.dataset.id;

        let textarea = document.createElement('textarea');
        textarea.name = 'comment';
        textarea.placeholder = 'Saisir le commentaire';
        textarea.rows = '4';
        textarea.classList.add('form-control');
        textarea.required = true;

        let validateButton = document.createElement('button');
        validateButton.type = 'submit';
        validateButton.innerText = 'Envoyer';
        formComment.prepend(validateButton);

        formComment.prepend(textarea);

        divCommentaire.prepend(formComment);
        btnAjoutCommentaire.classList.add('d-none');

    })
    }
if(deleteButtons){
    deleteButtons.forEach((deleteButton) => {
        deleteButton.addEventListener("click", () => {
            console.log("sfd");
            const commentId = deleteButton.getAttribute("data-id");

            // Envoie la requête fetch
            fetch("?url=comment&a=supprimer&id=" + commentId, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((response) => {
                    location.reload();

                })
                .catch((error) => {
                    console.error("Erreur lors de la suppression :", error);
                });
        });
    });
}
})