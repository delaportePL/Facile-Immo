function onClickBtnDislike(e){
	e.preventDefault();
	fetch(this.href)
	.then(response => response.json())
	.then(data => {
		e.path[3].classList.add('disliked');
	})
}
//Ici on va chercher toutes les balises lien (a) possédant la classe js-dislike 
//On boucle dessus, pour leur ajouter la fonction onClickBtnDislike sur l'événement du clique 
document.querySelectorAll('a.js-dislike').forEach(function(link){
	link.addEventListener('click', onClickBtnDislike);
});
