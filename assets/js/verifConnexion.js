document.getElementById('form').addEventListener("submit", function(e) {
  e.preventDefault();
  var data = new FormData(this);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      var res = this.response;

      if (res.success == 1) {
        document.location = 'app.php';
      }else {
        alert("Mot de passe incorrect! Réessayez.");
      }

    }else if (this.readyState == 4) {
      alert("Une erreur est survenue..");
    }
  };

  xhr.open("POST", "assets/function/scriptConnexion.php", true);
  xhr.responseType = "json";
  xhr.send(data);

  return false;
});
