function startIntegration(){

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.response);
      var res = this.response;

      if (res.success == 1) {
        alert("Lancement de l'intégration réussi.");
      }else {
        alert("Echec lors du lancement.");
      }

    } else if (this.readyState == 4) {
      alert("Une erreur est survenue...");
    }
    };

    xhr.open("POST", "assets/function/startIntegration.php", true);
    xhr.responseType = "json";
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}

function nextTour(){

  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    console.log(this.response);
    var res = this.response;

    if (res.success == 1) {
      alert("Passage au tour suivant réussi.");
    }else {
      alert("Echec lors du passage du tour.");
    }

  } else if (this.readyState == 4) {
    alert("Une erreur est survenue...");
  }
  };

  xhr.open("POST", "assets/function/nextTour.php", true);
  xhr.responseType = "json";
  // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send();
}
