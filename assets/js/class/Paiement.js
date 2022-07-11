import Product from './Product.js';
import Basket from './Basket.js';

const BasketClass  = new Basket();
const ProductClass = new Product();

export default class Paiement
{    
    initStripe(publicKey)
    {
        this.stripe = publicKey;
    }
    
    makeForm()
    {
        this.form = this.stripe.elements().create('card',{hidePostalCode :true });
        this.form.mount('#form-paiement');
    }
    
    paiement(event)
    {
        // variable 
        const titulaire = document.querySelector("#cardholder-name").value; 
        const clientSecret = document.querySelector("#card-button").dataset.secret;
        
        this.stripe
        .confirmCardPayment(
                            clientSecret, 
                            { payment_method: {card: this.form,billing_details: {name: titulaire} }}
                            )
        .then((result) => {
            
            if(result.error){
                document.getElementById("errors").textContent = result.error.message;
            }else{
                const amount = document.querySelector('[data-amount]').dataset.amount;
                const order  = document.querySelector('[data-order]').dataset.order;
                
                BasketClass.clearBasket(); // vide le panier dans le localStorage
                ProductClass.refreshBasketIcon(); // vide l'icone du panier 
                
                // j'envoi des informations grace a mes parametre dans l'url
                document.location.href = `index.php?p=updateorder&amount=${amount}&orderId=${order}`;
                        
            }
        });
    }
}