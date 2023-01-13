<?php
            //la connexion a la base de donnees
           $db=new mysqli('localhost','root' , '' ,'freshdrink');
           if(mysqli_connect_error()){
               printf("echec :  %s \n" , mysqli_connect_error() );
               exit();
           }else{
               //echo "connexionreussi \n" ;
           }
?>
