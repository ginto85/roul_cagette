

<h1 class='titleShopKart'>Mon panier </h1>
<article class='shoppingcart'>
	<div id="shoppingcart">
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
	                    <th class="suppr"></th>
	                </tr>
	    		</thead>
	    		<tbody id="tbody-shop"></tbody>
	    	</table>
	    	<div class="amount-div">
	            <p id="totalAmount"></p>
	            <h2>choisissez un de nos points de retraits</h2>
	           
                <div id="mymodal"></div>
                <div class="deliveryPoint myresult maplist"></div>  
	     
	            <div>
	            	<?php if($session::online() === false) : ?>
						<p>Vous devez être connecté pour procéder à la validation du panier </p>
					<?php endif;?>
	            	<?php if(!empty($_SESSION['user'])) : ?>
	                <a data-filter='deliveryPoint' href="index.php?p=toPaiement" >Passer commande</a>
	                <?php endif ?>
	                <button class="details" id="clearCart">Vider panier</button>
	            </div>
	        </div>
	    </div>
	</div>
</article>
