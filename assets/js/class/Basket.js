import DataStorage from './DataStorage.js';

export default class Basket
{

    constructor()
    {        
        this.basket    = new DataStorage();
        this.delivery  = new DataStorage(); 
    }

    loadBasket() 
    {
        let shoppingCart = this.basket.loadDataFromDomStorage('panier');
        if (shoppingCart == null){  
            shoppingCart = [];  
        }
        return shoppingCart;
    }

    // enregistre le choix de produits dans le domStorage
    saveBasket(basket) 
    {   
        this.basket.saveDataToDomStorage('panier', basket);
    }
    
    // affiche le point de livraison sur LEAFLET
    loadDeliveryPoint()
    {    
        let delivery = this.basket.loadDataFromDomStorage('pointLivraison');
        if (delivery == null){  
            delivery = [];  
        }
        return delivery; 
    }
    // enregistre le choix de point de livraison dans le domStorage
    saveDeliveryPoint(deliveryPoint)
    {        
       this.delivery.saveDataToDomStorage('pointLivraison', deliveryPoint);
    }
    
    //supprime le panier du domStorage
    clearBasket()
    {
        localStorage.clear();
    }
}