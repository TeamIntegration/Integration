function IncrementScore(option){
  var score = parseInt(document.getElementById('score').value, 10);
  if (score < 2000) {
    if (option == "more") {
      document.getElementById('score').value = score + 1;
    }
  }
  if (score > 0) {
    if (option == "less") {
      document.getElementById('score').value = score - 1;
    }
  }
}


function ValiderScore(){
  var score = parseInt(document.getElementById('score').value, 10);
  var scoreTotal = parseInt(document.getElementById('scoreTotal').innerHTML, 10);

  if (score < 2001 && score > -1) {
    document.getElementById('scoreTotal').innerHTML = "";
    document.getElementById('scoreTotal').innerHTML = scoreTotal + score;
  }else {
    alert("Le nombre n'est pas accepté.");
  }
}
