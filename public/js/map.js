const paris = {
    lat: 48.8580969,
    lng: 2.3370118
}
let zoomLevel = 12;

const map = L.map('map').setView([paris.lat, paris.lng], zoomLevel);

const layer = L.tileLayer('https://{s}.tile.jawg.io/jawg-streets/{z}/{x}/{y}{r}.png?access-token={accessToken}', {
    attribution: '<a href="http://jawg.io" title="Tiles Courtesy of Jawg Maps" target="_blank">&copy; <b>Jawg</b>Maps</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    minZoom: 0,
    maxZoom: 22,
    subdomains: 'abcd',
    accessToken: "A7xVA7hDI2oBzsqPOeeYg4NmaQAphy3zJvS5449vGt3xMVA4htlyjI6A9TbTg2rR"
});

layer.addTo(map);

let circleMarker = L.icon({
    iconUrl: '../img/circle-marker.svg',
    iconSize:     [10, 10],
    iconAnchor:   [5, 10],
    popupAnchor:  [0, -10]
});


const customOptions = {
    'maxWidth': '100',
    'className' : 'custom-popup'
}

/*
    Pour chaque offre récupérée dans la vue twig, on vérifie qu'il possèdent bien une latitude et une longitude en base de données.
    Si c'est le cas on ajoute un point sur la carte, aux coordonnées de l'offre. 
    Ensuite on lui lie une popup, qui s'affiche au passage de la souris sur le point (hover)
*/
offers.forEach(offer => {
    if(offer.latitude && offer.longitude){
        marker = L.marker([offer.latitude, offer.longitude], {icon: circleMarker});
        marker.addTo(map);

        let pricePopup = `
            <h3>${offer.prix.toLocaleString('fr-FR')} €</h3>
            <div>
                <a href="/offre-${offer.id}">
                    <i class="fa-solid fa-circle-arrow-right"></i>
                    Voir détail
                </a>
            <div>
        `;
        
        marker.bindPopup(pricePopup, customOptions);
    }
});



