import Basket from './Basket.js';
import Modal from './Modal.js';
import DisplayBasket from './DisplayBasket.js';

export default class Product 
{    
    constructor()
    {
        this.basket = new Basket();
        this.modal  = new Modal();
    }
    
    makeProduct(event)
    {
        const parentElement = event.target.parentElement;
        const id            = parentElement.dataset.id;
        const name          = parentElement.querySelector('p span').textContent;
        const price         = +parentElement.dataset.price;         
        this.addProduct(id, price, name ); // renvoi les informations 
    }
    /* ajouter un produit au panier */
    addProduct(productId,productPrice, productName)
    {
        // recuperer le panier 
        const shoppingCart = this.basket.loadBasket();    
        // créer le produit 
        const product = {
            id : productId,
            name : productName,
            price : productPrice,
            quantity : 1
        };
        // verifier si le produit existe deja dans le panier
        for( let index = 0; index < shoppingCart.length ; index++)
        {
            // si oui augmenter la quantite de produit de 1
            if(shoppingCart[index].id == product.id){
                shoppingCart[index].quantity++;
                this.basket.saveBasket(shoppingCart);
                this.refreshBasketIcon();
                return ;
            }
        }
        // si non ajouter le produit au panier
        shoppingCart.push(product);
        this.basket.saveBasket(shoppingCart);
        this.refreshBasketIcon();
    }
    /* supprimer un produit du panier */
    deleteProduct(event)
    {        
        // recuperer le panier 
        const shoppingCart = this.basket.loadBasket();
        // supprimer le produit 
        const newShopcart = shoppingCart.filter(product => product.id != event.dataset.deleteId);
        // sauvegarder le panier 
        this.basket.saveBasket(newShopcart);
       // rafraichi l'icone et le panier
        new DisplayBasket();
        this.refreshBasketIcon();
    }
    refreshBasketIcon()
    {        
        if(document.querySelector('#mymodal'))
            this.modal.hideModal();   
        // recuperer le panier 
        const shoppingCart = this.basket.loadBasket();
        let totalAmount = 0.0;
        
        for(const item of shoppingCart)
        {
            totalAmount += item.price * item.quantity;
        }
        document.querySelector('.basket span').textContent = totalAmount.toFixed(2);
    }
}