
<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--responsive-->
    <meta name = "viewport" content="width=device-width, initial-scale=1">
    
<!--title-->
    <title>Roul'Cagette</title>
<!--meta description-->
    <meta name="description" content="Roul’Cagette, ce sont des produits locaux Vendéens et de saison près de chez vous. Légumes, fruits, viandes et fromages. L'ensemble des cultures est conduit en agriculture biololgique certifié. ">
<!--FONTAWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous"/>
<!--LEAFLET-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
    
<!--CSS-->
    <link rel="stylesheet" href="assets/css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">



</head>
    <!--BODY-->
<body>
    <!--HEADER-->
    <header>
        <div class="container">

			<!--LABELS PRODUCTS-->
			
    		<div class='head-nav'>
    		    <div class="logo">
        			<a href="index.php">
        				<img src="assets/img/logo.png" alt="Logo Roul'Cagette">
        			</a>
    			</div>
    			
    			<!--NAV-->
    			
    			<nav>
    			    
                    <div class='burger'>
    				    <div class='line1'></div>
    				    <div class='line2'></div>
    				    <div class='line3'></div>
    				</div>
    			    <ul class= 'list'>
    					<li><a href="index.php?p=home" <?= $https::active('home') ?>>Accueil</a></li>
    					<li><a href="index.php?p=about" <?= $https::active('about') ?>>A propos</a></li>
    					<li><a href="index.php?p=producers" <?= $https::active('producers') ?>>Nos producteurs</a></li>
    					<li><a href="index.php?p=products" <?= $https::active('products') ?>>Nos cagettes</a></li>
    					<li><a href="#contact">Contact</a></li>
    					<?php if(empty($_SESSION['user'])) : ?>
    					<li><a href="index.php?p=register" <?= $https::active('register') ?>>Inscription</a></li>
    					<li><a href="index.php?p=login" <?= $https::active('login') ?>>Connexion</a></li>
    				    <?php else : ?>
    					<li><a href="index.php?p=logout">Déconnexion</a></li>
    				    <?php endif; ?>
    				    <?php if(!empty($_SESSION['user']['type'] )) : ?>
    				    <li><a href="index.php?p=admin" <?= $https::active('admin') ?>>Administrateur</a></li>
    				    <?php endif; ?>
    				</ul>
    				
    			</nav>
			</div>
			<!-- fin NAV-->
			<div class='label'>
    			<img src="assets/img/font_awesome/agri_bio.png" alt="logo certification agriculture biologique">
    			
    			<img src="assets/img/font_awesome/red_label.jpg" alt="logo certification Label rouge">
			</div>
			<div class='basket'>
    			<a href="index.php?p=shoppingCart" title="acceder à mon panier"><p>Panier</p><i class="fas fa-shopping-cart "></i><span>00,00 </span>&#8364;</a>
			</div>
		
		</div>
        <!-- fin container-->
    </header>
    
    <!--MAIN-->
    <main>
       <div id="info"></div> 
        <!--SECTION DESCRIPTION-->
        <section class='container'>
            
           <?php require 'views/'.$path ?>

        </section>
    </main>
    
    <!--FOOTER-->
    <footer>
       <!--rassurance-->
        <div class="reassurance container">
            <div class='board'>
                <ul>
                    <li>
                        <i class="fas fa-couch"></i>
                        <span><strong>Commander</strong> depuis votre canapé</span>
                    </li>
                    <li>
                        <i class="far fa-snowflake"></i>
                        <span><strong>produits frais</strong> et respect de la chaîne du froid</span>
                    </li>
                    <li>
                        <i class="fas fa-truck"></i>
                        <span><strong>livraison en points relais</strong> ou en drive</span>
                    </li>
                    <li>
                        <i class="fas fa-cash-register"></i>
                        <span>paiement à la reception du colis</span>
                    </li>
                </ul>
            </div>
        </div>
        <!--end of rassurance-->
        <div id ='contact' class='contact container'>
            <ul>
                
                <li><i class="fas fa-phone-volume"></i><a href="tel:0643592523">06 43 59 25 23</a></li>
                <li><i class="fas fa-envelope-square"></i><a href="mailto:roulcagette@gmail.com">roulcagette@gmail.com</a></li>
                <li><i class="fas fa-map-marked-alt"></i><p> la grande chevasse </p><p>85260 Saint-Sulpice-le Verdon</p></li>
            </ul>
        </div>
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2727.766927146297!2d-1.404464084572737!3d46.867958946702075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805d3bb80a5a2ad%3A0x84f9e6c3ba4a4fbf!2sLa%20Chevasse%2C%20Montr%C3%A9verd!5e0!3m2!1sfr!2sfr!4v1625565374964!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy"></iframe>
        <div class='concept '>
            <ul>
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#">Site réaliser par <strong>GintoLab</strong></a></li>
            </ul>
            
        </div>
        
    </footer>
    
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
        <!-- JS -->
    
    <script src="https://js.stripe.com/v3/"></script>
    <script type="module" src="assets/js/main.js" ></script>
</body>
</html>