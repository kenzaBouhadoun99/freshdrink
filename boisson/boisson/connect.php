
<?php
  session_start();
    if(isset($_POST['email']) && isset($_POST['password'])){
    $db=new mysqli('localhost','root' , '' ,'freshdrink');
    if(mysqli_connect_error()){
        printf("echec :  %s \n" , mysqli_connect_error() );
        exit();
    }else{
       // echo "connexionreussi \n" ;
    }

 
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));


    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM `utilisateur` where `email` = '$username' and `mdp` = '$password' ";
      //  echo $requete ;
        $exec_requete = mysqli_query($db,$requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        $data=implode($reponse);
        //echo $data;

       // echo $count ; 
        if($count != 0) // nom d'utilisateur et mot de passe correctes
        {
      
        //ajouter la page de connexion
        include_once "connectpanier.php";
        //affichage des produits
        $req=mysqli_query($db,"SELECT * from Utilisateur");
        while($row = mysqli_fetch_assoc($req)){     
       // echo $req;
            $_SESSION['username'] = $username;
            //nom d'utilisateur et mot de passe correctes
           header('Location: "Accueil.php"');
          // echo "hello".$username;
        }
        }
        else
        {
           // utilisateur ou mot de passe incorrect 
            header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
        //utilisateur ou mot de passe vide
        header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe vide
    }
  }
  else
  {
     // email et mdp vide 
    header('Location: connexion.php');
 
  }
  mysqli_close($bd); // fermer la connexion
?>