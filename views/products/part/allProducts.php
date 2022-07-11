<?php foreach($products as $product) : ?>
<article class='products  <?= $product['category'] ?>'>
    
    <div data-id="<?= intval($product['id']) ?>">
              
        <h2><?= htmlspecialchars($product['name']) ?><em>BIO</em></h2>
        
        <div>
            <img src="assets/img/products/<?= intval($product['id']) ?>/<?= htmlspecialchars($product['picture']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        </div>
        <div class='prod-ardoise'>
            
            <h3>composition</h3>
            
            <p><?= htmlspecialchars($product['description']) ?></p>
       
            <span data-price="<?= htmlspecialchars($product['price']) ?>"><?= htmlspecialchars($product['price']) ?> €</span>
            
        </div>
        <div class="clear"></div>
        <button class='details'>ajouter au panier</button>
        

        
    </div>
    
</article>

<?php endforeach; ?>
<div class="clear"></div>