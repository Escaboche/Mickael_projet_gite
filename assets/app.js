/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/home.css';


// start the Stimulus application
import './bootstrap';
import Places from "places.js";
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

//Map
let map = document.querySelector('#map')
if (map !== null) {
    let marker = L.icon({
    iconUrl: '/images/img/silver-pointer.png',
    
    iconSize:     [100, 95], 
    shadowSize:   [50, 64], 
    iconAnchor:   [22, 94], 
    shadowAnchor: [4, 62],  
    popupAnchor:  [-3, -76] 
});


    let zone = [map.dataset.lat, map.dataset.lng];
    map = L.map('map').setView(zone , 13)
    let token = 'pk.eyJ1IjoiZXNjYWJvY2hlIiwiYSI6ImNrcWp5ZWRmYzAzdjEyd3BtYnk5M3hoYnEifQ.wsoPQqXzkDdZ3Hzp-nIyBA'
    L.tileLayer(`https://api.mapbox.com/v4/mapbox.satellite/{z}/{x}/{y}.png?access_token=${token}` , {
        maxZoom: 18,
        minZoom: 10,
    }).addTo(map)
    L.marker(zone , {icon : marker}).addTo(map)

}

// Places
let inputAddress = document.querySelector('#gite_address')

if (inputAddress !== null) {
    let place = Places({
        container: inputAddress
    })

    place.on('change', function (e) {
        console.log(e);
        document.querySelector('#gite_city').value = e.suggestion.city
        document.querySelector('#gite_postal_code').value = e.suggestion.postcode
        document.querySelector('#gite_lat').value = e.suggestion.latlng.lat
        document.querySelector('#gite_lng').value = e.suggestion.latlng.lng
    })

}

// Gestion Formulaire de contact
let BtnContact = document.getElementById('Contact');

    BtnContact.addEventListener('click', function () {
        let form = document.getElementById('contactForm');

        if (form.style.display = "none") {
            form.style.display = "block";
            BtnContact.style.display = "none";
        }

    })