console.log("js")
const attachEvents = () => {
    let recipes = document.querySelectorAll('.recipe');
    let hearts = document.querySelectorAll('.heart');
    let updates = document.querySelectorAll('.update');

    if (updates) {
        updates.forEach(update => {
            update.addEventListener('mouseover', function () {
                update.style.cursor = 'pointer';
            });

            update.addEventListener('mouseout', function () {
                update.style.cursor = 'default';
            });

            update.addEventListener('click', () => {
                const recetteId = update.getAttribute('data-id');
                window.location.href = "?url=recettes&a=afficherFormulaireModification&id=" + recetteId;
            });
        });
    }

    if (hearts) {
        console.log(hearts);
        hearts.forEach(heart => {
            heart.addEventListener('mouseover', function () {
                heart.style.cursor = 'pointer';
            });

            heart.addEventListener('mouseout', function () {
                heart.style.cursor = 'default';
            });

            heart.addEventListener('click', () => {
                const recetteId = heart.getAttribute('data-id');
                const isFav = heart.getAttribute('data-isfav') === '1'; // Vrai si déjà en favori
                const action = isFav ? 'supprimer' : 'ajouter';
                const url = `?url=favori&a=${action}&id=${recetteId}`;


                let heartIcon = heart.querySelector('.heart-icon'); // Sélectionne l'élément avec la classe 'heart-icon'


                fetch(url, {
                    method: 'GET',
                })
                    .then(response => response.text())
                    .then(data => {
                        if (heartIcon) {
                            if (heartIcon.classList.contains('bi-heart-fill')) {
                                heartIcon.classList.remove('bi-heart-fill');
                                heartIcon.classList.add('bi-heart');
                            } else if (heartIcon.classList.contains('bi-heart')) {
                                heartIcon.classList.remove('bi-heart');
                                heartIcon.classList.add('bi-heart-fill');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la requête:', error);
                    });
            });
        });
    }

    if (recipes) {
        recipes.forEach(recipe => {
            recipe.addEventListener('mouseover', (event) => {
                recipe.style.backgroundColor = 'lightgray';
            });

            recipe.addEventListener('mouseout', (event) => {
                recipe.style.backgroundColor = '';
            });

            recipe.addEventListener('click', (event) => {
                event.preventDefault();
                let recipeId = recipe.dataset.id;
                window.open('?url=recettes&a=detail&id=' + recipeId, '_self');
            });
        });
    }
};

document.addEventListener('DOMContentLoaded', ()=>{
    attachEvents();
    document.querySelectorAll('.btn-filtre').forEach(button => {
        button.addEventListener('click', () => {
            // Retirer la classe 'selected bg-primary text-white' de tous les boutons
            document.querySelectorAll('.btn-group .btn').forEach(btn => {
                btn.classList.remove('selected', 'bg-primary', 'text-white');
                btn.classList.add('btn-outline-primary'); // Restaurer l'apparence non sélectionnée
            });

            // Ajouter les classes au bouton cliqué
            button.classList.add('selected', 'bg-primary', 'text-white');
            button.classList.remove('btn-outline-primary');

            // Récupérer la valeur du filtre
            let filterValue = button.getAttribute("data-id");

            // Fetch pour récupérer et mettre à jour les recettes
            fetch('?url=recettes&a=index&filtre=' + filterValue)
                .then(response => response.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    let divContent = doc.querySelector('#listeRecettes');

                    // Remplacer le contenu de '#listeRecettes'
                    document.getElementById('listeRecettes').innerHTML = divContent.innerHTML;
                    attachEvents();

                })
                .catch(error => {
                    console.error('Error fetching filtered content:', error);
                });
        });

    });

    document.querySelector('#plat').addEventListener('click', () => {
        document.querySelectorAll('.btn-group .btn').forEach(btn => {
            btn.classList.remove('selected', 'bg-primary', 'text-white');
            btn.classList.add('btn-outline-primary');
        });

        const allRecipesButton = document.querySelector('#plat');
        allRecipesButton.classList.add('selected', 'bg-primary', 'text-white');
        allRecipesButton.classList.remove('btn-outline-primary');
    });

});




