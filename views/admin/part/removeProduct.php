
<h2>Supprimer ou modifier un produit</h2>

<div class='removeAdmin'>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix Unitaire</th>
                <th>Categorie</th>
                <th class="suppr">Suppr.</th>
                <th class="modif"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product) :?>
            <tr>
            
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?>€</td>
                <td><?= htmlspecialchars($product['category']) ?></td>
                <td><a href="index.php?p=deletee&numProduct=<?= htmlspecialchars($product['id']) ?>"><i class="fas fa-trash-alt" ></i></a></td>
                <td><a href="index.php?p=update&numProduct=<?= htmlspecialchars($product['id']) ?>"> modifier</a></td>
            
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    
</div>

