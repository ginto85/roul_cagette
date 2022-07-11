<h1 class ='spacing-bottom'>Inscription </h1>
            
<article class='register'>
    
    <h2>Inscrivez-vous</h2>
    <?php if(empty($messages['success'])) : ?>
    <p class="select">Si vous n'avez pas de compte, c'est le moment d'en créer un.</p>
	<p class="mandatory">Champs avec <abbr title="(required)" aria-hidden="true">*</abbr> obligatoires.</p>
        <?php  if(!empty($messages['errors'])){  ?>
        <ul>
        <?php foreach($messages['errors'] as $error):  ?>    
            <li><?=  $error ?></li>
        <?php endforeach ?>    
        </ul>
    <?php    }  ?>
    
    <form action="index.php?p=register" method="post" class="connect-form">
    	<div>
    		<fieldset>
    			<legend>Informations</legend>
    			<label for="login"><abbr title="(required)" aria-hidden="true">*</abbr>Identifiant</label>
    			<input type="text" id="login" name="login" required>
    			<label for="password"><abbr title="(required)" aria-hidden="true">*</abbr>Mot de passe</label>
    			<input type="password" id="password" name="password" required>
    			<label for="password2"><abbr title="(required)" aria-hidden="true">*</abbr> Confirmer mot de passe</label>
    			<input type="password" id="password2" name="password2" required>
    
    			<label for="mail"><abbr title="(required)" aria-hidden="true">*</abbr> E-mail</label>
    			<input type="email" id="mail" name="mail" required>
    
    		</fieldset>
    	</div>
    	
    	<p><input type="submit" value="S'enregitrer"></p>
    </form>
    <?php else : ?>
	<p class="mandatory"><?= $messages['success'][0] ?></p>
	<a href="index.php?p=login">se Connecter</a>
    <?php endif; ?>
</article>