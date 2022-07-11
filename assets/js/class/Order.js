
import Basket from './Basket.js';


export default class Order
{    
    constructor(action)
    {
        this.basketClass = new Basket(); 
        this.verif(action);   
    }
    
    verif(action)
    {        
        switch(action)
        {
            case 'save-orderlines':
                this.saveOrderlines();
            break;
        }
    }
    
    saveOrderlines()
    {
        //   recupere mon panier 
        const orderlines = this.basketClass.loadBasket();
        const deliveryObj = this.basketClass.loadDeliveryPoint();
        //  recupere l'id de l'user que j'ai mis dans la page order.php
        const orderId = document.querySelector('[data-order]').dataset.order;
        let deliveryPoint = deliveryObj[0].city;
        //   boucle sur chaque ligne du panier 
        for(const orderline of orderlines){
            //  mets dans un formData
            const form = new FormData();
            form.append('product_id',orderline.id);
            form.append('order_id',orderId);
            form.append('quantity',orderline.quantity);
            form.append('delivery_point',deliveryPoint);
            // lance ma requete ajax ( doit avoir une url qui appelera une fonction du ajaxController.php)
            fetch('index.php?ajax=saveOrderlines', { method: 'POST', body: form })
                .then(response => response.text())
                .then((res) => {
                    document.querySelector('#info').innerHTML = res;
                    document.location.href="index.php?p=paiement&orderNum="+orderId;   
            });       
        }
    }
}