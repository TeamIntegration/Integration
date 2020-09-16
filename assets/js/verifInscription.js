var promo = "";

document.getElementById('form').addEventListener("submit", function(e) {
  e.preventDefault();
  var data = new FormData(this);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      console.log(this.response);
      var res = this.response;

      if (res.success == 1) {
        alert("first etape");
        document.location = 'inscription_second.php';
      }

    }else if (this.readyState == 4) {
      alert("Une erreur est survenue..");
    }
  };

  xhr.open("POST", "assets/function/scriptInscription_first.php", true);
  xhr.responseType = "json";
  xhr.send(data);

  return false;
});

function SendInscription(){

  if (promo != "") {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        console.log(this.response);
        var res = this.response;

        if (res.success == 1) {
          alert(res.message);
        }else {
          alert(res.message);
        }

      }else if (this.readyState == 4) {
        alert("Une erreur est survenue..");
      }
    };

    xhr.open("POST", "assets/function/scriptInscription_second.php", true);
    xhr.responseType = "json";
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("promo=" + encodeURI(promo));

  }else {
    alert("Veuillez sélectionner une promo!");
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
