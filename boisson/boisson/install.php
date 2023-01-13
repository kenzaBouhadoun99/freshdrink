<?php
  
     function Connection_DB(){
        $conn =new mysqli('localhost','root' , '' );
        if(mysqli_connect_error()){
            printf("echec :  %s \n" , mysqli_connect_error() );
            exit();
        }

        $requette = "CREATE DATABASE IF NOT EXISTS freshdrink";
        if ($conn->query($requette) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $conn->error;
        }
        if($stmt = $conn ->prepare($requette)){
            $stmt->execute();
        }
        $conn = new mysqli('localhost', 'root', '' , 'freshdrink');
        return $conn;
     }

    include("./Donnees.inc.php");
   

   //  function Remplir_BD($Hierarchie,$Recettes){
     $conn1=Connection_DB();
     $requete = "CREATE DATABASE IF NOT EXISTS freshdrink";
     if($stmt = $conn1 ->prepare($requete)){
        $stmt->execute();
     }
    //table utilisateur 
    if($stmt){
        $requete = "CREATE TABLE IF NOT EXISTS Utilisateur(
            nomUtilisateur varchar(50) , 
            prenomUtilisateur varchar(50),
            birthday  date,
            sexe  varchar(10) ,
            CP   int(5),
            tel   int(11),
            ville varchar(50),
            adress varchar(100) ,
            email varchar(100) primary key ,
            mdp varchar(50)
        )";
        $stmt = $conn1 ->prepare($requete);
         $stmt->execute();
     
      
           
        //table Aliment
        $requete = "CREATE TABLE IF NOT EXISTS Aliment (
            nomAliment  varchar(50) primary key,
            supcategorie varchar(1000) 
        )";
        $stmt = $conn1->prepare($requete);
        $stmt->execute();

        //table Cocktail 
        $requete = "CREATE TABLE IF NOT EXISTS Cocktail (
            nomCocktail  varchar(50) primary key,
            ingredient varchar(1000),
            preparation varchar(1000),
            photo varchar(50)
        )";
        $stmt = $conn1->prepare($requete);
        $stmt->execute();
    

        //table Panier 
        $requete = "CREATE TABLE IF NOT EXISTS Panier (
            id int not null auto_increment,
            nbpiece int(255), 
            images varchar(1000),
            nomcocktailfournie varchar(100),
            primary key (id)
            )";
            $stmt = $conn1->prepare($requete);
            $stmt->execute();

        //table Liaison
        $requete = "CREATE TABLE IF NOT EXISTS Liaison (
            nomAlimentL varchar(50)  REFERENCES Aliment(nomAliment), 
            nomCoctailL varchar(50)  REFERENCES Cocktail(nomCocktail),
            primary key (nomAlimentL , nomCoctailL )
            )";
            $stmt = $conn1->prepare($requete);
            $stmt->execute();


        //remplir la table Aliment 
        foreach($Hierarchie as $nom => $aliment){
            if(isset($aliment['super-categorie'])){
                foreach($aliment['super-categorie'] as $cat => $pere){
                    $stmt = $conn1->prepare("INSERT INTO Aliment(nomAliment,supcategorie) values(?,?)");
                    $stmt-> bind_param("ss",$nom ,$pere);
                    $stmt-> execute();
                    mysqli_stmt_close($stmt);
                }
            }
        }
           
              
        //remplir la table Panier 
        foreach($Recettes as $recette){
            $nom = $recette['titre'];
            $stmt = $conn1->prepare("INSERT INTO Panier(id,nbpiece,images,nomcocktailfournie) values(?,?,?,?)");
            $stmt-> bind_param("ssss",$id,$nb ,$im,$nom);
            $stmt-> execute();
            mysqli_stmt_close($stmt); 
        }

        //remplir la table Cocktail 
        foreach($Recettes as $recette){
            $nom =$recette['titre'];
            $ingredients=$recette['ingredients'];
            $preparation=$recette['preparation'];
            $stmt =$conn1->prepare("INSERT INTO Cocktail(nomCocktail,ingredient,preparation) values(?,?,?)");
            $stmt-> bind_param("sss",$nom ,$ingredients,$preparation);
            $stmt-> execute();
            mysqli_stmt_close($stmt); 
        }

        // Ajout des images a la table des cocktail
		$tab[] = array ("image" => "Photos/Black_velvet.jpg", "nom" => "Black velvet");
		$tab[] = array ("image" => "Photos/Bloody_mary.jpg", "nom" => "Bloody Mary");
		$tab[] = array ("image" => "Photos/Bora_bora.jpg", "nom" => "Bora bora");
		$tab[] = array ("image" => "Photos/Builder.jpg", "nom" => "Builder");
		$tab[] = array ("image" => "Photos/Caipirinha.jpg", "nom" => "Caïpirinha");
		$tab[] = array ("image" => "Photos/Coconut_kiss.jpg", "nom" => "Coconut kiss");
		$tab[] = array ("image" => "Photos/Cuba_libre.jpg", "nom" => "Cuba libre");
		$tab[] = array ("image" => "Photos/Frosty_lime.jpg", "nom" => "Frosty lime");
		$tab[] = array ("image" => "Photos/Le_vandetta.jpg", "nom" => "Le vandetta");
		$tab[] = array ("image" => "Photos/Margarita.jpg", "nom" => "Margarita");
		$tab[] = array ("image" => "Photos/Mojito.jpg", "nom" => "Mojito");
		$tab[] = array ("image" => "Photos/Pina_colada.jpg", "nom" => "Piña Colada");
		$tab[] = array ("image" => "Photos/Raifortissimo.jpg", "nom" => "Raifortissimo");
        $tab[] = array ("image" => "Photos/Sangria_sans_alcool.jpg", "nom" => "Sangria sans alcool");
		$tab[] = array ("image" => "Photos/Screwdriver.jpg", "nom" => "Screwdriver");
		$tab[] = array ("image" => "Photos/Shoot_up.jpg", "nom" => "Shoot up");
		$tab[] = array ("image" => "Photos/Tequila_sunrise.jpg", "nom" => "Tequila sunrise");
		$tab[] = array ("image" => "Photos/Tipunch.jpg", "nom" => "Ti'punch");
        $cock[] = array("im" =>"images/cocktail.png" );
			
        $str='';
		for ($cmpt = 0; $cmpt< count($tab); $cmpt++){
			$img = mysqli_real_escape_string($conn1, $tab[$cmpt]['image']);
			$nom = mysqli_real_escape_string($conn1, $tab[$cmpt]['nom']);
            $ress=mysqli_query($conn1,"UPDATE Cocktail SET photo='{$img}' WHERE nomCocktail LIKE '{$nom}';");
            $reqq=mysqli_query($conn1,"UPDATE Panier SET images='{$img}' WHERE  nomcocktailfournie LIKE '{$nom}';");
            echo $reqq;
		}
        for ($cpt = 0; $cpt< count($cock); $cpt++){
			$imgs = mysqli_real_escape_string($conn1, $cock[$cpt]['im']);
            $ress=mysqli_query($conn1,"UPDATE Cocktail SET photo='{$imgs}' WHERE photo is null ;");
            $ress=mysqli_query($conn1,"UPDATE Panier SET images='{$imgs}' WHERE  images is null ;");

		}
         

    }
    echo "<h1><a href='Accueil.php'>revenir a l'acceuil</a></h1>";

?>