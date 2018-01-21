var createFoodCard = function(username, location, img, desc, posted){
  // <div class="card">
  //   <div class="card-body">
  //     <h5 class="mb-1">Username</h5>
  //     Location
  //   </div>
  //   <img class="card-img-top" src="http://via.placeholder.com/600x300" alt="Card image cap">
  //   <div class="card-body">
  //     Food description
  //   </div>
  //   <div class="card-footer text-muted">
  //     2 days ago
  //   </div>
  // </div>
  var card = document.createElement("div");
  card.classList.add("card");
  card.classList.add("mb-4");

  var head = document.createElement("div");
  head.classList.add("card-body");
  var user = document.createElement("h5");
  user.classList.add("mb-1");
  user.appendChild(document.createTextNode(username));
  head.appendChild(user);
  head.appendChild(document.createTextNode(location));
  card.appendChild(head);

  var image = document.createElement("img");
  image.classList.add("card-img-top");
  image.src = img;
  card.appendChild(image);

  var description = document.createElement("div");
  description.classList.add("card-body");
  description.appendChild(document.createTextNode(desc));
  card.appendChild(description);

  var foot = document.createElement("div");
  foot.classList.add("card-footer");
  foot.classList.add("text-muted");
  foot.appendChild(document.createTextNode(posted));
  card.appendChild(foot);

  return card;
};

document.addEventListener('DOMContentLoaded', function(){
  const resultWrap = document.getElementById('result-wrap');

  var example = createFoodCard("Username", "Location", "http://via.placeholder.com/600x300", "Food Description", "1 days ago");
  resultWrap.appendChild(example);

  var example2 = createFoodCard("Username2", "Location2", "http://via.placeholder.com/600x300", "Food Description2", "2 days ago");
  resultWrap.appendChild(example2);
}, false);
