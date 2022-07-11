<h1>Connexion </h1>
<article class='connect'>
    
    <h2>Connectez-vous</h2>
    <p class="select">Si vous n'avez pas de compte, vous pouvez en créer un <a href="index.php?p=register">ici</a>.</p>
    <p class="mandatory">Champs avec <abbr title="(required)" aria-hidden="true">*</abbr>  obligatoires.</p>
    
    <?php  if(!empty($messages['errors'])){  ?>
        <ul>
        <?php foreach($messages['errors'] as $error):  ?>    
            <li><?=  $error ?></li>
        <?php endforeach ?>    
        </ul>
    <?php    }  ?>
    <form action="index.php?p=login" method="post" class="connect-form">
    	<div>
    		<fieldset>
    			<legend>Informations</legend>
    			<label for="mail"><abbr title="(required)" aria-hidden="true">*</abbr> Mail</label>
    			<input type="email" id="mail" name="mail" value="<?php if(array_key_exists('mail',$_COOKIE)){ echo $_COOKIE['mail']; } ?>" >
    			<label for="password"><abbr title="(required)" aria-hidden="true">*</abbr> Mot de passe</label>
    			<input type="password" id="password" name="password" value ="<?php if(array_key_exists('password',$_COOKIE)){ echo $_COOKIE['password']; } ?>">
    			<div>
    			    <label for="remember"> Se souvenir de moi </label>	
    	            <input type="checkbox" value="true" id="remember" name="remember" checked>
    			</div>
    
    		</fieldset>
    	</div>
    	<p><input type="submit" value="Connexion"></p>
    </form>
    
</article>