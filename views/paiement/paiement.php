<h1>Paiement</h1>
<article class= "paiement">
    <h2 id="orderId" data-order="<?= intval($_GET['orderNum']) ?>" >Paiement Commande n° <?= intval($_GET['orderNum']) ?></h2>		
    <p data-amount="<?= $totalAmount ?>">Montant total dû: <?= $totalAmount ?> €</p>
    
    
    <form id='paiement-form' medthod='get'>
        <!-- 1 -  div pour les erreurs de paiements (paiement refusé, probleme de connexion )  -->
        <div id="errors"></div>
        
        <!-- 2 -  Nom du detenteur de la cart   -->
        <input type="text" id="cardholder-name" placeholder="Titulaire de la carte">
        
        <!-- 3 - Le formulaire de paiement qui sera crée par stripe -->
        <div id="form-paiement"></div>
        
        <!-- 4 - button sur lequel il y aura un evenement j'ai ajouté type boutton pour eviter qu'il soumet l'evenement comme si j'avais fait event.preventDefault() -->
        <button id="card-button" type="button" data-secret="<?= $intent['client_secret'] ?>">Procéder au paiement</button>

    </form>
</article>