const arrows = document.querySelectorAll(".carousel i")

arrows.forEach(arrow => {
  arrow.addEventListener("click", () => {
	/*On récupère la valeur de dataset-carousel-arrow (next/prev)
	Si next alors on ira à l'image suivante sinon précédente */
    const offset = arrow.dataset.carouselArrow === "next" ? 1 : -1
    const slides = arrow
	//On récupère le carousel le plus proche car il y en a plusieurs dans la page
      .closest("[data-carousel]")
      .querySelector("[data-slides]")

    const activeSlide = slides.querySelector("[data-active]")
	/*On transforme la collection html de slides en tableau pour utiliser indexOf
	Ensuite on lui rajoute +1 ou -1 (offset) en fonction du clique sur prev ou next 
  -> attribué plus haut*/
    let newIndex = [...slides.children].indexOf(activeSlide) + offset
	
	/*Si on appuie sur la flèche gauche en étant sur la première image, 
  on attribue la longueur -1 de slides pour aller à la dernière image */
    if (newIndex < 0) newIndex = slides.children.length - 1
	//Même principe mais retour à l'image 1
    if (newIndex >= slides.children.length) newIndex = 0

    slides.children[newIndex].dataset.active = true
    delete activeSlide.dataset.active
  })
})