<?php
//l'insertion des données des utilisateurs dans la base de données
include("connectpanier.php"); 

@$SEXE=$_POST['sexe'];
@$NOM=$_POST['last_name'];
@$PRENOM=$_POST['first_name'];
@$DATENAISS=$_POST['naissance'];
@$RUE=$_POST['rue'];
@$CODEPOSTAL=$_POST['cp'];
@$VILLE=$_POST['ville'];
@$TEL=$_POST['number-phone'];
@$EMAIL=$_POST['email'];
@$MOTDEPASSE=$_POST['password'];
 
$requette="INSERT INTO Utilisateur(nomUtilisateur,prenomUtilisateur,birthday, CP, ville,tel, email,mdp) values('$NOM' , '$PRENOM' , '$DATENAISS' , '$CODEPOSTAL' , '$VILLE' ,'$TEL',  '$EMAIL', '$MOTDEPASSE')";
$res=mysqli_query($db,$requette);


?>