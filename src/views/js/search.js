let recipes = []; // Stock global pour les recettes

function loadRecipes() {
    fetch('http://localhost/php-mariadb-2/index.php?url=recettes&a=indexJSON&x=', {
        method: 'GET',
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur HTTP ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            recipes = data;
            console.log('Recettes chargées :', recipes);
            console.log(recipes);
        })
        .catch(error => {
            console.error('Erreur lors de la requête :', error);
        });
}


function filterRecipes() {
    const searchInput = document.querySelector('#search');

    const searchValue = searchInput.value.trim().toLowerCase();
    if (searchValue === ''){
        location.reload();
    }

    const filteredRecipes = recipes.filter(recipe =>
        recipe.titre.toLowerCase().includes(searchValue)
    );

   return filteredRecipes;
}

function displayRecipes(recipesToDisplay) {

    let resultsDiv = document.querySelector('.container');

    if (!resultsDiv) {
        resultsDiv = document.createElement('div');
        resultsDiv.id = 'results-container';
        document.body.appendChild(resultsDiv);
    }


    resultsDiv.innerHTML = '';

    if (recipesToDisplay.length === 0) {
        resultsDiv.innerHTML = '<p>Aucune recette trouvée.</p>';
        return;
    }

    const htmlContent = recipesToDisplay.map(recipe => `
       <div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">
            <a href="http://localhost/php-mariadb-2/index.php?url=recettes&a=detail&id=${recipe.id}" class="text-decoration-none text-primary">
                ${recipe.titre}
            </a>
        </h5>
        <p class="card-text text-muted">${recipe.description}</p>
    </div>
</div>

    `).join('');

    resultsDiv.innerHTML = htmlContent;
}

document.addEventListener('DOMContentLoaded',()=>{
    const searchInput = document.querySelector('#search');
    loadRecipes();
    searchInput.addEventListener('input', function (){
        displayRecipes(filterRecipes());

    })
});

