<?php if($_SESSION['user']['type'] == 1 ) : ?>
    
    <h2 class="section-title">Ajouter un article</h2>
                 
          
        <div class="addProduct-form">
            <?php  if(!empty($messages['errors'])){  ?>
                <ul>
                <?php foreach($messages['errors'] as $error):  ?>    
                    <li><?=  $error ?></li>
                <?php endforeach ?>    
                </ul>
            <?php    }  ?>
            <form enctype="multipart/form-data" action="index.php?p=admin" method="post">
                <div>
                    <label for="name">Nom du produit</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Cagette de saison" required>
                </div>
                <div>
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div>
                    <label for="price">Prix du produit</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Ex: 15.40" required>
                </div>
                <div>
                    <label for="photo">Ajouter une photo</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                    <input type="file" class="form-control-file" id="photo" name="photo" required>
                </div>
                <div>
                    <label for="category">catégorie</label>
                    <select class="form-control" id="category" name="category">
                        <option value="vegetable" selected>Légumes</option>
                        <option value="fruit">Fruits</option>
                        <option value="meat">Viandes</option>
                    </select>
                </div>
                
                <div>
                 
                    <button type="submit" id="form-submit" class="details main-button">Ajouter le produit</button>
              
                </div>
            </form>
        </div>
               
<?php endif; ?>

</div> 