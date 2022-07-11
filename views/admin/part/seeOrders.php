
<?php if($_SESSION['user']['type'] == 1 ) : ?>
    <h2>Commande valider</h2>
    
    <p>Rechercher les commandes pour la période allant :</p>
    
    
    <form enctype="multipart/form-data" action="index.php?p=orderDate" method="post">
        <div>
            <label for="start">Du :</label>
        
            <input type="date" id="start" name="date-start" value='2021-07-29' min="2021-01-01" max="2050-12-31">
            
            <label for="end"> au :</label>
        
            <input type="date" id="end" name="date-end" value='2021-08-05' min="2021-01-01" max="2050-12-31">
        </div>
        
        <div>
         
            <button type="submit" id="form-submit" class="details main-button">Rechercher</button>
        
        </div>
    </form>
<?php endif; ?>