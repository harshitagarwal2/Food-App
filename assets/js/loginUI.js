document.addEventListener('DOMContentLoaded', function(){
  var loginBtn = document.getElementById("loginBtn");
  var loginCard = document.getElementById("loginCard");
  var registerBtn = document.getElementById("registerBtn");
  var registerCard = document.getElementById("registerCard");
  loginBtn.classList.add("active");
  registerCard.classList.add("d-none");

  loginBtn.addEventListener("click", function() {
    loginBtn.classList.add("active");
    loginCard.classList.remove("d-none");
    registerBtn.classList.remove("active");
    registerCard.classList.add("d-none");
  }, false);

  registerBtn.addEventListener("click", function() {
    registerBtn.classList.add("active");
    registerCard.classList.remove("d-none");
    loginBtn.classList.remove("active");
    loginCard.classList.add("d-none");
  }, false);

}, false);
