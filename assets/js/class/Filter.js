import Ajax from './Ajax.js';

export default class Filter
{
    
    constructor(target){        
        this.AjaxClass = new Ajax();
        this.verif(target);
    }
    
    verif(target)
    {        
        switch(target)
        {            
        // PAGE PRODUCTS
            //ALL
            case 'all':
                this.AjaxClass.requestHtml('index.php?ajax=allProducts');
            break;
            //MEAT  
            case 'meat':
                this.AjaxClass.requestHtml('index.php?ajax=meatProducts');
            break;
            //VEGETABLE   
            case 'vegetable':
                this.AjaxClass.requestHtml('index.php?ajax=vegetableProducts');
            break;
            //FRUIT     
            case 'fruit':
                this.AjaxClass.requestHtml('index.php?ajax=fruitProducts');
            break;
        // PAGE ADMIN      
            //ADD        
            case 'addProduct':
                this.AjaxClass.requestHtml('index.php?ajax=addProduct');
            break;
            //REMOVE    
            case 'removeProduct':
                this.AjaxClass.requestHtml('index.php?ajax=removeProduct');
            break;
            case 'updateProduct':
                this.AjaxClass.requestHtml('index.php?ajax=updateProduct');
            break;
            // SEE ORDERS
            case 'seeOrders':
                this.AjaxClass.requestHtml('index.php?ajax=seeOrders');
            break;
        // PAGE PAIEMENT DELIVERY POINT
            case 'deliveryPoint':
                this.AjaxClass.requestHtml('index.php?ajax=deliveryPoint');
            break;
        }
    }
}