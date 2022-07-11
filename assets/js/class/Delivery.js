import Basket       from './Basket.js';
import Modal        from './Modal.js';
import DataStorage  from './DataStorage.js';

// class qui gère les point de livraison dans le localStorage
export default class Delivery
{    
    constructor()
    {      
        this.basket      = new Basket();
        this.modal       = new Modal();
        this.DataStorage = new DataStorage();
    }
    
    makeDelivery(event)
{        
        const parentElement = event.target.parentElement;
        const latDelivery   = parentElement.dataset.lat;
        const lngDelivery   = parentElement.dataset.lng;
        const span          = parentElement.querySelectorAll('span');
        let nameDelivery    = null;
        let cityDelivery    = null;

        for(let i=0; i<=  span.length ; i++)
        {
             nameDelivery  = span[0].textContent;
             cityDelivery  = span[1].textContent;
        }
        const deliveryPointId = parentElement.dataset.id;
        this.addDelivery(deliveryPointId,nameDelivery, cityDelivery, latDelivery, lngDelivery);
    }
    
    addDelivery(deliveryPointId,nameDelivery,cityDelivery, latDelivery, lngDelivery)
    {    
        const delivery = this.basket.loadDeliveryPoint();   
        const deliveryPoint = {
            id      : deliveryPointId,
            name    : nameDelivery,
            city    : cityDelivery,
            lat     : latDelivery,
            lng     : lngDelivery
        };
         // verifie si le point de livraison existe deja dans le local storage
        if(delivery !== 0 )
        {
            // retire le point de livraison
            delivery.shift();
            // ajoute le nouveau point de livraison
            delivery.push(deliveryPoint);
            // enregistre dans le local storage
            this.basket.saveDeliveryPoint(delivery);
            return;   
        }
        // ajoute le nouveau point de livraison
        delivery.push(deliveryPoint);
        // enregistre dans le local storage
        this.basket.saveDeliveryPoint(delivery); 
    }

    colorDelivery()
    {
        const pointData         = this.DataStorage.loadDataFromDomStorage('pointLivraison');
        const pointsDeliveries  = document.querySelectorAll('.deliveryPoint ul li');
            
        for(let i = 0 ; i < pointsDeliveries.length ; i++){
            if(pointsDeliveries[i].dataset.id == pointData[0].id)
            {
                pointsDeliveries[i].classList.add('colorDelivery');
            }
            if(pointsDeliveries[i].dataset.id != pointData[0].id)
            {
                pointsDeliveries[i].classList.remove('colorDelivery');
            }
        }
    }
}