
<article class='order'>
	<h2 id="orderId" data-order="<?= intval($_GET['orderId']) ?>">Commande n° <?= intval($_GET['orderId']) ?></h2>		
	<p id="userid" data-user-id="<?= $_SESSION['user']['id'] ?>"><?= $_SESSION['user']['login'] ?></p>
	
    <div id="ordercart">
         <!-- si le panier est vide -->
	    <div id="emptycard"></div>
	    <!-- si le panier n'est pas vide-->
        <div id="filledcard">
        	<table>
        		<thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </tr>
        		</thead>
        		
        		<tbody id="tbody-shop"></tbody>
        	</table>
        	
        	<div class="amount-div">
                <p id="totalAmount"></p>
            </div>
            
            <div id="mapid" ></div>
            <div class='button'>
                <a href="index.php?p=shoppingcart" class="marg" >Changer de point de livraison</a>
                <a href="index.php?p=paiement" class="marg" id="make-order-details">Proceder au paiement</a>
                <button class="details" id="cancel-order">Annuler commande</button>  
            </div>
        </div>
    </div>
      
    
	
</article>






