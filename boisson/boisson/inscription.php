<!DOCTYPE html>
<html>
    <head>  
        <title>inscreption</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/styles.css">
    </head>
    <body>  
        <form method="POST" id='authentification' action="utilisateur.php">
            <div>
                <label for="name">Je suis  : </label><br>
                <select name="sexe" id="pet-select">
                    <option name="f">Une femme</option>
                    <option name="h">Un homme</option>
                </select><br><br>

                <label for="name">Nom :</label><br>
                <input type="text" id="nom" name="last_name" placeholder="votre nom"><br><br>
               
            
                <label for="name">Prénom :</label><br>
                <input type="text" id="prenom" name="first_name"  placeholder="votre prenom"><br><br>
                
                <label>Date de naissance :</label>  <br>
                <input type="date" name="naissance" /><br><br> 

                <label for="name">adress :</label><br>
                <input type="text" id="adress" name="rue" placeholder="Rue"  placeholder="votre rue" >
                
                <input type="text" id="ville" name="ville"  placeholder="Ville"  placeholder="votre ville">
               
                <input type="text" id="cp" name="cp"  placeholder="Code Postal"  placeholder="votre adresse postal"><br><br>
               
                <label for="name">Numéro de téléphone :</label><br>
                <input type="text" id="number-phone" name="number-phone"  placeholder="votre numero de telephode" ><br><br>

                <label for="name">email :</label><br>
                <input type="email" id="email" name="email"  placeholder="votre e-mail"><br><br>
               
                <label for="name">Mot de passe  :</label><br>
                <input type="password" id="password" name="password"  placeholder="votre mot de passe"><br><br>
                
                <label for="name"> Confirmation mot de passe  :</label><br>
                <input type="password" id="password-confirmation" name="password-confirmation"  placeholder="confirmer votre mot de passe"><br><br>
                <p style="color: red; " id="erreur"></p>
                <input type="submit" id="submit" name="envoyer" value="Envoyer"><br><br><br>
            </div>
        </form>
        <script src="script.js"></script>
      
 
    </body>

</html>