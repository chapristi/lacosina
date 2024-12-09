document.addEventListener('DOMContentLoaded', () => {
    let identifiant = document.getElementById('profil_identifiant');
    let mail = document.getElementById('profil_mail');
    let modifier = document.getElementById('bouton_modifier_profil');
    let divFavoris = document.getElementById('favoris');



    if (divFavoris) {

        fetch('http://127.0.0.1/php-mariadb-2/index.php?url=favoris&a=get_favorite&x')
            .then(response => response.json())
            .then(data => {
                console.log(data)
                if (data.length > 0) {
                    let ul = document.createElement('ul');

                    data.forEach(favori => {
                        let li = document.createElement('li');

                        li.innerHTML += `
    <div class="col-md-4">
        <div class="card" style="width: 100%;">
            <img src="${favori.image}" class="card-img-top" alt="${favori.titre}" style="height: auto;">
            <div class="card-body">
                <h3 class="card-title">${favori.titre}</h3>
                <p class="card-text">${favori.description}</p>
            </div>
        </div>
    </div>
`;


                        ul.appendChild(li);
                    });

                    divFavoris.appendChild(ul);
                } else {
                    divFavoris.innerHTML = '<p>Aucun favori trouvé.</p>';
                }
            })
            .catch(error => {
                divFavoris.innerHTML = '<p>Erreur de chargement des favoris.</p>';
                console.error('Erreur lors de la récupération des favoris:', error);
            });
    }

    if (identifiant){
        identifiant.addEventListener("input", (event) => {


            modifier.classList.remove('d-none');
        });
    }
 if(mail){
     mail.addEventListener("input", (event) => {
         modifier.classList.remove('d-none');
     });
 }


});
