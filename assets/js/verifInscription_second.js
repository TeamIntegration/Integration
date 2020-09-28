var promo = "";

function SendInscription(){

  if (promo != "" && VerifSaisieCode() == false) {
    var code = document.getElementById('code').value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        var res = this.response;

        if (res.success == 1) {
          alert(res.message);
          document.location = "app.php";
        }else {
          alert(res.message);
        }

      }else if (this.readyState == 4) {
        alert("Une erreur est survenue..");
      }
    };

    var code = document.getElementById('code').value;
    xhr.open("POST", "assets/function/scriptInscription_second.php", true);
    xhr.responseType = "json";
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("promo=" + encodeURI(promo) + "&code=" + encodeURI(code));

  }else {
    if (promo == "") {
      alert("Veuillez sélectionner une promo!");
    }else {
      alert("Veuillez indiquer le code!");
    }
  }
}

function Select_1SIO(object){
  if (promo != "1SIO") {
    promo = "1SIO";
    object.style.backgroundColor = "#F03A47";
    document.getElementById('2SIO').style.backgroundColor = "#142431";
  }
}

function Select_2SIO(object){
  if (promo != "2SIO") {
    promo = "2SIO";
    object.style.backgroundColor = "#F03A47";
    document.getElementById('1SIO').style.backgroundColor = "#142431";
  }
}

function VerifSaisieCode(){
  var error = false;
  var uncode = document.getElementById('code').value;
  if (uncode == "") {
    error = true;
  }

  return error;
}
