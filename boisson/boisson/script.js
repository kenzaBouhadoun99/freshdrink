// Vérification des formulaires du site//

document.getElementById("password-confirmation").addEventListener("input", function() {
    var elementErreur = document.getElementById("erreur");
if(this.value != document.getElementById("password").value){
    
    elementErreur.innerHTML = "Mots de passes non identiques"; 
}else{
    elementErreur.innerHTML ="";
}
  
});
document.getElementById("authentification").addEventListener("submit", function(e) {

 	var erreur;
 
	var inputs = this.getElementsByTagName("input");
 
	for (var i = 0; i < inputs.length; i++) {
		console.log(inputs[i]);
		if (!inputs[i].value) {
			erreur = "Veuillez remplir toutes les cases";
		}
	}

    if(erreur){
        e.preventDefault();
        document.getElementById("erreur").innerHTML = erreur ; 
        return false ; 
    }else{
        alert('Authentification réussie') ; 
    }
});