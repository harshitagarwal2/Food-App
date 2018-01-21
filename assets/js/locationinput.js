document.addEventListener('DOMContentLoaded', function(){
  var input = document.getElementById("location");
  console.dir(locationArray);
  var awesomplete = new Awesomplete(input, {
  	minChars: 1,
  	list: locationArray,
  });
  var parent = input.parentElement;
  parent.classList.add("form-control-file");
  parent.classList.add("w-75");
}, false);