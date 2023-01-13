<?php
session_start();
include("./connectpanier.php");
@$cocktails = $db->query('SELECT nomCocktail FROM cocktail ;');

if(! empty($_GET['search'])){
  $recherche = htmlspecialchars($_GET['search']);
  $cocktails = $db->query('SELECT * FROM cocktail WHERE nomCocktail LIKE "%'.$recherche.'%" ');
  $rec=$db->query('SELECT count(*) FROM cocktail WHERE nomCocktail LIKE "%'.$recherche.'%" ');
 
  $reponse = mysqli_fetch_array($rec);
  $count = $reponse['count(*)'];
 

}

?>


<!DOCTYPE html>

<html>
    <head>
        <title>Accueil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="styles/style.css"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

</head>
<body>

    <header> 
      <nav class="menu" role="navigation">
        <div class="inner">
          <div class ="menu-left">
            <a href="Accueil.html"><img src="images/logo.png"></a>
            <h1 class="logo">Fresh Drink</h1>
          </div>
          <div class="menu-right">
            <!-- recherche de cocktail-->
            <form methode="GET">
              <input type="search" name="search" placeholder="Recherche ...">
              <input type="submit">
            </form>
            <!-- si la barre de recherche n'est pas vide-->
            <?php if(isset($count) > 0 ){ ?>
            <ul>
              <?php while($c=mysqli_fetch_assoc($cocktails)){ ?>
              <li><a href= "recette.php?nomdrink=<?=$row['nomcocktailfournie']?>">><?=$c['nomCocktail'] ?></li>
              <?php } ?>
            </ul>
            <?php } else {  ?>
              <!-- si la barre de recherche est vide-->
              Aucun résultat...
              <?php }?>
            <a href="connexion.php" class="menu-link"><i><img src="images/contact.png" alt=""></i></a>
            <a href="panier.php" class="menu-link"><i><img src="images/coeur.png" alt=""></i> <span><?=array_sum($_SESSION['panier'])?></span></a>
          </div>
      </div>
      </nav>
        
   </header>

   <?php
      //ajouter la page de connexion
      include_once "connectpanier.php";
      //affichage des produits
      $req=mysqli_query($db,"SELECT * from Panier");
      while($row = mysqli_fetch_assoc($req)){     
    ?>
   <div class="midlebody">
    <ul id="autoWidth" class="cs-hidden">
      <li class="item-a" >
        <div class="carte">
          <p class="boisson"> </p>
          <img src="<?=$row['images'] ?>" class="modele">
          
          <div class="detail">
          <a href="recette.php?nom=<?=$row['nomcocktailfournie']?>"><h4><?=$row['nomcocktailfournie']?></h4></a>
          <!--ajout des boissons dans le paniers grace a l'id-->
          <a href="ajouterpanier.php?id=<?=$row['id']?>"  class="idproduit">Ajouter au panier</a>
         <?php $var=$row['id'];
         // echo $var;
          ?>
          </div>

        </div>
      </li>
    </ul>
  
   </div>

   <?php
      }
   ?>

<script src="script.js" type="text/javascript"></script>
     <!-- le bas de page-->
    <footer> 
     <div class="foot">
            <h1>Fresh Drink</h1>
            <div class="fin">Copyright © Tous droits réservés.</div>
        </div> 
    </footer>
</body>
</html>


