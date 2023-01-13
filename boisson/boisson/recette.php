<?php
    $db=new mysqli('localhost','root' , '' ,'freshdrink');
   if(mysqli_connect_error()){
           printf("echec :  %s \n" , mysqli_connect_error() );
           exit();
   }else {
   }
?>

<!DOCTYPE html>
<html>
    <head>  
        <title>Mesrecettes</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/stylesRecette.css">
        <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Crete+Round'>
    </head>
    <body>
    
        <a href='Accueil.php'><img src="images/logo.png"></a>
        <div class="image"></div>
        <div classe="recette">
        <?php 
            $nomC = $_GET['nom'] ;
            echo '<h2>'.$nomC.'</h2>';
        ?>
        <br><br>
            <h4><p>Les ingredients : </p> </h4> 
            <p>
        <?php 
            //recuperation du nom de chaque cocktail
            $nomC = $_GET['nom'] ;
             //affichage des ingredients du cocktail
            $rec= "SELECT ingredient FROM `Cocktail` WHERE nomCocktail='Black velvet';";
            if(!empty($rec)){
                $rec= "SELECT ingredient FROM `Cocktail` WHERE nomCocktail='$nomC';";
                $exec_requete = mysqli_query($db,$rec);   
                $reponse = mysqli_fetch_array($exec_requete);
                echo $reponse[0].'<br>';
            }  
        ?></p>

        </div>
        <div class="preparation">
            <h4><p>La preparation  : </p></h4>
            <p>
            <?php

            $nomC = $_GET['nom'] ;
            //affichage de la preparation du cocktail
            $rec= "SELECT preparation FROM `Cocktail` WHERE nomCocktail='$nomC';";
            $exec_requete = mysqli_query($db,$rec);   
            $reponse = mysqli_fetch_array($exec_requete);
            echo $reponse[0].'<br>';
           
        ?></p>
        </div>

        <div classe="recette">
           <!-- <p>Photo: </p> -->
        <?php
           
           $nomC = $_GET['nom'] ;
            //affichage de l'image du cocktail
           $rec= "SELECT photo FROM `Cocktail` WHERE nomCocktail='$nomC';";
           $exec_requete = mysqli_query($db,$rec);   
           $reponse = mysqli_fetch_array($exec_requete);
           $d=$reponse[0];
           echo '<img src="'.$d.'"  height="100px" width="50px"/> <style> img {position:relative ; 
        top:-50px; left : 10px;}</style>';
        ?>
        </div>
        

    </body>
</html>    