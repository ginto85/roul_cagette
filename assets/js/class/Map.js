import DataStorage from './DataStorage.js';

// class qui gère la map LEAFLET
export default class Map 
{    
    constructor()
    {
        this.DataStorage = new DataStorage();
    }

    init()
    {   
        let cities = {
            "L'herbergement":       {"name": "La perle de Saigon"     , "lat":  46.9082  , 'lon': -1.37728 },
            "Essarts en Bocage":    {"name": "Place Bon'AP"           , "lat":  46.7698  , 'lon': -1.23061 },
            "Lège":                 {"name": "Lège Pizza"             , "lat":  46.8886  , 'lon': -1.59048 },   
            "Clisson":              {"name": "Tutti Pizza Clisson"    , "lat":  47.0877  , 'lon': -1.28619 },
            "Tiffauges":            {"name": "La Crêperie du Vidâme"  , "lat":  47.0138  , 'lon': -1.11374 }
        };
        
        const zoomlevel = 10 ;   
        const map = L.map('mapid').setView([ 46.97380, -1.30708],10);
        const mainLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZ2ludG84NSIsImEiOiJja3JkNXRpMm0wYjI1MnpuMDNrY29lcGl3In0.gmHFz1LJBSNifK_uBI7F4A',local :"fr"});
        const point = this.DataStorage.loadDataFromDomStorage('pointLivraison');
        let latlng = L.latLng(parseFloat(point[0].lat), parseFloat(point[0].lng));
        let popup = L.popup()
                        .setLatLng(latlng)
                        .setContent('<p> '+ point[0].name + ' sera votre point de livraison à '+ point[0].city + '.</p>')
                        .openOn(map);
   
        for(let city in cities)
        {            
            const marker1 = L.marker([cities[city].lat, cities[city].lon]).addTo(map);
        }
        
        mainLayer.addTo(map);
    }
}