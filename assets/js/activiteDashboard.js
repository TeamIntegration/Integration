function IncrementScore(option){
  var score = parseInt(document.getElementById('score').innerHTML, 10);
  if (option == "more") {
    document.getElementById('score').innerHTML = score + 1;
  }else {
    document.getElementById('score').innerHTML = score - 1;
  }
}
