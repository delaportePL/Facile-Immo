function onClickBtnLike(e){
	e.preventDefault();
	fetch(this.href)
	.then(response => response.json())
	.then(data => {
		//On vérifie qu'il y a déjà un like ou non sur l'offre concernée avec le champ like envoyé sous forme de réponse json par OffreController (offre.like) 
		if(data.like == true){
			e.target.className = 'fa-solid fa-heart';
		}
		if(data.like == false){
			e.target.className = 'fa-regular fa-heart';
		}
	})
}
//On va chercher toutes les balises lien (a) possédant la classe js-dislike dans le DOM
//On boucle dessus, pour leur ajouter la fonction onClickBtnDislike sur l'événement du clique 
document.querySelectorAll('a.js-like').forEach(function(link){
	link.addEventListener('click', onClickBtnLike);
});