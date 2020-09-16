function DisplayActivite(){

  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    console.log(this.response);
    var res = this.response;

    if (res.html != "") {
      document.getElementsByTagName('main')[0].innerHTML = res.html;
    }

  } else if (this.readyState == 4) {
    alert("Une erreur est survenue...");
  }
  };

  xhr.open("POST", "activite.php", true);
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
      }

    } else if (this.readyState == 4) {
      alert("Une erreur est survenue...");
    }
    };

    xhr.open("POST", "leaderBoard.php", true);
    xhr.responseType = "json";
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}
