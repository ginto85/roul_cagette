<h1>Liste des commandes</h1>
<article class='orderListAdmin'>
      <div>
                <table>
        	    	<thead>
        	                <tr>
        	                    <th>N° cde</th>
        	                    <th>Client</th>
        	                    <th>Montant total</th>
        	                </tr>
        	    	</thead>
        	    	<tbody>
        	                <?php foreach($orders as $order) :?>
                                <tr>
                                        <td><?= htmlspecialchars($order['id']) ?></td>
                                        <td><?= htmlspecialchars($order['login']) ?></td>
                                        <td><?= htmlspecialchars($order['total_price']) ?></td>
                                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                                        <td>
                                                <form enctype="multipart/form-data" name="numPost" action="index.php?p=facture" method='post' >
                                                        <label for="numPost"></label>
                                                        <div>
                                                                <input type="hidden" name='numPost' value="<?= htmlspecialchars($order['id']) ?>" required>
                                                        </div>
                                                        <div><button type="submit" id="form-submit" class="main-button details">Génerer la facture N°<?= htmlspecialchars($order['id']) ?></button></div>
                                                </form>
                                        </td>
                                </tr>
                                <?php endforeach ?>
                        </tbody>
                </table>
        </div>
</article>
