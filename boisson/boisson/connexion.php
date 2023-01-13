<!DOCTYPE html>
<html>
    <head>  
        <title>Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/styleConnect.css">
    </head>
    <body>
        <img src="images/logo.png">
        <form method="POST" id='authentification' action="connect.php">
            <!-- les differentes cases qui permete de se connecter -->
            <input type="email" id="email" name="email" placeholder="Nom d'utilisateur" autocomplete="off" ><br><br>
            <div class="personne"></div>
            <input type="password" id="password" name="password" placeholder="Mot de passe" autocomplete="off"><br><br>
            <div class="lock"></div>
            <input type="submit" id="submit" name="submit" value="Connexion">
            <p class="mdp-oublie">Mot de passe oublié ? </p>
            <p class="inscreption">Je n'ai pas de compte.<a href="inscription.php"> m'inscrire .</a></p>
        </form>
        <script src="script.js"></script>
        <p  style="color: red;" id="erreur"></p>
    </body>

</html>

