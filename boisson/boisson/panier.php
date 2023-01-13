<?php 
   session_start();
   include_once "connectpanier.php";
   //supprimer les produits
   //si la variable del existe
   if(isset($_GET['del'])){
    $id_del = $_GET['del'] ;
    //suppression des elements dans le panier
    unset($_SESSION['panier'][$id_del]);
   }
?>
<!DOCTYPE html>
<html>
    <head>  
        <title>Panier</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/stylePanier.css">
    </head>
    <body class="panier">
        <a href="Accueil.php"  class="link"><img src="images/logo.png"/></a>
        <section>
            <table>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                //liste des produits
                //recuperer les cle du tableau
                $ids = array_keys($_SESSION['panier']);
              //s'il n'y a aucune clé dans le tableau
              if(empty($ids)){
                echo "Votre panier est vide";
              }else {
                //si vrai 
                $products = mysqli_query($db, "SELECT * FROM Panier WHERE id IN (".implode(',', $ids).")");


                //lise des produit avec une boucle foreach
                foreach($products as $product):
                ?>
                <tr>
                    <td><img src="<?=$product['images']?>"></td>
                    <td><?=$product['nomcocktailfournie']?></td>
                    <td><?=$_SESSION['panier'][$product['id']] // Quantité?></td>
                    <td><a href="panier.php?del=<?=$product['id']?>"><img src="images/delete.png"></a></td>
                </tr>
                <?php endforeach;}?>
                
            </table>
        </section>
    </body>
</html>