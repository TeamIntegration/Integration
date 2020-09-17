function DisplayActivite(){

  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    console.log(this.response);
    var res = this.response;

    if (res.html != "") {
      document.getElementsByTagName('main')[0].innerHTML = res.html;

      //Affichage de l'icon en red et reset de la précédente.
      document.getElementById('activite').src = "assets/icons/joystickRed_127px.png";
      document.getElementById('leaderBoard').src = "assets/icons/trophyGrey_127px.png";
    }

  } else if (this.readyState == 4) {
    alert("Une erreur est survenue...");
  }
  };

  xhr.open("POST", "views/activite.php", true);
  xhr.responseType = "json";
  // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send();
}

DisplayActivite();

function DisplayLeaderBoard(){

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.response);
      var res = this.response;

      if (res.html != "") {
        document.getElementsByTagName('main')[0].innerHTML = res.html;

        //Affichage de l'icon en red et reset de la précédente.
        document.getElementById('leaderBoard').src = "assets/icons/trophyRed_127px.png";
        document.getElementById('activite').src = "assets/icons/joystickGrey_127px.png";
      }

    } else if (this.readyState == 4) {
      alert("Une erreur est survenue...");
    }
    };

    xhr.open("POST", "views/leaderBoard.php", true);
    xhr.responseType = "json";
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}
