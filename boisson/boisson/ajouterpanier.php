<?php
//inclure la page de connexion
include_once "connectpanier.php";


//verifier si une session existe
if(!isset($_SESSION)){
    //si elle existe pas la demander
    session_start();
}
//on vas creer la session
if(!isset($_SESSION['panier'])){
    //si elle y est pas on creer une avec un tabbleau a l'interieur
$_SESSION['panier'] = array();
}

echo $_GET['panier'];
if(isset($_GET['id'])){//si un id a été envoyé alors :
    $id = $_GET['id'] ;
    //verifier grace a l'id si le produit existe dans la base de  données
    $produit = mysqli_query($db ,"SELECT * FROM Panier WHERE id = $id") ;
    if(empty(mysqli_fetch_assoc($produit))){
        //si ce produit n'existe pas
        die("Ce produit n'existe pas");
    }
    if(isset($_SESSION['panier'][$id])){
        $_SESSION['panier'][$id]++;
    }else{
        $_SESSION['panier'][$id]=1;
    }
        //redirection vers la page d'accueil
        header("Location:Accueil.php");
     
   


}
?>