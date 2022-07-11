<article class= "update">
    <h2>Modifier ce produit</h2>
    <div>
        <form enctype="multipart/form-data" name="numPost" action="index.php?p=update&numProduct=<?= htmlspecialchars($product['id']) ?>" method="post">
            <div>
                <input type="hidden" name='numPost' value="<?= htmlspecialchars($product['id']) ?> " required>
            </div>
            <div>
                <label for="name">Nom du produit</label>
                <input type="text" class="form-control" id="title" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea class="form-control" id="content" name="description" rows="3" required><?= htmlspecialchars($product['description']) ?> </textarea>
            </div>
            <div>
                <label for="price">Prix</label>
                <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>
             <div>
                <label for="picture"></label>
                <input type="hidden" name="picture" value='<?= htmlspecialchars($product['picture'])?>' />
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="category">Catégorie</label>
                
                <select class="form-control" id="category" name="category">
                    <option value="vegetable">Légumes</option>
                    <option value="fruit">Fruits</option>
                    <option value="meat">Viandes</option>
                </select>
            </div>
            <div>
                <button type="submit" id="form-submit" class="main-button details">Modifier le produit</button>
            </div>
        </form>
    </div>
</article>




