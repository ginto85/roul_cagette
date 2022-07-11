export default class Modal 
{    
    makeModal(event)
    {        
        const parentElement = event.target.parentElement;
        const id    = event.target.parentElement.dataset.id;
        const name  = parentElement.querySelector('h2').textContent;
        const price = +parentElement.querySelector('span').dataset.price;
        this.displayModal(id,price,name);
    }
    
    // affiche la modal du choix produit
    displayModal(productId,productPrice,productName)
    {        
        document.querySelector('#mymodal').innerHTML = `	
        <!--Modal panier-->
    	<div class="modal" data-price=${productPrice} data-id=${productId}>
    		<p>Ajouter <span>${productName}</span> au panier?</p>
    		<button id="confirmYes">OUI</button>
    		<button id="confirmNo">NON</button>
    	</div>`;
    }
    
     makeDeliveryModal(event)
     {        
        const parentElement = event.target.parentElement;
        const name  = parentElement.querySelector('p').textContent;
        const city  = parentElement.querySelector('span').textContent;
        const id    = parentElement.dataset.id;
        let lat   = parentElement.querySelector('button').dataset.lat;
        let lng   = parentElement.querySelector('button').dataset.lng;
        this.displayDeliveryModal(name,city,id,lat,lng);
    }
    
    // affiche la modal du choix point de livraison
    displayDeliveryModal(deliveryName,deliveryCity,deliveryId,deliveryLat,deliveryLng)
    {    
        document.querySelector('#mymodal').innerHTML = `	
    	<div class="modal" data-id="${deliveryId}" data-lat="${deliveryLat}" data-lng="${deliveryLng}">
    		<p>Valider 
        		 "<span>${deliveryName}</span><br>
        		<span>${deliveryCity}</span>"<br>
        		 comme point relais?
    		</p>
    		<button id="ConfirmDeliveryYes">OUI</button>
    		<button id="ConfirmDeliveryNo">NON</button>
    	</div>`;
    }
    /* cacher la modal */
    hideModal()
    {
        document.querySelector('#mymodal').innerHTML = '';   
    }
}