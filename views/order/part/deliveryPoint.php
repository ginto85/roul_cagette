
<ul>
<?php foreach ($deliveryPoints as $deliveryPoint): ?>

    <li data-id="<?= intval($deliveryPoint['id']) ?>">
      
        
        <p><?= htmlspecialchars($deliveryPoint['name']) ?></p>
        <p><?= htmlspecialchars($deliveryPoint['adress']) ?></p>
        <span data-zip-city="<?= htmlspecialchars(
            $deliveryPoint['zip_city']
        ) ?>"><?= htmlspecialchars($deliveryPoint['zip_city']) ?></span>
 
        <button class='details cityButton' target="_parent" data-lat="<?= htmlspecialchars(
            $deliveryPoint['lat']
        ) ?>" data-lng="<?= htmlspecialchars(
    $deliveryPoint['lng']
) ?>" >Choisir celui-ci</button>
       
    </li>
<?php endforeach; ?>
</ul>


