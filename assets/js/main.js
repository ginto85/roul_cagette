import Product          from './class/Product.js';
import Filter           from './class/Filter.js';
import Modal            from './class/Modal.js';
import Basket           from './class/Basket.js';
import DisplayBasket    from './class/DisplayBasket.js';
import Order            from './class/Order.js';
import Map              from './class/Map.js';
import Delivery         from './class/Delivery.js';
import Paiement         from './class/Paiement.js';

const ProductClass      = new Product();
const ModalClass        = new Modal();
const BasketClass       = new Basket();
const MapClass          = new Map();
const DeliveryClass     = new Delivery();
const PaiementClass     = new Paiement();

// VARIABLE MENU BURGER
const burger    = document.querySelector('.burger');
const nav       = document.querySelector('header div nav ul');

/******** DOM CONTENT LOADED   *********/
document.addEventListener('DOMContentLoaded',()=>{    
     event.preventDefault();

        /******** BURGER MENU    *********/
    burger.addEventListener('click', ()=>{
        nav.classList.toggle('dspno');
    });
    
        /* REFRESH DISPLAY Basket  */
    ProductClass.refreshBasketIcon();

        /* shopping cart */
    if(document.querySelector('#shoppingcart'))
    {
        new DisplayBasket();
    }
    if(document.querySelector('#ordercart'))
    {
        new DisplayBasket('order');  
    }
        /* Formulaire de Paiement */
    if(document.querySelector('#paiement-form'))
    {
        document.querySelector('.basket').style.display = 'none' ;// cache le panier
        PaiementClass.initStripe(Stripe('pk_test_51J3HTFKeyf8cAWIMHAjDom7o9HG0uXrkywK4Lu1w2K2JsD8r9JQ0QOPU6DRLwvOkWzb7qoTRKNOfE0dHqyLCuLCH00EXs1JYSG', {locale: 'fr'}));
        PaiementClass.makeForm();
    }
        /* page product DISPLAY */
    if(document.querySelector('.choice'))
    {
        new Filter('all');
    }
        /* page paiement delivery point DISPLAY  */
    if(document.querySelector('.deliveryPoint'))
    {
        new Filter('deliveryPoint');
    }
        /* DISPLAY map leaflet sur la page order  */
    if(document.querySelector('#mapid'))
    {
        MapClass.init();    
        setTimeout(function () {
          window.dispatchEvent(new Event('resize'));
        }, 2000);
    }
    /******** ADDEVENTLISTENER    *********/
    document.addEventListener('click',event =>{   
        new Filter(event.target.dataset.filter);
        // MODAL PAGE PRODUCT
        if(event.target.matches('.products button'))
        {    
            ModalClass.makeModal(event);
        }
        if(event.target.matches('#confirmYes'))
        {    
            ProductClass.makeProduct(event);
        }  
        if(event.target.matches('#confirmNo'))
        {
            ModalClass.hideModal(); 
        }
            // modal delivery point -> PAGE ORDER
        if(event.target.matches('.cityButton'))
        {
            ModalClass.makeDeliveryModal(event);
        }
        if(event.target.matches('#ConfirmDeliveryYes'))
        {
            DeliveryClass.makeDelivery(event);   
            ModalClass.hideModal(); 
            DeliveryClass.colorDelivery();
        }   
        if(event.target.matches('#ConfirmDeliveryNo'))
        {
            ModalClass.hideModal(); 
        }
            // vider le panier  
        if(event.target.matches('#clearCart'))
        {
            BasketClass.clearBasket();    
            ProductClass.refreshBasketIcon();
            new DisplayBasket();
        }
        // supprimer un produit de la bdd
        if(event.target.matches('[data-delete-id]'))
        {
            ProductClass.deleteProduct(event.target);
        }
            // sauvegarder la commande dans la BDD
        if(event.target.matches('#make-order-details'))
        {
            event.preventDefault();    
            new Order('save-orderlines');
        }
            // valide le paiement
        if(event.target.matches('#card-button'))
        {
            PaiementClass.paiement(event);
        }
            // supprimer commande dans LocalStorage et annule le PAIEMENT 
        if(event.target.matches('#cancel-order'))
        {
            BasketClass.clearBasket();    
            ProductClass.refreshBasketIcon();
            new DisplayBasket();
        }
    });
});

