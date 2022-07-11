import Basket from './Basket.js';

// class qui gère le panier
export default class DisplayBasket
{    
    constructor(page = 'basket'){
        this.basket         = new Basket();
        this.panier         = this.basket.loadBasket();  
        this.emptyBasket    = document.querySelector('#emptycard');
        this.filledBasket   = document.querySelector('#filledcard');
        this.verif(page);
    }
    
    verif(page)
    {    
        if(page == 'order'){
            this.displayBasket('order');
            return;
        }   
        // verifie l'etat du panier.
        const panier = this.panier;
        // s'il est vide appel displayEmptyBasket
        if(panier.length == 0)
        {
            this.displayEmptyBasket();
        // si au moins un produit appel displayBasket
        }else{
            this.displayBasket('basket');
        }
    }
    
    createTag(tagHtml, content = null)
    {    
        const tag       = document.createElement(tagHtml);
        tag.textContent = content;
        return tag;   
    }
    
    displayBasket(page)
    {    
        this.filledBasket.style.display     = 'block';
        if(page == 'basket'){
            this.emptyBasket.style.display      = 'none'; 
        }else{
            document.querySelector('.basket').style.display = 'none';
        }
        document.querySelector('#tbody-shop').innerHTML = '';
        
        for(const item of this.panier)
        {
            const tr    = this.createTag('tr');
            const td1   = this.createTag('td',item.name);
            const td2   = this.createTag('td',item.price.toFixed(2));
            const td3   = this.createTag('td',item.quantity);
            const td4   = this.createTag('td',(item.price*item.quantity).toFixed(2));    
            tr.append(td1, td2, td3, td4);
            if(document.querySelector('.suppr'))
            {
                const td5                   = this.createTag('td');
                td5.style.textAlign         = 'center';
                const trash                 = this.createTag('i');    
                trash.setAttribute('class','fas fa-trash-alt');
                const hyperText             = this.createTag('a');
                hyperText.href              = '#';
                hyperText.append(trash);
                hyperText.dataset.deleteId  = item.id;
                td5.append(hyperText);
                tr.append(td5);
            }
            document.querySelector('#tbody-shop').prepend(tr);   
        }
        
        this.displayAmount(); 
    }
    
    displayEmptyBasket(){
        
        this.emptyBasket.style.display      = 'block';
        
        this.filledBasket.style.display     = 'none';
        
        this.emptyBasket.innerHTML = `<p>Aucun produit dans le panier pour le moment</p>`;
    }
    
    displayAmount(){
        const shoppingCart = this.panier;
        
        let totalAmount = 0.00;
        
        for(const item of shoppingCart){

            totalAmount += item.price * item.quantity;
        }
        
        document.querySelector('#totalAmount').textContent = `Le montant total de la commande est de ${totalAmount.toFixed(2)} €`;
    }
    
}